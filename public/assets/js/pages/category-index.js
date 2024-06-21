$(document).ready(function () {
    $("#btnAddModal").click(formModal); //show modal when btn is clicked
    getData(); // get data
});

/**
 * Function to show modal form for adding new category.
 * It prepares the HTML for the form and calls the modal function to display it.
 *
 * @returns {void}
 */
function formModal() {
    // Prepare the HTML for the form
    let html = `<form id="formModal">`;
    html += `<label>Name</label>`;
    html += `<input class="swal2-input" placeholder="name" name="name"> <br/>`;
    html += `</form>`;


    // Call the modal function to display the form
    modal({
        title: "Form Tambah category",
        formId: "formModal",
        method: "POST",
        url: "/api/category",
        html,
        callback: getData,
    });
}

/**
 * Function to show modal form for editing an existing category.
 * It prepares the HTML for the form, fetches category data from the server, and calls the modal function to display it.
 *
 * @param {number} id - The unique identifier of the category to be edited.
 * @returns {Promise<void>}
 */
async function editModal(id) {
    try {
        // Fetch category data from the server
        let { data } = await getRequestData(`${baseL}/api/category/${id}`);

        // Prepare the HTML for the form with category data
        let html = `<form id="editModal">`;
        html += `<label>Name</label>`;
        html += `<input class="swal2-input" placeholder="name" name="name" value="${data.name}"> <br/>`;
        html += `</form>`;

        // Call the modal function to display the form
        modal({
            title: "Form Edit category",
            formId: "editModal",
            method: "POST",
            url: `/api/category/${id}`,
            html,
            callback: getData,
        });
    } catch (error) {
        // Display error notification
        notif("error", "Galat!", error);
    }
}

/**
 * Function to fetch and display category data in the table.
 *
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function getData() {
    try {
        // Fetch category data from the server
        let data = await getRequestData(`${baseL}/api/category`);

        // Throw an error if the request fails or the response status is not successful
        if (!data.status) {
            throw new Error(data.message);
        }

        // Clear the table body
        $("#tbody_data").empty();

        // Iterate over the fetched data and generate HTML for each row
        data.data.forEach((value, i) => {
            let html = `<tr>
                <td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${++i}</td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${value.name}</td>
                <td class="text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <button class="inline-block px-2 py-2 mt-2 mb-2 font-bold text-center  align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-yellow-500 text-yellow-500 hover:text-yellow-900 hover:opacity-75 hover:shadow-none active:scale-100 active:border-yellow-900 active:bg-yellow-900 active:text-yellow hover:active:border-yellow-900 hover:active:bg-transparent hover:active:text-yellow-900 hover:active:opacity-75" onclick="editModal(${value.id})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block text-orange-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232a1.5 1.5 0 112.121 2.121L8.49 16.215a4.5 4.5 0 01-1.086 1.086l-2.768 1.384a.75.75 0 01-1.05-1.05l1.384-2.768a4.5 4.5 0 011.086-1.086l8.803-8.803z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 11.25h-5.25a1.5 1.5 0 00-1.5 1.5v5.25" />
                        </svg>
                    </button>
                    <button class="inline-block px-2 py-2 mt-2 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-red-500 text-red-500 hover:text-red-900 hover:opacity-75 hover:shadow-none active:scale-100 active:border-red-900 active:bg-red-900 active:text-white hover:active:border-red-900 hover:active:bg-transparent hover:active:text-red-900 hover:active:opacity-75" onclick="hapusData(${value.id})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    </button>
                </td>
            </tr>`;

            // Append the generated HTML to the table body
            $("#tbody_data").append(html);
        });
    } catch (error) {
        // Display an error notification
        notif("error", "Galat!", error);
    }
}

/**
 * Function to handle category deletion.
 * It shows a confirmation dialog, sends a DELETE request to the server, and refreshes the category data table.
 *
 * @param {number} id - The unique identifier of the category to be deleted.
 * @returns {void}
 */
function hapusData(id) {
    try {
        // Show a confirmation dialog
        confirm("Hapus?", "Yakin menghapus data?", async function () {
            // Send a DELETE request to the server
            let data = await postData(
                `${baseL}/api/category/${id}`,
                null,
                "DELETE"
            );

            // Check if the request was successful
            if (!data.status) {
                // If not, throw an error
                throw new Error(data.message);
            }

            // Show a success notification
            notif("success", "Berhasil");

            // Refresh the category data table
            getData();
        });
    } catch (error) {
        // If an error occurs, log it
        console.error(error);
    }
}
