$(document).ready(function () {
    getData(); // get data
});


/**
 * Function to fetch and display category data in the table.
 *
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function getData() {
    try {
        // Fetch category data from the server
        let data = await getRequestData(`${baseL}/api/tag`);

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
            html += `<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${value.name}</td>`;
            html += `<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${value.article_name}</td>`;
            html += `</tr>`;

            // Append the generated HTML to the table body
            $("#tbody_data").append(html);
        });
    } catch (error) {
        // Display an error notification
        notif("error", "Galat!", error);
    }
}
