let editorInstance;
let tags = [];
let tagfy;

$(document).ready(
    /**
     * This function initializes the editor, category list, and tag input field.
     * It also sets up event listeners for category selection and form submission.
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

        // Fetch and populate the category list
        await getCategoryList();

        // Initialize the Tagify instance for the tag input field
        var input = document.getElementById("tag-input");
        tagify = new Tagify(input, {
            whitelist: [],
            dropdown: {
                maxItems: 20, // Maximum number of suggestions to render
                classname: "tags-look", // Custom classname for the dropdown
                enabled: 0, // Show suggestions on focus
                closeOnSelect: false, // Do not hide the suggestions dropdown once an item has been selected
            },
        });

        // Event listener for category selection
        $("#select_category").change(async function () {
            let category_id = $(this).val();
            let whitelist = [];
            let { data } = await getRequestData(
                `${baseL}/api/tags/list/category?id=${category_id}`
            );

            // Populate the whitelist with tag names from the selected category
            data.forEach((element) => {
                whitelist.push(element.name);
            });

            // Update the Tagify whitelist
            tagify.whitelist = [...new Set(whitelist)];
        });

        // Trigger the category selection event initially
        $("#select_category").change();

        // Event listener for form submission
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
    // Fetch the category list from the server using the getRequestData function
    let { data } = await getRequestData(`${baseL}/api/category/list`);

    // Use jQuery to select the category dropdown element\
    $("#select_category")
        // Initialize Select2 with the fetched category data
        .select2({
            placeholder: "pilih kategori",
            // allowclear: true, // Uncomment this line to enable the "clear selection" option
            data, // Assign the fetched category data to the Select2 data option
        });
}

/**
 * Handles form submission and performs necessary validations and data processing.
 *
 * @param {Event} e - The event object representing the form submission.
 * @returns {Promise<void>}
 * @throws Will throw an error if the form submission fails or if the response status is not successful.
 */
async function submitForm(e) {
    try {
        // Prevent the default form submission behavior
        e.preventDefault();

        // Construct the URL for the form submission
        const url = baseL + $(this).attr("action");

        // Determine the HTTP method for the form submission
        const method = $(this).attr("method");

        // Create a FormData object from the form
        const post_data = new FormData(this);

        // Perform input validation for the tag input field
        inputValidate("#tag-input", "Artikel Tag");

        // Parse the value of the tag input field and extract the tag values
        let tags_input = JSON.parse($("#tag-input").val());

        // Populate the tags array with the extracted tag values
        tags_input.forEach((element) => {
            tags.push(element.value);
        });

        // Append the tags array to the FormData object
        post_data.append("tags", tags);

        // Retrieve the content of the ClassicEditor instance
        const editorData = editorInstance.getData();

        // Throw an error if the editor content is empty
        if (!editorData) {
            throw new Error("Isi Artikel tidak boleh Kosong");
        }

        // Append the editor content to the FormData object
        post_data.append("content", editorData);

        // Perform the form submission using the postData function
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
        // Display an error notification
        notif("error", "Galat!", error);
    }
}

function generateSlug() {
    slug = "";
    let val = $(this).val();
    slug = val.toLowerCase().replace(/\s+/g, "-");
    $("#slug").val(slug);
}
