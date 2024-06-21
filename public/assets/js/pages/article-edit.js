let editorInstance;

$(document).ready(function () {
    ClassicEditor.create(document.querySelector("#editor"), {
        removePlugins: [
            'Image',
            'ImageCaption',
            'ImageStyle',
            'ImageToolbar',
            'ImageUpload',
            'EasyImage',
            'Base64UploadAdapter',
            'CKFinder',
            'CKFinderUploadAdapter'
        ],
        toolbar: {
            items: [
            'undo', 'redo', '|' ,
                'heading', '|',
                'bold', 'italic', 'link', '|',
                'bulletedList', 'numberedList', 'blockQuote', '|',
                'undo', 'redo'
            ]
        }
    })

//     toolbar: {
//         items: [
//             'undo', 'redo',
//             '|', 'heading',
//             '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
//             '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
//             '|', 'link', 'uploadImage', 'blockQuote', 'codeBlock',
//             '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
//         ],
//     shouldNotGroupWhenFull: false
// }
    .then((editor) => {
        editorInstance = editor;
        getData(); // get data after the editor instance is created
    })
    .catch((error) => {
        console.error(error);
    });

    var input = document.getElementById("tag-input");
    const tagify = new Tagify(input, {
        backspace: "edit",
        placeholder: "Masukan Tag Artikel",
    });
});

async function getData() {
    try {
        let id = $('#aricle-id').val();
        let data = await getRequestData(`${baseL}/api/article/${id}`);

        // Throw an error if the request fails or the response status is not successful
        if (!data.status) {
            throw new Error(data.message);
        }

        $('#title').val(data.data.title);
        $('#date').val(data.data.date);

        if (editorInstance) {
            editorInstance.setData(data.data.content); // Set the editor content
        }

        tagify.addTags(data.data.tags); // Assuming `data.data.tags` is an array of tags
        $('#select_category').val(data.data.category_id).trigger('change');

        console.log(data);

    } catch (error) {
        // Display an error notification
        notif("error", "Galat!", error.message);
    }
}
