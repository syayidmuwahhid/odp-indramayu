$(document).ready(function () {
    $("#contact-form").submit(formSubmit);
});

async function formSubmit(e) {
    try {
        e.preventDefault();
        const subject = $('input[name="subject"]').val();
        const email = $('input[name="email"]').val();
        const body = $('textarea[name="body"]').val();
        /**
         * Handles the form submission event and sends an email using the mailto protocol.
         *
         * @param {Event} e - The event object representing the form submission.
         * @returns {void}
         */
        async function formSubmit(e) {
            try {
                // Prevent the default form submission behavior
                e.preventDefault();

                // Get the values from the form inputs
                const subject = $('input[name="subject"]').val();
                const email = $('input[name="email"]').val();
                const body = $('textarea[name="body"]').val();

                // Get the email address from the data attribute of the form element
                const myEmail = $(this).data("email");

                // Construct the mailto URL with the form values
                window.location.href = `mailto:${myEmail}?subject=${subject} dari ${email}&body=${body}`;
            } catch (error) {
                // Log any errors to the console
                console.log("error", "Galat!", error);
            }
        }
        const myEmail = $(this).data("email");

        window.location.href = `mailto:${myEmail}?subject=${subject} dari ${email}&body=${body}`;
    } catch (error) {
        console.log("error", "Galat!", error);
    }
}
