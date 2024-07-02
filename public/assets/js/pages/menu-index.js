let table;
$(document).ready(function () {
    $("#btnAddModal").click(formModal); //show modal when btn is clicked
    getData(); // get data

    table = $("#table_container").html();
});

function formModal() {
    let html = `
    <form id="formModal">
    <div style="display: flex; align-items: center; margin: 1rem 2.1rem; width: 420px;">
        <label>Nama</label>
        <input class="swal2-input" style="flex:1;" placeholder="Nama" name="title">
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label>Deskripsi</label>
        <textarea class="swal2-textarea" style="flex:1;" placeholder="Deskripsi" name="description"></textarea>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label style="width: 90px; margin-right: 1rem;">Url</label>
        <input class="swal2-input" style="flex:1;" placeholder="Url" name="url">
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label style="width: 90px; margin-right: 1rem;">Status</label>
        <select name="status" placeholder="Status" class="swal2-select">
            <option value="active">Aktif</option>
            <option value="inctive">Non Aktif</option>
        </select>
    </div>
    </form>
    `;

    modal({
        title: "Tambah Menu",
        formId: "formModal",
        method: "POST",
        url: "/api/menu",
        html,
        callback: getData,
    });
}

async function getData() {
    try {
        let data = await getRequestData(`${baseL}/api/menu`);

        if (!data.status) {
            throw new Error(data.message);
        }

        $("#table_container").empty().html(table);

        data.data.reverse().forEach((value, i) => {
            let color = value.status == "active" ? "#00fc04" : "#6b706b";
            let html = `<tr>
                <td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${++i}</td>
                <td class="px-4">${value.title}</td>
                <td class="px-4">${value.description}</td>
                <td class="px-4">${value.url}</td>
                <td ><span style="border-color: ${color}; color: ${color}; border-style: solid; border-width: 1px; border-radius: 50px; padding: 2px 8px; display: inline-block; font-size: 12px;">${
                value.status == "active" ? "Aktif" : "Non Aktif"
            }</span></td>
                <td class="whitespace-nowrap">
                    <button class="inline-block px-2 py-2 mt-2 mb-2 font-bold text-center align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-yellow-500 text-yellow-500 hover:text-yellow-900 hover:opacity-75 hover:shadow-none active:scale-100 active:border-yellow-900 active:bg-yellow-900 active:text-yellow hover:active:border-yellow-900 hover:active:bg-transparent hover:active:text-yellow-900 hover:active:opacity-75"
                        style="border-color: #f1c40f; color: #f1c40f;" onclick="editModal(${
                            value.id
                        })">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg>
                    </button>
                    <button class="inline-block px-2 py-2 mt-2 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs hover:opacity-75 hover:shadow-none active:scale-100 hover:active:border-red-900 hover:active:bg-transparent hover:active:text-red-900 hover:active:opacity-75"
                        style="border-color: #ef4444; color: #ef4444;"
                        onclick="hapusData(${value.id})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                    </button>
                </td>
            </tr>
            `;
            $("#tbody_data").append(html);
        });
        $("#table_data").dataTable();
    } catch (error) {
        notif("error", "Galat!", error);
    }
}

async function editModal(id) {
    try {
        let { data } = await getRequestData(`${baseL}/api/menu/${id}`);

        let html = `
        <form id="editModal" enctype="multipart/form-data">
        <div style="display: flex; align-items: center; margin: 1rem 2.1rem; width: 420px;">
            <label>Nama</label>
            <input class="swal2-input" style="flex:1;" placeholder="Nama" name="title" value="${
                data.title
            }">
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
            <label>Deskripsi</label>
            <textarea class="swal2-textarea" style="flex:1;" placeholder="Deskripsi" name="description">${
                data.description
            }</textarea>
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
            <label style="width: 90px; margin-right: 1rem;">Url</label>
            <input class="swal2-input" style="flex:1;" placeholder="Url" name="url" value="${
                data.url
            }">
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
            <label style="width: 90px; margin-right: 1rem;">Status</label>
            <select name="status" placeholder="Status" class="swal2-select">
                <option value="${data.status}">${
            data.status == "active" ? "Aktif" : "Non Aktif"
        }</option>
                <option value="${
                    data.status == "active" ? "inactive" : "active"
                }">${data.status == "active" ? "Non Aktif" : "Aktif"}</option>
            </select>
        </div>
        <input type="hidden" name="_method" value="PUT">
        </form>
        `;

        modal({
            title: "Edit Menu",
            formId: "editModal",
            method: "POST",
            url: `/api/menu/${id}`,
            html,
            callback: getData,
        });
    } catch (error) {
        notif("error", "Galat!", error);
    }
}

async function hapusData(id) {
    try {
        confirm("Hapus?", "Yakin hapus data ini?", async function () {
            let data = await postData(
                `${baseL}/api/menu/${id}`,
                null,
                "DELETE"
            );

            if (!data.status) {
                throw new Error(data.message);
            }

            notif("success", "Berhasil!", data.message);

            getData();
        });
    } catch (error) {
        notif("error", "Galat!", error);
    }
}
