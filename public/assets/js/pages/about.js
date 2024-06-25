$(document).ready(async function () {

    await getData();



});

async function getData() {
    try {
        const data = await getAppData();
        let html = data.history;
        $('#title').html(data.title);
        $('#description').html(data.description);
        $('#history').html(data.history);
    } catch (error) {
        notif('e-rror', 'Galat!', error);
    }
}
