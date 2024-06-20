
$(document).ready(function () {
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });

    getCategoryList();

    $("#form_submit").submit(submitForm);
});

async function getCategoryList() {
    let { data } = await getRequestData(`${baseL}/api/category/list`);
    $("#select_category")
        .select2({
            placeholder: "pilih kategori",
            // allowclear: true,
            data,
        })
        .addClass("inputan");
}

async function submitForm(e) {
    try {
        e.preventDefault();
        const url = baseL + $(this).attr("action");
        const post_data = new FormData(this);
        const method = $(this).attr("method");

        let data = await postData(url, post_data, method);
        console.log(data);
    } catch (error) {
        notif("error", "Galat!", error);
    }
}
