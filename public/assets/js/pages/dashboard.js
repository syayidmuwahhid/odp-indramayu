let c1_data = ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0"];
$(document).ready(async function () {
    await getData();

    //set desc app data
    let string = appData.description.substring(0, 200);
    let parser = new DOMParser();
    let doc = parser.parseFromString(string, "text/html");
    let content = doc.body.textContent || "";
    $("#dashboard_desc").html(content);

    chart1(c1_data);
    chart2();
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
            let string = data.last_article.content.substring(0, 500);
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

let color;
function chart2() {
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
            datasets: [
                {
                    label: "Dataset 1",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#cb0c9f",
                    borderWidth: 3,
                    backgroundColor: gradients[0],
                    fill: true,
                    data: [
                        50, 40, 300, 220, 500, 250, 400, 230, 500, 0, 100, 190,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 2",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: gradients[1],
                    fill: true,
                    data: [
                        30, 90, 40, 140, 290, 290, 340, 230, 400, 410, 380, 100,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 3",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#ff6384",
                    borderWidth: 3,
                    backgroundColor: gradients[2],
                    fill: true,
                    data: [
                        40, 60, 80, 120, 200, 240, 180, 210, 250, 300, 350, 400,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 4",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#ffcd56",
                    borderWidth: 3,
                    backgroundColor: gradients[3],
                    fill: true,
                    data: [
                        60, 50, 90, 130, 230, 170, 290, 260, 300, 350, 400, 450,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 5",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#4bc0c0",
                    borderWidth: 3,
                    backgroundColor: gradients[4],
                    fill: true,
                    data: [
                        20, 70, 60, 110, 190, 210, 250, 300, 320, 360, 380, 410,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 6",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#9966ff",
                    borderWidth: 3,
                    backgroundColor: gradients[5],
                    fill: true,
                    data: [
                        30, 80, 70, 100, 180, 240, 260, 270, 310, 340, 370, 420,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 7",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#36a2eb",
                    borderWidth: 3,
                    backgroundColor: gradients[6],
                    fill: true,
                    data: [
                        40, 50, 80, 90, 150, 160, 170, 190, 210, 220, 250, 280,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 8",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#ff9f40",
                    borderWidth: 3,
                    backgroundColor: gradients[7],
                    fill: true,
                    data: [
                        20, 60, 70, 80, 130, 140, 150, 170, 200, 210, 230, 250,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 9",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#e74c3c",
                    borderWidth: 3,
                    backgroundColor: gradients[8],
                    fill: true,
                    data: [
                        50, 70, 100, 140, 170, 200, 230, 250, 280, 300, 320,
                        350,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 10",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#2ecc71",
                    borderWidth: 3,
                    backgroundColor: gradients[9],
                    fill: true,
                    data: [
                        30, 60, 90, 110, 140, 160, 180, 200, 220, 240, 260, 280,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 11",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3498db",
                    borderWidth: 3,
                    backgroundColor: gradients[10],
                    fill: true,
                    data: [
                        40, 50, 70, 90, 120, 150, 170, 200, 220, 250, 270, 300,
                    ],
                    maxBarThickness: 6,
                },
                {
                    label: "Dataset 12",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#8e44ad",
                    borderWidth: 3,
                    backgroundColor: gradients[11],
                    fill: true,
                    data: [
                        60, 80, 90, 200, 150, 120, 110, 140, 170, 210, 230, 260,
                    ],
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
