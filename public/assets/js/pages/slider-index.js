$(document).ready(function () {
    $("#btnAddModal").click(formModal); //show modal when btn is clicked
    getData(); // get data
});

function formModal() {
    let html = `
    <form id="formModal" enctype="multipart/form-data">
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label>Judul</label>
        <input class="swal2-input" style="flex:1;" placeholder="Judul" name="title"> <br/>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label style="width: 100px; margin-right: 1rem;">Image</label>
        <input type="file" class="swal1-file" style="width: 320px;" name="file" accept=".jpg,.png"> <br/>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label>Deskripsi</label>
        <input class="swal2-input" style="flex:1;" placeholder="Deskripsi" name="description"> <br/>
    </div>
    </form>
    `;

    modal({
        title: "Form Tambah Slider",
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
                <td><img src="${baseL}/${value.location}" alt="${
                value.description
            }" style="width: 100px;"></td>
                <td>${value.title}</td>
                <td>${value.description}</td>
                <td>
                    <button class="text-sm font-semibold leading-tight text-blue-600" onclick="editModal(${
                        value.id
                    })">Edit</button>
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
