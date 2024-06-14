$(document).ready(function () {
    $("#btnAddModal").click(formModal);
});

function formModal() {
    let html = `<form method="post" action="/getData" id="form">`;
    html += `<label class="text-green-900">Name</label>`;
    html += `<input id="swal-input1" class="swal2-input" placeholder="name"> `;
    html += `<label>Email</label>`;
    html += `<input id="swal-input2" class="swal2-input" placeholder="email">`;
    html += `</form>`;

    modal({
        title: "Form Tambah User",
        html,
        formId: "form",
    });
}
