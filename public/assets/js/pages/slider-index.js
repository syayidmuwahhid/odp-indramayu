$(document).ready(function () {
    $("#btnAddModal").click(formModal); //show modal when btn is clicked
    getData(); // get data
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

        $("#tbody_data").empty();
        data.data.forEach((value, i) => {
            let html = `<tr>
                <td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${++i}</td>
                <td class="text-center p-4">
                    <img src="${baseL}/${value.location}" alt="${value.description}" style="width: 150px; height: 30vh; object-fit: cover;" onclick="myModal${i}.showModal()">
                    <dialog id="myModal${i}" class="modal" style="width: 100vh; max-width: 800px; background-color: transparent; border: none; padding: 0; overflow: hidden;" onclick="closeDialog(event, 'myModal${i}')">
                        <div class="modal-box" style="padding: 0; display: flex; justify-content: center; align-items: center; background-color: transparent;">
                            <img src="${baseL}/${value.location}" alt="${value.description}" class="modal-image" style="width: 100%; height: 90vh; max-width: 100%;object-fit: contain;">
                        </div>
                    </dialog>
                </td>
                <td>${value.title}</td>
                <td>${value.description}</td>
                <td class="text-center">
                    <button class="text-sm font-semibold leading-tight text-blue-600" onclick="editModal(${
                        value.id
                    })">Edit |</button>
                    <button class="text-sm font-semibold leading-tight text-red-400" onclick="hapusData(${
                        value.id
                    })">Hapus</button>
                </td>
            </tr>
            `;
            $("#tbody_data").append(html);
        });
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
