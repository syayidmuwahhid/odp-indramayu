//define url root apps
const baseL = $("#baseL").val();

$(document).ready(function () {
    //select 2 initially
    // $(".select2").select2({
    //     placeholder: "Select an option",
    // });
    //data table initially
    // setDataTable(".dataTable");
    // new Quill(".editor", {
    //     debug: "info",
    //     modules: {
    //         toolbar: true,
    //     },
    //     placeholder: "Compose an epic...",
    //     theme: "snow",
    // });
});

/**
 * Displays a notification using SweetAlert2.
 *
 * @param {string} type - The type of notification (success, error, warning, info).
 * @param {string} title - The title of the notification.
 * @param {string} message - The message to be displayed in the notification.
 *
 * @returns {void}
 */
function notif(type, title, message) {
    Swal.fire({
        icon: type,
        title: title,
        text: message,
    });
}

/**
 * Displays a confirmation dialog using SweetAlert2.
 *
 * @param {string} title - The title of the confirmation dialog.
 * @param {string} text - The text to be displayed in the confirmation dialog.
 * @param {function} [callback] - A callback function to be executed when the user confirms the action.
 *
 * @returns {void}
 */
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

// function setDataTable(id) {
//     let tb = new DataTable(id, {
//         layout: {
//             topStart: null,
//             topEnd: null,
//             bottomStart: "pageLength",
//             bottomEnd: "paging",
//         },
//         destroy: true,
//     });

//     $(".dataTable-search").on("keyup", function () {
//         let searchTerm = $(this).val();
//         tb.search(searchTerm).draw();
//     });

//     $(".dataTable-filter").on("change", () => {
//         let value = $(".dataTable-filter option:selected").val();
//         const column = $(".dataTable-filter").data("column");

//         if (value === "all") {
//             value = "";
//         }

//         tb.column(column).search(value).draw();
//     });
// }

/**
 * Displays a modal form using SweetAlert2 and handles form submission.
 *
 * @param {Object} options - An object containing configuration options for the modal.
 * @param {string} options.title - The title of the modal.
 * @param {string} options.html - The HTML content to be displayed in the modal.
 * @param {string} options.formId - The ID of the form within the modal.
 * @param {string} options.url - The URL to submit the form data to.
 * @param {string} options.method - The HTTP method to use for form submission (e.g., 'POST', 'GET').
 * @param {function} [options.callback] - An optional callback function to be executed after successful form submission.
 *
 * @returns {void}
 */
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

/**
 * Makes a GET request to the specified URL and returns the response data as JSON.
 *
 * @param {string} url - The URL to make the GET request to.
 * @returns {Promise<Object>} - A Promise that resolves to the response data as JSON.
 * @throws {Error} - If the request fails or the response status is not successful.
 */
async function getRequestData(url) {
    let response = await fetch(url);
    let data = await response.json();

    // Check if the request was successful
    if (!data.status) {
        // If not successful, throw an error with the response message
        throw new Error(data.message);
    }

    // If successful, return the response data
    return data;
}

/**
 * Makes a POST request to the specified URL with form data and returns the response data as JSON.
 *
 * @param {string} url - The URL to make the POST request to.
 * @param {FormData} formData - The form data to be sent in the request body.
 * @param {string} method - The HTTP method to use for the request (e.g., 'POST', 'GET').
 *
 * @returns {Promise<Object>} - A Promise that resolves to the response data as JSON.
 * @throws {Error} - If the request fails or the response status is not successful.
 *
 * @example
 * const formData = new FormData();
 * formData.append('key', 'value');
 *
 * postData('/api/endpoint', formData, 'POST')
 *   .then(data => console.log(data))
 *   .catch(error => console.error(error));
 */
async function postData(url, formData, method) {
    let response = await fetch(url, {
        method,
        body: formData,
    });

    let data = await response.json();

    // Check if the request was successful
    if (!data.status) {
        // If not successful, throw an error with the response message
        throw new Error(data.message);
    }

    // If successful, return the response data
    return data;
}
