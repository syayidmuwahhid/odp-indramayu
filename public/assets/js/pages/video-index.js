$(document).ready(function () {
    $("#btnAddModal").click(formModal); //show modal when btn is clicked
    getData(); // get data
});

function formModal () {
    let html = `
    <form id="formModal">
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label style="width: 100px; margin-right: 1rem;">Video</label>
        <input type="file" class="swal1-file" style="width: 320px;" name="file" accept=".mp4"> <br/>
    </div>
    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <label>Deskripsi</label>
        <input class="swal2-input" style="flex:1;" placeholder="Deskripsi" name="description"> <br/>
    </div>
    </form>
    `;

    modal({
        title: "Form Tambah Video",
        formId: "formModal",
        method: "POST",
        url: "/api/video",
        html,
        callback: getData,
    });
}

async function getData() {
    try{
        let { data } = await getRequestData(`${baseL}/api/video`);

        if(!data.status) {
            throw new Error(data.message);
        }

        $("#tbody_data").empty();

        data.data.forEach((value, i) => {
            let html = `<tr>
                <td class="text-center p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">${++i}</td>
                <td><img src="${baseL}/api/${value.file}" alt="${value.description}" style="width: 100px;"></td>
                <td>${value.description}</td>
                <td>
                    <button class="text-sm font-semibold leading-tight text-blue-600" onclick="editModal(${value.id})">Edit</button> 
                    <button class="text-sm font-semibold leading-tight text-red-400" onclick="hapusData(${value.id})">Hapus</button>
                </td>
            </tr>
            `;

            $("#tbody_data").append(html);
        });
    }
    catch (error) {
        notif("error", "Galat!", error);
    }
}