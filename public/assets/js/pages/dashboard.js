let c1_data = [];
let c2_data = [];
$(document).ready(async function () {
    await getData();

    //set desc app data
    let string = $("#dashboard_desc").html().substring(0, 150);
    let parser = new DOMParser();
    let doc = parser.parseFromString(string, "text/html");
    let content = doc.body.textContent || "";
    $("#dashboard_desc").html(content);

    chart1(c1_data);
});

/**
 * Fetches data from the dashboard API and updates the UI elements accordingly.
 * @returns {Promise<void>}
 */
async function getData() {
    try {
        // Fetch data from the API
        let { data } = await getRequestData(`${baseL}/api/dashboard`);

        // Update UI elements with the fetched data
        $("#user_count").html(data.user_count);
        $("#article_count").html(data.article_count);
        $("#category_count").html(data.category_count);
        $("#document_count").html(data.document_count);

        // Handle the last article data
        if (data.last_article !== null) {
            $("#article_title").html(data.last_article.title);

            // Truncate the article content and parse HTML
            let string = data.last_article.content.substring(0, 300);
            let parser = new DOMParser();
            let doc = parser.parseFromString(string, "text/html");
            let content = doc.body.textContent || "";

            $("#article_content").html(content + "...");

            // Set the article image background
            $("#article_image").attr(
                "style",
                `background-image: url('${data.last_article.image}')`
            );

            // Set the article link
            $("#article_link").attr(
                "href",
                baseL + "/article/" + data.last_article.id
            );
        }

        // Update the monthly article data
        data.monthly_article.forEach((element) => {
            c1_data[element.month - 1] = element.total_count;
        });

        // Generate the chart for top-rated articles
        data.visitor.forEach((element) => {
            c2_data[element.day - 1] = element.visitor;
        });
        chart2(c2_data);

        // Set the table for articles
        setTableArticle(data.articles);

        // Set the document container
        setDocument(data.documents);
    } catch (error) {
        // Display an error notification
        notif("error", "Galat!", error);
    }
}

function chart1(data) {
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            datasets: [
                {
                    label: "Artikel",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#fff",
                    data,
                    maxBarThickness: 6,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            interaction: {
                intersect: false,
                mode: "index",
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 600,
                        beginAtZero: true,
                        padding: 15,
                        font: {
                            size: 14,
                            family: "Open Sans",
                            style: "normal",
                            lineHeight: 2,
                        },
                        color: "#fff",
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: true,
                    },
                },
            },
        },
    });
}

function chart2(data) {
    // chart 2

    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, "rgba(203,12,159,0.2)");
    gradientStroke1.addColorStop(0.2, "rgba(72,72,176,0.0)");
    gradientStroke1.addColorStop(0, "rgba(203,12,159,0)"); //purple colors

    // let position = 0;
    // data.forEach((el) => {
    //     if (position === 0) {
    //         datasets[position].label = el.article_title;
    //         datasets[position].data[el.month - 1] = el.visit;
    //         position++;
    //     }

    //     if (datasets[position - 1].label == el.article_title) {
    //         datasets[--position].data[el.month - 1] = el.visit;
    //         position++;
    //     } else {
    //         datasets[position].label = el.article_title;
    //         datasets[position].data[el.month - 1] = el.visit;
    //         position++;
    //     }
    // });

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: [
                "1",
                "2",
                "3",
                "4",
                "5",
                "6",
                "7",
                "8",
                "9",
                "10",
                "11",
                "12",
                "13",
                "14",
                "15",
                "16",
                "17",
                "18",
                "19",
                "20",
                "21",
                "22",
                "23",
                "24",
                "25",
                "26",
                "27",
                "28",
                "29",
                "30",
                "31",
            ],
            datasets: [
                {
                    label: "Kunjungan",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#cb0c9f",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data,
                    maxBarThickness: 6,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            interaction: {
                intersect: false,
                mode: "index",
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: "#b2b9bf",
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: "normal",
                            lineHeight: 2,
                        },
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5],
                    },
                    ticks: {
                        display: true,
                        color: "#b2b9bf",
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: "normal",
                            lineHeight: 2,
                        },
                    },
                },
            },
        },
    });

    // end chart 2
}

function setTableArticle(data) {
    let html = ``;
    data.forEach((element) => {
        html += `<tr onclick="window.location.href='${baseL}/article/${element.id}'" class="cursor-pointer">`;
        html += `<td class="p-2 align-middle bg-transparent border-b">`;
        html += `<div class="flex px-2 py-1">`;
        html += `<div><img src="${baseL}/${element.image}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-xl" alt="xd" /></div>`;
        html += `<div class="flex flex-col justify-center"><h6 class="mb-0 text-sm leading-normal">${element.title}</h6></div>`;
        html += `</div>`;
        html += `</td>`;
        html += `<td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b">${element.category_name}</td>`;
        html += `<td class="p-2 align-middle bg-transparent border-b">
                    <div class="flex flex-col">
                        <span>${element.user_name}</span>
                        <span class="text-xs">${element.user_email}</span>
                    </div>
            </td>`;
        html += `<td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b">${element.visit} Kali</td>`;
        html += `</tr>`;
    });

    $("#tbody_article").append(html);
}

function setDocument(data) {
    let html = "";
    data.forEach((element) => {
        html += `<div class="relative mb-4 mt-0 after:clear-both after:table after:content-['']">`;
        html += `<span class="w-6.5 h-6.5 text-base absolute left-4 z-10 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-white text-center font-semibold">
                    <i class="relative z-10 leading-none text-transparent fa fa-file-pdf-o leading-pro bg-gradient-to-tl from-red-500 to-yellow-400 bg-clip-text fill-transparent"></i>
                </span>`;
        let linkFile =
            element.type == "Link"
                ? element.location
                : baseL + "/" + element.location;
        html += `<div class="ml-11.252 pt-1.4 lg:max-w-120 relative -top-1.5 w-auto">
                    <h6 class="mb-0 text-sm font-semibold leading-normal text-slate-700 cursor-pointer" onclick="window.location.href='${linkFile}'">${
            element.title
        }</h6>
                    <p class="mt-1 mb-0 text-xs font-semibold leading-tight text-slate-400">${convertDate(
                        element.date
                    )}</p>
                </div>`;
        html += `</div>`;
    });

    $("#doc_container").append(html);
}
