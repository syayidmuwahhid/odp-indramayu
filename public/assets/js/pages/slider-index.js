let table;
$(document).ready(function () {
    $("#btnAddModal").click(formModal); //show modal when btn is clicked
    getData(); // get data

    table = $("#table_container").html();
});

function closeDialog(event, id) {
    const modal = document.getElementById(id);
    if (event.target === modal) {
        modal.close();
    }
}

function formModal() {
    let html = `
    <form id="formModal" enctype="multipart/form-data">
    <div style="display: flex; align-items: center; margin: 1rem 2.1rem; width: 420px;">
        <label>Judul <span class="text-sm text-red-500">*</span></label>
        <input class="swal2-input" style="flex:1;" placeholder="Judul" name="title"> <br/>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label>Deskripsi <span class="text-sm text-red-500">*</span></label>
        <textarea class="swal2-textarea" style="flex:1;" placeholder="Deskripsi" name="description"></textarea>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label style="width: 90px; margin-right: 1rem;">Slider <span class="text-sm text-red-500">*</span></label>
        <input type="file" class="swal2-file" style="width: 280px;" name="file" accept=".jpeg,.png,.jpg,.gif,.svg,.avi,.mpeg,.quicktime,.mp4"> <br/>
    </div>
    </form>
    `;

    modal({
        title: "Tambah Slider",
        formId: "formModal",
        method: "POST",
        url: "/api/slider",
        html,
        callback: getData,
    });
}

async function getData() {
    try {
        let data = await getRequestData(`${baseL}/api/slider`);

        if (!data.status) {
            throw new Error(data.message);
        }

        $("#table_container").empty().html(table);

        data.data.reverse().forEach((value, i) => {
            let src = baseL + "/" + value.location;
            let res = `<img src="${baseL}/${value.location}" alt="${value.description}" class="modal-image" style="width: 100%; height: 90vh; max-width: 100%;object-fit: contain;">`;

            if (value.type == "video") {
                src =
                    "https://static.vecteezy.com/system/resources/previews/002/162/107/original/camera-video-illustration-hand-drawing-vector.jpg";
                res = `<video src="${baseL}/${value.location}" controls class="modal-image" style="width: 100%; height: 90vh; max-width: 100%;object-fit: contain;" ></video>`;
            }

            let html = `<tr>
                <td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${++i}</td>
                <td class="py-4">

                <img src="${src}" alt="${
                value.description
            }" class="max-w-full max-h-full p-2  bg-cover object-cover bg-center cursor-pointer" onclick="myModal${i}.showModal()">

                    <dialog id="myModal${i}" class="modal" style="width: 100vh; max-width: 800px; background-color: transparent; border: none; padding: 0; overflow: hidden;" onclick="closeDialog(event, 'myModal${i}')">
                        <div class="modal-box" style="padding: 0; display: flex; justify-content: center; align-items: center; background-color: transparent;">
                             ${res}
                        </div>
                    </dialog>
                </td>
                <td class="px-4">${value.title}</td>
                <td class="px-4">${value.description}</td>
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
        let { data } = await getRequestData(`${baseL}/api/slider/${id}`);

        let html = `
        <form id="editModal" enctype="multipart/form-data">
        <div style="display: flex; align-items: center; margin: 1rem 2.1rem; width: 420px;">
            <label>Judul <span class="text-sm text-red-500">*</span></label>
            <input class="swal2-input" style="flex:1;" placeholder="Judul" name="title" value="${data.title}"> <br/>
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
            <label>Deskripsi <span class="text-sm text-red-500">*</span></label>
            <textarea class="swal2-textarea" style="flex:1;" placeholder="Deskripsi" name="description">${data.description}</textarea>
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
            <label style="width: 90px; margin-right: 1rem;">Slider</label>
            <input type="file" class="swal2-file" style="width: 280px;" name="file" accept=".jpeg,.png,.jpg,.gif,.svg,.avi,.mpeg,.quicktime,.mp4" value="${data.file}"> <br/>
        </div>
        <input type="hidden" name="_method" value="PUT">
        </form>
        `;

        modal({
            title: "Edit Slider",
            formId: "editModal",
            method: "POST",
            url: `/api/slider/${id}`,
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
                `${baseL}/api/slider/${id}`,
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
