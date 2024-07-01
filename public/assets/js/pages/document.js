$("#document").ready(function () {
    getData();
});

async function getData() {
    try {
        let { data } = await getRequestData(`${baseL}/api/document`);

        let html = ``;
        data.reverse().forEach((element) => {
            if (element.status === "Publik") {
                let linkFile =
                    element.type == "Link"
                        ? element.location
                        : baseL + "/" + element.location;
                html += `<tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 18H5V4h7v16zm7-4h-5V4h5v12zm-6-6H5V4h8v6z"/>
                            </svg>
                            <span class="ml-2">${element.title}</span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            ${element.author}
                        </td>
                        <td class="py-3 px-6 text-left">
                            ${convertDate(element.date)}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <a href="${linkFile}" target="_blank" class="text-white px-4 py-2 rounded" style="backgroundColor: "c96423"">Download</a>
                        </td>
                    </tr>`;
            }
        });
        $("#tbody_document").append(html);
        $("#document_table").dataTable();
    } catch (error) {
        notif("error", "Galat", error);
    }
}
