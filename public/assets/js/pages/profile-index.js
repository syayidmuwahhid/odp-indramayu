let editorInstance, oldBanner, oldIcon;
$(document).ready(async function () {
    var tags = document.getElementById("tags");
    tagifyTag = new Tagify(tags, {
        whitelist: [],
        dropdown: {
            maxItems: 20, // <- mixumum allowed rendered suggestions
            classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
            enabled: 0, // <- show suggestions on focus
            closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
        },
    });

    var keywords = document.getElementById("keywords");
    tagifyTag = new Tagify(keywords, {
        whitelist: [],
        dropdown: {
            maxItems: 20, // <- mixumum allowed rendered suggestions
            classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
            enabled: 0, // <- show suggestions on focus
            closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
        },
    });

    ClassicEditor.create(document.querySelector("#history"), {
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

    await getData();

    $("#banner").change(function (e) {
        let file = e.target.files[0];

        if (file) {
            $("#img_banner").attr("src", URL.createObjectURL(file));
        } else {
            $("#img_banner").attr("src", `${baseL}/${oldBanner}`);
        }
    });

    $("#icon").change(function (e) {
        let file = e.target.files[0];

        if (file) {
            $("#img_icon").attr("src", URL.createObjectURL(file));
        } else {
            $("#img_icon").attr("src", `${baseL}/${oldIcon}`);
        }
    });

    $("#form_submit").submit(submitForm);
});

async function getData() {
    try {
        let data = await getRequestData(`${baseL}/api/profile`);

        if (!data.status) {
            throw new Error(data.message);
        }

        $("#app_name").val(data.data.app_name);
        $("#title").val(data.data.title);
        $("#description").html(data.data.description);
        $("#facebook").val(data.data.facebook);
        $("#youtube").val(data.data.youtube);
        $("#instagram").val(data.data.instagram);
        $("#x").val(data.data.x);
        $("#keywords").val(data.data.keywords);
        $("#tags").val(data.data.tags);
        $("#img_banner").attr("src", `${baseL}/${data.data.banner}`);
        $("#img_icon").attr("src", `${baseL}/${data.data.icon}`);
        editorInstance.setData(data.data.history);
        oldBanner = data.data.banner;
        oldIcon = data.data.icon;
    } catch (error) {
        notif("error", "Galat!", error);
    }
}

async function submitForm(e) {
    try {
        e.preventDefault();
        const url = baseL + $(this).attr("action");
        const method = $(this).attr("method");
        const post_data = new FormData(this);

        post_data.append("history", editorInstance.getData());

        let data = await postData(url, post_data, method);

        if (!data.status) {
            throw new Error(data.message);
        }

        notif("success", "Berhasil!", data.message);
        window.location.reload();
    } catch (error) {
        notif("error", "Galat!", error);
    }
}
