let table;
$(document).ready(function () {
    $("#btnAddModal").click(formModal); //show modal when btn is clicked
    getData(); // get data

    table = $("#table_container").html();
});

/**
 * Function to show modal form for adding new user.
 * It prepares the HTML for the form and calls the modal function to display it.
 *
 * @returns {void}
 */
function formModal() {
    // Prepare the HTML for the form
    let html = `<form id="formModal">`;
    html += `<label>Name</label>`;
    html += `<input class="swal2-input" placeholder="name" name="name"> <br/>`;
    html += `<label>Email</label>`;
    html += `<input class="swal2-input" placeholder="email" name="email"> <br/>`;
    html += `<label>Password</label>`;
    html += `<input class="swal2-input" placeholder="Password" name="password" value="12345678">`;
    html += `</form>`;

    // Call the modal function to display the form
    modal({
        title: "Form Tambah User",
        formId: "formModal",
        method: "POST",
        url: "/api/user",
        html,
        callback: getData,
    });
}

/**
 * Function to show modal form for editing an existing user.
 * It prepares the HTML for the form, fetches user data from the server, and calls the modal function to display it.
 *
 * @param {number} id - The unique identifier of the user to be edited.
 * @returns {Promise<void>}
 */
async function editModal(id) {
    try {
        // Fetch user data from the server
        let { data } = await getRequestData(`${baseL}/api/user/${id}`);

        // Prepare the HTML for the form with user data
        let html = `<form id="editModal">`;
        html += `<label>Name</label>`;
        html += `<input class="swal2-input" placeholder="name" name="name" value="${data.name}"> <br/>`;
        html += `<label>Email</label>`;
        html += `<input class="swal2-input" placeholder="email" name="email" value="${data.email}"> <br/>`;
        html += `<label>Password</label>`;
        html += `<input class="swal2-input" placeholder="Password" name="password">`;
        html += `</form>`;

        // Call the modal function to display the form
        modal({
            title: "Form Edit User",
            formId: "editModal",
            method: "POST",
            url: `/api/user/${id}`,
            html,
            callback: getData,
        });
    } catch (error) {
        // Display error notification
        notif("error", "Galat!", error);
    }
}

/**
 * Function to fetch and display user data in the table.
 *
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function getData() {
    try {
        // Fetch user data from the server
        let data = await getRequestData(`${baseL}/api/user`);

        // Throw an error if the request fails or the response status is not successful
        if (!data.status) {
            throw new Error(data.message);
        }

        // Clear the table body
        $("#table_container").empty().html(table);

        // Iterate over the fetched data and generate HTML for each row
        data.data.forEach((value, i) => {
            let html = `<tr>`;
            html += `<td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${++i}</td>`;
            html += `<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${value.name}</td>`;
            html += `<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${value.email}</td>`;
            html += `<td class=" align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">`;
            html += `<button class="text-sm font-semibold leading-tight text-blue-600" onclick="editModal(${value.id})">Edit</button> | `;
            html += `<button class="text-sm font-semibold leading-tight text-red-400" onclick="hapusData(${value.id})">Hapus</button>`;
            html += `</td>`;
            html += `</tr>`;

            // Append the generated HTML to the table body
            $("#tbody_data").append(html);
        });

        $("#table_data").dataTable();
    } catch (error) {
        // Display an error notification
        notif("error", "Galat!", error);
    }
}

/**
 * Function to handle user deletion.
 * It shows a confirmation dialog, sends a DELETE request to the server, and refreshes the user data table.
 *
 * @param {number} id - The unique identifier of the user to be deleted.
 * @returns {void}
 */
function hapusData(id) {
    try {
        // Show a confirmation dialog
        confirm("Hapus?", "Yakin menghapus data?", async function () {
            // Send a DELETE request to the server
            let data = await postData(
                `${baseL}/api/user/${id}`,
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

            // Refresh the user data table
            getData();
        });
    } catch (error) {
        // If an error occurs, log it
        console.error(error);
    }
}
