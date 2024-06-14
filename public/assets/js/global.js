//define url root apps
const baseL = $("#baseL").val();

$(document).ready(function () {
    //select 2 initially
    $(".select2").select2({
        placeholder: "Select an option",
    });

    //data table initially
    setDataTable(".dataTable");

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

function notif(type, title, message) {
    Swal.fire({
        icon: type,
        title: title,
        text: message,
    });
}

function confirm(title, text, callback = () => {}) {
    Swal.fire({
        title,
        text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
}

function setDataTable(id) {
    let tb = new DataTable(id, {
        layout: {
            topStart: null,
            topEnd: null,
            bottomStart: "pageLength",
            bottomEnd: "paging",
        },
        destroy: true,
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
}

//generate form with sweetalerts2
async function modal({
    title,
    html,
    formId,
    url,
    method,
    callback = () => {},
}) {
    const { value: formValues } = await Swal.fire({
        title,
        html,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Save",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            let form = document.getElementById(formId);
            return {
                url,
                method,
                formData: new FormData(form),
            };
        },
        allowOutsideClick: () => !Swal.isLoading(),
    });

    if (formValues) {
        let { url, formData, method } = formValues;

        try {
            let data = await postData(url, formData, method);

            notif("success", "Berhasil!", data.message);
            callback();
        } catch (error) {
            notif("error", "Galat!", error);
        }
    }
}

async function getRequestData(url) {
    let response = await fetch(url);
    let data = await response.json();

    if (!data.status) {
        throw new Error(data.message);
    }

    return data;
}

async function postData(url, formData, method) {
    let response = await fetch(url, {
        method,
        body: formData,
    });

    let data = await response.json();

    if (!data.status) {
        throw new Error(data.message);
    }

    return data;
}
