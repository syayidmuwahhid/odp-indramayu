let editorInstance;
let tags = [];
let tagfy;

$(document).ready(async function () {
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
            editorInstance = editor;
        })
        .catch((error) => {
            console.error(error);
        });

    await getCategoryList();
    await getData();

    var input = document.getElementById("tag-input");
    tagify = new Tagify(input, {
        whitelist: [],
        dropdown: {
            maxItems: 20, // <- mixumum allowed rendered suggestions
            classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
            enabled: 0, // <- show suggestions on focus
            closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
        },
    });

    $("#select_category").change(async function () {
        let category_id = $(this).val();
        let whitelist = [];
        let { data } = await getRequestData(
            `${baseL}/api/tags/list/category?id=${category_id}`
        );

        data.forEach((element) => {
            whitelist.push(element.name);
        });

        tagify.whitelist = [...new Set(whitelist)];
    });

    $("#select_category").change();
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
        post_data.append("_method", "PUT");

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
        window.location.reload();
    }
}

async function getData() {
    try {
        let id = $("#article_id").val();
        let data = await getRequestData(`${baseL}/api/article/${id}`);
        console.log(data);

        $("#title").val(data.data.title);
        $("#select_category").val(data.data.category_id);
        $("#date").val(data.data.date);

        let tags = "";
        data.data.tags.forEach((element) => {
            tags += element.name + ",";
        });
        $("#tag-input").val(tags);

        editorInstance.setData(data.data.content);
    } catch (error) {
        notif("error", "Galat!", error);
    }
}
