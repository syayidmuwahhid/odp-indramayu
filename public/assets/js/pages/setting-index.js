let historyInstance, misiInstance, demografiInstance, geografiInstance, oldIcon;
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

    setTextEditor("#history")
        .then((editor) => {
            historyInstance = editor;
        })
        .catch((error) => {
            console.error(error);
        });

    setTextEditor("#misi")
        .then((editor) => {
            misiInstance = editor;
        })
        .catch((error) => {
            console.error(error);
        });

    setTextEditor("#geografi")
        .then((editor) => {
            geografiInstance = editor;
        })
        .catch((error) => {
            console.error(error);
        });

    setTextEditor("#demografi")
        .then((editor) => {
            demografiInstance = editor;
        })
        .catch((error) => {
            console.error(error);
        });

    await getData();

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

function setTextEditor(id) {
    return ClassicEditor.create(document.querySelector(id), {
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
    });
}

async function getData() {
    try {
        let data = await getRequestData(`${baseL}/api/setting`);

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
        $("#img_icon").attr("src", `${baseL}/${data.data.icon}`);
        $("#visi").val(data.data.visi);
        historyInstance.setData(data.data.history);
        misiInstance.setData(data.data.misi);
        demografiInstance.setData(data.data.demografi);
        geografiInstance.setData(data.data.geografi);
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

        post_data.append("history", historyInstance.getData());
        post_data.append("misi", misiInstance.getData());
        post_data.append("demografi", demografiInstance.getData());
        post_data.append("geografi", geografiInstance.getData());

        let tags_input = JSON.parse($("#tags").val());
        post_data.append("tags", tags_input.map((v) => v.value).join(","));

        let keywords_input = JSON.parse($("#keywords").val());
        post_data.append(
            "keywords",
            keywords_input.map((v) => v.value).join(",")
        );

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
