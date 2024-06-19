$(document).ready(function () {
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });

    getCategoryList();
});

async function getCategoryList() {
    let { data } = await getRequestData(`${baseL}/api/category/list`);
    $("#select_category").select2({
        width: "100%",
        placehplder: "pilih kategori",
        data,
    });
}
