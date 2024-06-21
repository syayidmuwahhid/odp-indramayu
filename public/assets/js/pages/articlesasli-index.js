$(document).ready(function () {
    getData(); // get data
});

async function getData() {
    try {
        let data = await getRequestData(`${baseL}/api/article`);

        if (!data.status) {
            throw new Error(data.message);
        }

        $("#tbody_data").empty();

        data.data.forEach((value, i) => {
            let html = `<tr>`;
            html += `<td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${++i}</td>`;
            html += `<td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${value.title}</td>`;
            html += `<td class=" align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">`;

            // EDIT BUTTON
            html += `<a href="{{ route('admin.article.update', ['id' => ${value.id}]) }}"
            class="inline-block px-8 py-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-green-500 text-green-500 hover:text-green-900 hover:opacity-75 hover:shadow-none active:scale-100 active:border-green-900 active:bg-green-900 active:text-white hover:active:border-green-900 hover:active:bg-transparent hover:active:text-green-900 hover:active:opacity-75">Edit</a> | `;

            html += `<button class="text-sm font-semibold leading-tight text-red-400" onclick="hapusData(${value.id})">Hapus</button>`;
            html += `</td>`;
            html += `</tr>`;

            $("#tbody_data").append(html);
        });
    } catch (error) {
        notif("error", "Galat!", error.message);
    }
}

async function editModal(id) {
    try {
        let { data } = await getRequestData(`${baseL}/api/article/${id}`);

        let html = `<form id="editModal">`;
        html += `<label>Name</label>`;
        html += `<input class="swal2-input" placeholder="name" name="name" value="${data.name}"> <br/>`;
        html += `</form>`;

        modal({
            title: "Form Edit article",
            formId: "editModal",
            method: "POST",
            url: `/api/article/${id}`,
            html,
            callback: getData,
        });
    } catch (error) {
        notif("error", "Galat!", error.message);
    }
}

function hapusData(id) {
    try {
        confirm("Hapus?", "Yakin menghapus data?", async function () {
            let data = await postData(
                `${baseL}/api/article/${id}`,
                null,
                "DELETE"
            );

            if (!data.status) {
                throw new Error(data.message);
            }

            notif("success", "Berhasil", data.message);
            getData();
        });
    } catch (error) {
        console.error(error);
    }
}
