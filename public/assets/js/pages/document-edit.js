$(document).ready(
    /**
     * This function is an async IIFE (Immediately Invoked Function Expression) that handles the document ready event.
     * It initializes the form behavior, fetches data, and sets up event listeners.
     */
    async function () {
        /**
         * Event listener for the "change" event on the "type" select element.
         * It toggles the visibility of the link and upload containers based on the selected type.
         */
        $("#type").change(() => {
            let type = $("#type").val();

            if (type === "Link") {
                $("#link").attr("required", "");
                $("#link-container").attr("style", "");
                $("#upload-container").attr("style", "display:none");
            } else {
                $("#link").removeAttr("required", "");
                $("#link-container").attr("style", "display:none");
                $("#upload-container").attr("style", "");
            }
        });

        /**
         * Calls the getData function to fetch and populate the form fields with document data.
         */
        await getData();

        /**
         * Triggers the "change" event on the "type" select element to update the form layout.
         */
        $("#type").change();

        /**
         * Event listener for the "submit" event on the form.
         * It prevents the default form submission behavior and calls the submitForm function.
         */
        $("#form_submit").submit(submitForm);
    }
);

/**
 * This function fetches document data from the server and populates the form fields.
 *
 * @returns {Promise<void>} - A promise that resolves when the data fetching and form population are complete.
 */
async function getData() {
    try {
        // Get the document ID from the hidden input field
        let id = $('input[name="id"]').val();

        // Make a GET request to the server API to fetch the document data
        let { data } = await getRequestData(`${baseL}/api/document/${id}`);

        // Populate the form fields with the fetched data
        $("#title").val(data.title);
        $("#date").val(data.date);
        $("#author").val(data.author);
        $("#type").val(data.type);
        $("#status").val(data.status);

        // If the document type is "Link", populate the link input field
        if (data.type === "Link") {
            $("#link").val(data.location);
        }
    } catch (error) {
        // Display an error notification if the data fetching fails
        notif("error", "Galat!", error);
    }
}

/**
 * This function handles the form submission event.
 * It prevents the default form submission behavior, collects form data, and sends it to the server.
 *
 * @param {Event} e - The event object representing the form submission.
 * @returns {Promise<void>} - A promise that resolves when the form submission is complete.
 */
async function submitForm(e) {
    try {
        // Prevent the default form submission behavior
        e.preventDefault();

        // Construct the URL for the server API endpoint
        const url = baseL + $(this).attr("action");

        // Determine the HTTP method for the request
        const method = $(this).attr("method");

        // Create a FormData object from the form
        const post_data = new FormData(this);

        // Append the user ID to the form data
        post_data.append("user_id", userID);

        // Send the form data to the server using the specified method
        let data = await postData(url, post_data, method);

        // Throw an error if the request fails or the response status is not successful
        if (!data.status) {
            throw new Error(data.message);
        }

        // Display a success notification
        notif("success", "Berhasil", data.message);

        // Redirect the user to the document list page
        window.location.href = "/admin/document/";
    } catch (error) {
        // Display an error notification
        notif("error", "Galat!", error);
    }
}
