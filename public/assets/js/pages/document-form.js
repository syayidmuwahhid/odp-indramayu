$(document).ready(function () {
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

    $("#form_submit").submit(submitForm);
});

async function submitForm(e) {
    try {
        e.preventDefault();
        const url = baseL + $(this).attr("action");
        const method = $(this).attr("method");
        const post_data = new FormData(this);

        post_data.append("user_id", userID);

        let data = await postData(url, post_data, method);

        // Throw an error if the request fails or the response status is not successful
        if (!data.status) {
            throw new Error(data.message);
        }

        notif("success", "Berhasil", data.message);

        window.location.href = "/admin/document/";
    } catch (error) {
        notif("error", "Galat!", error);
    }
}
