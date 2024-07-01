let editorInstance;
let tags = [];
let tagfy;

$(document).ready(
    /**
     * This function initializes the editor, category list, and data for the article.
     * It also sets up the Tagify plugin for managing article tags.
     *
     * @returns {Promise<void>}
     */
    async function () {
        //slug
        $("#title").keyup(generateSlug);

        // Create a new instance of the ClassicEditor
        ClassicEditor.create(document.querySelector("#editor"), {
            removePlugins: [
                "Image",
                "ImageCaption",
                "ImageStyle",
                "ImageToolbar",
                "ImageUpload",
                "EasyImage",
                "Base64UploadAdapter",
                "CKFinder",
                "CKFinderUploadAdapter",
            ],
            toolbar: {
                items: [
                    "heading",
                    "|",
                    "bold",
                    "italic",
                    "link",
                    "|",
                    "bulletedList",
                    "numberedList",
                    "blockQuote",
                    "|",
                    "undo",
                    "redo",
                ],
            },
        })
            .then((editor) => {
                // Store the editor instance for later use
                editorInstance = editor;
            })
            .catch((error) => {
                // Log any errors that occur during editor creation
                console.error(error);
            });

        // Fetch the list of categories from the server
        await getCategoryList();

        // Fetch the article data from the server
        await getData();

        // Initialize the Tagify plugin for managing article tags
        var input = document.getElementById("tag-input");
        tagify = new Tagify(input, {
            whitelist: [],
            dropdown: {
                maxItems: 20, // Maximum number of suggestions to display
                classname: "tags-look", // Custom classname for the dropdown
                enabled: 0, // Do not show suggestions on focus
                closeOnSelect: false, // Do not hide the suggestions dropdown once an item has been selected
            },
        });

        // Event listener for the category selection dropdown
        $("#select_category").change(async function () {
            let category_id = $(this).val();
            let whitelist = [];

            // Fetch the list of tags for the selected category from the server
            let { data } = await getRequestData(
                `${baseL}/api/tags/list/category?id=${category_id}`
            );

            // Populate the whitelist with the fetched tag names
            data.forEach((element) => {
                whitelist.push(element.name);
            });

            // Update the Tagify whitelist
            tagify.whitelist = [...new Set(whitelist)];
        });

        // Trigger the category selection event to populate the whitelist initially
        $("#select_category").change();

        // Event listener for the form submission
        $("#form_submit").submit(submitForm);
    }
);

/**
 * Fetches the list of categories from the server and populates the category selection dropdown.
 *
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function getCategoryList() {
    try {
        // Fetch the category list data from the server
        let { data } = await getRequestData(`${baseL}/api/category/list`);

        // Use jQuery to select the category dropdown element
        $("#select_category")
            // Initialize Select2 plugin with custom options
            .select2({
                placeholder: "pilih kategori",
                // allowclear: true, // Uncomment if you want to allow clearing the selected value
                data, // Assign the fetched data to the Select2 dropdown
            })
            .addClass("inputan"); // Add a custom classname to the dropdown element
    } catch (error) {
        // Log any errors that occur during the request
        console.error(error);
        // Throw the error to be handled by the calling function
        throw error;
    }
}

/**
 * Handles the form submission event.
 * Validates the form inputs, extracts tags from the Tagify instance,
 * appends necessary data to FormData, and sends a PUT request to the server.
 *
 * @param {Event} e - The event object
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function submitForm(e) {
    try {
        e.preventDefault(); // Prevent the form from submitting normally

        // Get the form action and method attributes
        const url = baseL + $(this).attr("action");
        const method = $(this).attr("method");

        // Create a new FormData object from the form
        const post_data = new FormData(this);

        // Validate the Tagify input field
        inputValidate("#tag-input", "Artikel Tag");

        // Parse the Tagify input value and extract the tag values
        let tags_input = JSON.parse($("#tag-input").val());

        // Populate the tags array with the extracted tag values
        tags_input.forEach((element) => {
            tags.push(element.value);
        });

        // Append the tags array to the FormData object
        post_data.append("tags", tags);

        // Append the PUT method to the FormData object
        post_data.append("_method", "PUT");

        // Get the editor data
        const editorData = editorInstance.getData();

        // Throw an error if the editor data is empty
        if (!editorData) {
            throw new Error("Isi Artikel tidak boleh Kosong");
        }

        // Append the editor data to the FormData object
        post_data.append("content", editorData);

        // Send a PUT request to the server with the FormData object
        let data = await postData(url, post_data, method);

        // Throw an error if the request fails or the response status is not successful
        if (!data.status) {
            throw new Error(data.message);
        }

        // Display a success notification
        notif("success", "Berhasil", data.message);

        // Redirect the user to the article list page
        window.location.href = "/admin/article/";
    } catch (error) {
        // Display an error notification and reload the page
        notif("error", "Galat!", error);
        window.location.reload();
    }
}

/**
 * Fetches the article data from the server and populates the form fields.
 *
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function getData() {
    try {
        // Get the article ID from the hidden input field
        let id = $("#article_id").val();

        // Fetch the article data from the server using the article ID
        let data = await getRequestData(`${baseL}/api/article/${id}`);

        // Populate the form fields with the fetched data
        $("#title").val(data.data.title); // Set the title input field value
        $("#select_category").val(data.data.category_id); // Set the category dropdown value
        $("#date").val(data.data.date); // Set the date input field value

        // Concatenate the tag names into a comma-separated string
        let tags = "";
        data.data.tags.forEach((element) => {
            tags += element.name + ",";
        });

        // Set the Tagify input field value with the concatenated tag names
        $("#tag-input").val(tags);

        // Set the editor content with the fetched article content
        editorInstance.setData(data.data.content);

        //set slug
        $("#slug").val(data.data.slug);
    } catch (error) {
        // Display an error notification if the request fails or the response status is not successful
        notif("error", "Galat!", error);
    }
}

function generateSlug() {
    slug = "";
    let val = $(this).val();
    slug = val.toLowerCase().replace(/\s+/g, "-");
    $("#slug").val(slug);
}
