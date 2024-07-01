let articleID = $("#container").data("id");

$(document).ready(function () {
    getData(); // get data

    setCounter();
});

/**
 * Function to fetch and display article data in the table.
 *
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function getData() {
    try {
        // Fetch article ID from the container data attribute
        let articleID = $("#container").data("id");

        // Make a GET request to fetch article data
        let { data } = await getRequestData(
            `${baseL}/api/article/${articleID}/slug`
        );

        // Generate HTML for tags
        const tagElements = data.tags
            .map((tag) => {
                return `<a href="/article?tag=${tag.name}" class="tag-article">${tag.name}</a>`;
            })
            .join("");

        // Generate HTML for date with SVG icon
        const svg = `<svg class="mr-1.5" width="14" height="16" viewBox="0 0 14 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg"><path
                        d="M12.5 2H11V0.375C11 0.16875 10.8313 0 10.625 0H9.375C9.16875 0 9 0.16875 9 0.375V2H5V0.375C5 0.16875 4.83125 0 4.625 0H3.375C3.16875 0 3 0.16875 3 0.375V2H1.5C0.671875 2 0 2.67188 0 3.5V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V3.5C14 2.67188 13.3281 2 12.5 2ZM12.3125 14.5H1.6875C1.58438 14.5 1.5 14.4156 1.5 14.3125V5H12.5V14.3125C12.5 14.4156 12.4156 14.5 12.3125 14.5Z"
                        fill="#939393" /></svg> <p>${convertDate(
                            data.date
                        )}</p>`;

        // Update HTML elements with fetched data
        $("#article-image").attr("src", baseL + "/" + data.image);
        $("#title").html(data.title);
        $("#content").html(data.content);
        $("#date").html(svg);
        $("#username").html(data.user.name);
        $("#tags").append(tagElements);

        // Check if video is available and update HTML accordingly
        if (data.video) {
            $("#video").attr("src", baseL + "/" + data.video); // Show the video element
        } else {
            $("#video").hide(); // Hide the video element if no video is available
        }
    } catch (error) {
        // Show error notification
        notif("error", "Galat!", error.message);
        window.location.href = "/article";
    }
}

/**
 * Function to set the counter for the article.
 * This function sends a POST request to the server to increment the counter for the specified article.
 *
 * @returns {Promise<void>}
 * @throws Will throw an error if the request fails or the response status is not successful.
 */
async function setCounter() {
    try {
        // Create a new FormData object to hold the POST data
        let post_data = new FormData();

        // Append the article ID and table name to the FormData object
        post_data.append("table_id", articleID);
        post_data.append("table_name", "article");

        // Make a POST request to the server to increment the counter
        let data = await postData(`${baseL}/api/counter`, post_data);

        // Check if the request was successful
        if (!data.status) {
            // If the request was not successful, throw an error with the server's message
            throw new Error(data.message);
        }
    } catch (error) {
        // If an error occurred during the request, log the error message to the console
        console.log("Galat!", error);
    }
}
