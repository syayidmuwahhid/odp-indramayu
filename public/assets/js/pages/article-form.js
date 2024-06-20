let editorInstance;
let tags = [];

$(document).ready(function () {
    ClassicEditor.create(document.querySelector("#editor"))
        .then((editor) => {
            editorInstance = editor;
        })
        .catch((error) => {
            console.error(error);
        });

    getCategoryList();

    var input = document.getElementById("tag-input");
    const tagify = new Tagify(input, {
        backspace: "edit", // Aksi saat menekan tombol backspace
        placeholder: "Masukan Tag Artikel",
    });
    // tagify.on("add", function (e) {
    //     tags.push(e.detail.data.value);
    // });

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
        const method = $(this).attr("method");
        const post_data = new FormData(this);

        //validasi
        inputValidate("#tag-input", "Artikel Tag");

        let tags_input = JSON.parse($("#tag-input").val());

        tags_input.forEach((element) => {
            tags.push(element.value);
        });

        post_data.append("tags", tags);

        const editorData = editorInstance.getData();

        if (!editorData) {
            throw new Error("Isi Artikel tidak boleh Kosong");
        }

        post_data.append("content", editorData);

        let data = await postData(url, post_data, method);

        // Throw an error if the request fails or the response status is not successful
        if (!data.status) {
            throw new Error(data.message);
        }

        notif("success", "Berhasil", data.message);

        window.location.href = "/admin/article/";
    } catch (error) {
        notif("error", "Galat!", error);
    }
}
