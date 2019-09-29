$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Categorias/listarproductos.php?id=' + $("#id").val(),
        data: {"si": "si"},
    }).done(function (msg) {
        $('#tabla').html(msg);
        $('#table1').DataTable();
    });
}