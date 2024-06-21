$(document).ready(function () {
    getData(); // get data
});

/**
 * Function to fetch and display article data in the table.
 *
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function getData() {
    try {
        // Fetch article data from the server
        let data = await getRequestData(`${baseL}/api/article`);

        // Throw an error if the request fails or the response status is not successful
        if (!data.status) {
            throw new Error(data.message);
        }

        // Clear the table body
        $("#tbody_data").empty();

        // Iterate over the fetched data and generate HTML for each row
        data.data.forEach((value, i) => {
            let html = `<tr>`;
            html += `<td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${++i}</td>`;
            html += `<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${value.title}</td>`;
            html += `<td class=" align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">`;

            // EDIT BUTTON
            html += `<a href="${baseL}/admin/article/${value.id}/edit"
            class="inline-block px-8 py-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-green-500 text-green-500 hover:text-green-900 hover:opacity-75 hover:shadow-none active:scale-100 active:border-green-900 active:bg-green-900 active:text-white hover:active:border-green-900 hover:active:bg-transparent hover:active:text-green-900 hover:active:opacity-75">Edit</a> | `;

            html += `<button class="text-sm font-semibold leading-tight text-red-400" onclick="hapusData(${value.id})">Hapus</button>`;
            html += `</td>`;
            html += `</tr>`;

            // Append the generated HTML to the table body
            $("#tbody_data").append(html);
        });
    } catch (error) {
        // Display an error notification
        notif("error", "Galat!", error.message);
    }
}

/**
 * Function to handle category deletion.
 * It shows a confirmation dialog, sends a DELETE request to the server, and refreshes the article data table.
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
                `${baseL}/api/article/${id}`,
                null,
                "DELETE"
            );

            // Check if the request was successful
            if (!data.status) {
                // If not, throw an error
                throw new Error(data.message);
            }

            // Show a success notification
            notif("success", "Berhasil", data.message);

            // Refresh the article data table
            getData();
        });
    } catch (error) {
        // If an error occurs, log it
        console.error(error);
    }
}
