$(document).ready(async function () {
    await getData();
});

async function getData() {
    try {
        const data = await getAppData();
        $('#title').html(data.title);
        $('#description').html(data.description);
        $('#history').html(data.history);
        $('#visi').html(data.visi);
        $('#misi').html(data.misi);
        $('#geografi').html(data.geografi);
        $('#demografi').html(data.demografi);

        console.log("data geografi", data.geografi);
        console.log("data demografi", data.demografi);

    } catch (error) {
        notif('e-rror', 'Galat!', error);
    }
}
