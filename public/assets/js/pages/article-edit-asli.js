let editorInstance;

$(document).ready(function () {
    ClassicEditor.create(document.querySelector("#editor"))

    .then((editor) => {
        editorInstance = editor;
    })
    .catch((error) => {
        console.error(error);
    });

    var input = document.getElementById("tag-input");
    const tagify = new Tagify(input, {
        backspace: "edit", // Aksi saat menekan tombol backspace
        placeholder: "Masukan Tag Artikel",
    });
    getData(); // get data
});

async function getData() {
    try {
        let id = $('#aricle-id').val();
        let data = await getRequestData(`${baseL}/api/article/${id}`);
        console.log("data api =>", data);

        // Throw an error if the request fails or the response status is not successful
        if (!data.status) {
            throw new Error(data.message);
        }

        $('#title').val(data.data.title);
        $('#date').val(data.data.date);
        editorInstance.setData(data.data.content); // Set the editor content
        tagify.addTags(data.data.tags); // Assuming `data.data.tags` is an array of tags
        // Set the category
        $('#select_category').val(data.data.category_id).trigger('change');
        // For the image and video, you might want to display a preview or handle it differently as they are file inputs.
        // You can consider adding hidden inputs to store the current file URLs or names if needed.



    } catch (error) {
        // Display an error notification
        notif("error", "Galat!", error.message);
    }

}
