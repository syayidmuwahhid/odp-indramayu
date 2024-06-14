//define url root apps
const baseL = $("#baseL").val();

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
async function modal({ title, html, formId }) {
    console.log(formId);
    const { value: formValues } = await Swal.fire({
        title,
        html,
        focusConfirm: false,
        preConfirm: () => {
            return {
                url: baseL + $(`#${formId}`).attr("action"),
                formData: new FormData(document.getElementById(formId)),
            };
        },
    });
    if (formValues) {
        let { url, formData } = formValues;

        try {
            let response = await fetch(url);
            let data = await response.json();
            console.log(data);
        } catch (error) {
            console.log(error);
        }
    }
}
