$(document).ready(
    /**
     * This function is called when the document is ready. It sets up event listeners for the type select and form submission.
     */
    function () {
        /**
         * Event listener for the type select.
         * It changes the required attribute of the link and file input fields based on the selected type.
         * It also shows or hides the link and upload containers based on the selected type.
         */
        $("#type").change(() => {
            let type = $("#type").val();

            if (type === "Link") {
                $("#link").attr("required", "");
                $("#file").removeAttr("required", "");
                $("#link-container").attr("style", "");
                $("#upload-container").attr("style", "display:none");
            } else {
                $("#file").attr("required", "");
                $("#link").removeAttr("required", "");
                $("#link-container").attr("style", "display:none");
                $("#upload-container").attr("style", "");
            }
        });

        /**
         * Event listener for the form submission.
         * It prevents the default form submission behavior and calls the submitForm function.
         */
        $("#form_submit").submit(submitForm);
    }
);

/**
 * This function handles form submission.
 *
 * @param {Event} e - The event object representing the form submission.
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function submitForm(e) {
    try {
        // Prevent the default form submission behavior
        e.preventDefault();

        // Construct the URL for the API request
        const url = baseL + $(this).attr("action");

        // Determine the HTTP method for the API request
        const method = $(this).attr("method");

        // Create a FormData object from the form inputs
        const post_data = new FormData(this);

        // Append the user ID to the form data
        post_data.append("user_id", userID);

        // Make the API request and wait for the response
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
