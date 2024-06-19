$(document).ready(function () {
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });

    getCategoryList();
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
