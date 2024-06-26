$(document).ready(function () {
    getData();
});

async function getData() {
    try {
        let { data } = await getRequestData(`${baseL}/api/dashboard`);
        console.log(data);
        $("#user_count").html(data.user_count);
        $("#article_count").html(data.article_count);
        $("#category_count").html(data.category_count);
        $("#document_count").html(data.document_count);

        $("#article_title").html(data.last_article.title);
        let string = data.last_article.content.substring(0, 200);
        let parser = new DOMParser();
        let doc = parser.parseFromString(string, "text/html");
        let content = doc.body.textContent || "";

        $("#article_content").html(content + "...");
        $("#article_image").attr(
            "style",
            `background-image: url('${data.last_article.image}')`
        );
        $("#article_link").attr(
            "href",
            baseL + "/article/" + data.last_article.id
        );
    } catch (error) {
        notif("error", "Galat!", error);
    }
}
