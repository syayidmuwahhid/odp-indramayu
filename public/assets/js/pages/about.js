$(document).ready(async function () {
    getData();
});

/**
 * Fetches and processes data from the server to populate the webpage.
 *
 * @async
 * @returns {void}
 */
async function getData() {
    try {
        // Fetch data from the server using the getRequestData function
        const { data } = await getRequestData(`${baseL}/api/setting`);

        // Populate the webpage with the fetched data
        $("#title").html(data.title);
        $("#description").html(data.description);
        $("#history").html(data.history);
        $("#visi").html(data.visi);
        $("#misi").html(data.misi);
        $("#geografi").html(data.geografi);
        $("#demografi").html(data.demografi);
    } catch (error) {
        // Display an error notification if the data fetching fails
        notif("e-rror", "Galat!", error);
    }
}
