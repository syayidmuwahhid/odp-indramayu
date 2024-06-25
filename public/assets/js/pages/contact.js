$(document).ready(function () {
    $("#contact-form").submit(formSubmit);
});

async function formSubmit(e) {
    try {
        e.preventDefault();
        const url = baseL + $(this).attr("action");
        const method = $(this).attr("method");
        const post_data = new FormData(this);

        let data = await postData(url, post_data, method);
        console.log(data);
    } catch (error) {
        notif("error", "Galat!", error);
    }
}
