$(document).ready(function () {
    $("#contact-form").submit(formSubmit);
});

async function formSubmit(e) {
    try {
        e.preventDefault();
        const subject = $('input[name="subject"]').val();
        const email = $('input[name="email"]').val();
        const body = $('textarea[name="body"]').val();
        const myEmail = $(this).data("email");

        window.location.href = `mailto:${myEmail}?subject=${subject} dari ${email}&body=${body}`;
    } catch (error) {
        console.log("error", "Galat!", error);
    }
}
