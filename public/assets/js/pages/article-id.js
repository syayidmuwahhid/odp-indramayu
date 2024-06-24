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
        // let articleID = $("#article_id").val();
        let articleID = $("#container").data("id");
        // Fetch article data from the server
        let {data} = await getRequestData(`${baseL}/api/article/${articleID}`);
        console.log("ini adalah data article-id", data);

        $("#article-image").attr("src", baseL + "/" + data.image);
        $("#title").html(data.title);
        $("#content").html(data.content);
        $("#date").html(data.date);


    } catch (error) {
        notif("error", "Galat!", error.message);
    }
}
