let table;
$(document).ready(function () {
    $("#btnAddModal").click(formModal); //show modal when btn is clicked
    getData(); // get data
    table = $("#table_container").html();
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
    html += `<label>Nama <span class="text-sm text-red-500">*</span></label>`;
    html += `<input class="swal2-input" placeholder="name" name="name" onkeydown="if(event.key === 'Enter') event.preventDefault();"> <br/>`;
    html += `</form>`;

    // Call the modal function to display the form
    modal({
        title: "Form Tambah Kategori",
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
        html += `<label>Nama <span class="text-sm text-red-500">*</span></label>`;
        html += `<input class="swal2-input" placeholder="name" name="name" value="${data.name}"> <br/>`;
        html += `<input type="hidden" name="_method" value="PUT">`;
        html += `</form>`;

        // Call the modal function to display the form
        modal({
            title: "Form Edit Kategori",
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

        $("#table_container").empty().html(table);

        // Iterate over the fetched data and generate HTML for each row
        data.data.reverse().forEach((value, i) => {
            let html = `<tr>
                <td class="text-center ">${++i}</td>
                <td class="">${value.name}</td>
                <td class="">
                    <button class="inline-block px-2 py-2 mt-2 mb-2 font-bold text-center align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-yellow-500 text-yellow-500 hover:text-yellow-900 hover:opacity-75 hover:shadow-none active:scale-100 active:border-yellow-900 active:bg-yellow-900 active:text-yellow hover:active:border-yellow-900 hover:active:bg-transparent hover:active:text-yellow-900 hover:active:opacity-75"
                        style="border-color: #f1c40f; color: #f1c40f;" onclick="editModal(${
                            value.id
                        })">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg>
                    </button>
                    <button class="inline-block px-2 py-2 mt-2 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs hover:opacity-75 hover:shadow-none active:scale-100 hover:active:border-red-900 hover:active:bg-transparent hover:active:text-red-900 hover:active:opacity-75"
                        style="border-color: #ef4444; color: #ef4444;"
                        onclick="hapusData(${value.id})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                    </button>
                </td>
            </tr>`;

            // Append the generated HTML to the table body
            $("#tbody_data").append(html);
        });

        $("#table_data").dataTable({
            columnDefs: [{ width: 50, targets: [0] }],
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
