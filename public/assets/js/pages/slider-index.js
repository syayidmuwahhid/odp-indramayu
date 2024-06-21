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
    <div style="display: flex; align-items: center; margin: 2rem 2.1rem; width: 420px;">
        <label>Judul</label>
        <input class="swal2-input" style="flex:1;" placeholder="Judul" name="title"> <br/>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 3rem;">
        <label>Deskripsi</label>
        <input class="swal2-input" style="flex:1;" placeholder="Deskripsi" name="description"> <br/>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 2rem;">
        <label style="width: 100px; margin-right: 1rem;">Gambar</label>
        <input type="file" class="swal1-file" style="width: 330px;" name="file" accept=".jpg,.png"> <br/>
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

        data.data.forEach((value, i) => {
            let html = `<tr>
                <td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${++i}</td>
                <td class="py-4">

                    <img src="${baseL}/${value.location}" alt="${
                value.description
            }" class="max-w-full w-30 h-24 bg-cover object-cover bg-center cursor-pointer" onclick="myModal${i}.showModal()">

                    <dialog id="myModal${i}" class="modal" style="width: 100vh; max-width: 800px; background-color: transparent; border: none; padding: 0; overflow: hidden;" onclick="closeDialog(event, 'myModal${i}')">
                        <div class="modal-box" style="padding: 0; display: flex; justify-content: center; align-items: center; background-color: transparent;">
                            <img src="${baseL}/${value.location}" alt="${
                value.description
            }" class="modal-image" style="width: 100%; height: 90vh; max-width: 100%;object-fit: contain;">
                        </div>
                    </dialog>
                </td>
                <td class="px-4">${value.title}</td>
                <td class="px-4">${value.description}</td>
                <td class="text-center">
                    <button class="inline-block px-2 py-2 mt-2 mb-2 font-bold text-center  align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-yellow-500 text-yellow-500 hover:text-yellow-900 hover:opacity-75 hover:shadow-none active:scale-100 active:border-yellow-900 active:bg-yellow-900 active:text-yellow hover:active:border-yellow-900 hover:active:bg-transparent hover:active:text-yellow-900 hover:active:opacity-75" onclick="editModal(${
                        value.id
                    })">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block text-orange-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232a1.5 1.5 0 112.121 2.121L8.49 16.215a4.5 4.5 0 01-1.086 1.086l-2.768 1.384a.75.75 0 01-1.05-1.05l1.384-2.768a4.5 4.5 0 011.086-1.086l8.803-8.803z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 11.25h-5.25a1.5 1.5 0 00-1.5 1.5v5.25" />
                        </svg>
                    </button>
                    <button class="inline-block px-2 py-2 mt-2 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-red-500 text-red-500 hover:text-red-900 hover:opacity-75 hover:shadow-none active:scale-100 active:border-red-900 active:bg-red-900 active:text-white hover:active:border-red-900 hover:active:bg-transparent hover:active:text-red-900 hover:active:opacity-75" onclick="hapusData(${
                        value.id
                    })">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
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
        <div style="display: flex; align-items: center; margin: 2rem 2.1rem; width: 420px;">
            <label>Judul</label>
            <input class="swal2-input" style="flex:1;" placeholder="Judul" name="title" value="${data.title}"> <br/>
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 3rem;">
            <label>Deskripsi</label>
            <input class="swal2-input" style="flex:1;" placeholder="Deskripsi" name="description" value="${data.description}"> <br/>
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 2rem;">
            <label style="width: 100px; margin-right: 1rem;">Gambar</label>
            <input type="file" class="swal1-file" style="width: 330px;" name="file" accept=".jpg,.png" value="${data.file}"> <br/>
        </div>
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
