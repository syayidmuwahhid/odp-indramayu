$(document).ready(function () {
    //select 2 initially
    $(".select2").select2({
        placeholder: "Select an option",
    });

    //data table initially
    let tb = new DataTable(".dataTable", {
        layout: {
            topStart: null,
            topEnd: null,
            bottomStart: "pageLength",
            bottomEnd: "paging",
        },
    });

    $(".dataTable-search").on("keyup", function () {
        let searchTerm = $(this).val();
        tb.search(searchTerm).draw();
    });

    $(".dataTable-filter").on("change", () => {
        let value = $(".dataTable-filter option:selected").val();
        const column = $(".dataTable-filter").data("column");

        if (value === "all") {
            value = "";
        }

        tb.column(column).search(value).draw();
    });

    // new Quill(".editor", {
    //     debug: "info",
    //     modules: {
    //         toolbar: true,
    //     },
    //     placeholder: "Compose an epic...",
    //     theme: "snow",
    // });

    // Swal.fire("SweetAlert2 is working!");
});

//generate form with sweetalerts2
async function modal({ title, html, form }) {
    const { value: formValues } = await Swal.fire({
        title,
        html,
        focusConfirm: false,
        preConfirm: () => {
            return new FormData(document.getElementById("form"));
        },
    });
    if (formValues) {
        // let formData = new formData();
        // formData.append('name', formValues[0]);
        // formData.append('email', formValues[0]);
        console.log(formValues);
        // Swal.fire(JSON.stringify(formValues));
    }
}
