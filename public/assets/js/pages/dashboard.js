let c1_data = [
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
];
let defData = [
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
];
$(document).ready(async function () {
    await getData();

    //set desc app data
    let string = appData.description.substring(0, 150);
    let parser = new DOMParser();
    let doc = parser.parseFromString(string, "text/html");
    let content = doc.body.textContent || "";
    $("#dashboard_desc").html(content);

    chart1(c1_data);
});

async function getData() {
    try {
        let { data } = await getRequestData(`${baseL}/api/dashboard`);
        $("#user_count").html(data.user_count);
        $("#article_count").html(data.article_count);
        $("#category_count").html(data.category_count);
        $("#document_count").html(data.document_count);

        if (data.last_article !== null) {
            $("#article_title").html(data.last_article.title);
            let string = data.last_article.content.substring(0, 300);
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
        }

        data.monthly_article.forEach((element) => {
            c1_data[element.month - 1] = element.total_count;
        });

        chart2(data.top_rate_article);

        setTableArticle(data.articles);

        setDocument(data.documents);
    } catch (error) {
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

    var gradients = [];
    var colors = [
        ["rgba(203,12,159,0.2)", "rgba(72,72,176,0.0)", "rgba(203,12,159,0)"],
        ["rgba(255,99,132,0.2)", "rgba(54,162,235,0.0)", "rgba(255,99,132,0)"],
        ["rgba(255,206,86,0.2)", "rgba(75,192,192,0.0)", "rgba(255,206,86,0)"],
        [
            "rgba(153,102,255,0.2)",
            "rgba(255,159,64,0.0)",
            "rgba(153,102,255,0)",
        ],
        [
            "rgba(201,203,207,0.2)",
            "rgba(123,239,178,0.0)",
            "rgba(201,203,207,0)",
        ],
        ["rgba(210,77,87,0.2)", "rgba(142,68,173,0.0)", "rgba(210,77,87,0)"],
        ["rgba(46,204,113,0.2)", "rgba(52,152,219,0.0)", "rgba(46,204,113,0)"],
        ["rgba(243,156,18,0.2)", "rgba(44,62,80,0.0)", "rgba(243,156,18,0)"],
        ["rgba(41,128,185,0.2)", "rgba(241,196,15,0.0)", "rgba(41,128,185,0)"],
        ["rgba(39,174,96,0.2)", "rgba(192,57,43,0.0)", "rgba(39,174,96,0)"],
        ["rgba(142,68,173,0.2)", "rgba(243,156,18,0.0)", "rgba(142,68,173,0)"],
        ["rgba(241,196,15,0.2)", "rgba(46,204,113,0.0)", "rgba(241,196,15,0)"],
    ];

    // Generate gradients
    for (var i = 0; i < 12; i++) {
        var gradient = ctx2.createLinearGradient(0, 230, 0, 50);
        gradient.addColorStop(1, colors[i][0]);
        gradient.addColorStop(0.2, colors[i][1]);
        gradient.addColorStop(0, colors[i][2]);
        gradients.push(gradient);
    }

    let datasets = [
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradients[0],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradients[1],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#ff6384",
            borderWidth: 3,
            backgroundColor: gradients[2],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#ffcd56",
            borderWidth: 3,
            backgroundColor: gradients[3],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#4bc0c0",
            borderWidth: 3,
            backgroundColor: gradients[4],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#9966ff",
            borderWidth: 3,
            backgroundColor: gradients[5],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#36a2eb",
            borderWidth: 3,
            backgroundColor: gradients[6],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#ff9f40",
            borderWidth: 3,
            backgroundColor: gradients[7],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#e74c3c",
            borderWidth: 3,
            backgroundColor: gradients[8],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#2ecc71",
            borderWidth: 3,
            backgroundColor: gradients[9],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#3498db",
            borderWidth: 3,
            backgroundColor: gradients[10],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
        {
            label: "",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 5,
            borderColor: "#8e44ad",
            borderWidth: 3,
            backgroundColor: gradients[11],
            fill: true,
            data: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            maxBarThickness: 6,
        },
    ];

    let position = 0;
    data.forEach((el) => {
        if (position === 0) {
            datasets[position].label = el.article_title;
            datasets[position].data[el.month - 1] = el.visit;
            position++;
        }

        if (datasets[position - 1].label == el.article_title) {
            datasets[--position].data[el.month - 1] = el.visit;
            position++;
        } else {
            datasets[position].label = el.article_title;
            datasets[position].data[el.month - 1] = el.visit;
            position++;
        }
    });

    new Chart(ctx2, {
        type: "line",
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
            datasets,
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
        html += `<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">`;
        html += `<div class="flex px-2 py-1">`;
        html += `<div><img src="${baseL}/${element.image}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-xl" alt="xd" /></div>`;
        html += `<div class="flex flex-col justify-center"><h6 class="mb-0 text-sm leading-normal">${element.title}</h6></div>`;
        html += `</div>`;
        html += `</td>`;
        html += `<td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap">${element.category_name}</td>`;
        html += `<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">${element.user_name}</td>`;
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
