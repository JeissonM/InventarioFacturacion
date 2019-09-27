function enviar(id){
    var para = $('#size').val();
    var de=id;
    var asunto=$('#asunto').val();
    var mensaje = $('#compose-textarea').val();
    var estado="NO";
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Mensajes/nueva.php',
        data:{"para":para, "de":de, "asunto":asunto, "mensaje":mensaje, "estado":estado},
    }).done(function( msg ) {
      alert(msg);
      location.href="mensajes.php";
    });
}

$(document).ready(function() {
  listar();
  listarenv();
  listarbor();
});

function listar() {
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Mensajes/listar.php',
        data:{"si":"si"},
    }).done(function( msg ) {
        $('#mensajes').html(msg);
    });
}
function listarenv() {
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Mensajes/listarenv.php',
        data:{"si":"si"},
    }).done(function( msg ) {
        $('#menviados').html(msg);
    });
}
function listarbor() {
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Mensajes/listarbor.php',
        data:{"si":"si"},
    }).done(function( msg ) {
        $('#mborradores').html(msg);
    });
}

function consultar(){
  var nom=$("#inputName").val();
  nom=nom.toUpperCase();
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Categorias/consulta.php',
        data:{"nombre":nom},
    }).done(function( msg ) {
        $('#result').html(msg);
        listar();
    });
}

function eliminar(id){
  if (confirm("¿Esta seguro de eliminar el Mensaje? la eliminacion es permanente!")){
      $.ajax({
        type:'POST',
        url:urlg + '/Modules/Mensajes/eliminar.php',
        data:{"id":id},
      }).done(function( msg ) {
          //$('#result').html(msg);
          alert(msg);
          listar();
          listarenv();
          listarbor();
      });
  }else{
    return;
  }
}


function borrador(id){
    var para = $('#size').val();
    var de=id;
    var asunto=$('#asunto').val();
    var mensaje = $('#compose-textarea').val();
    var borrador="SI";
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Mensajes/nuevobor.php',
        data:{"para":para, "de":de, "asunto":asunto, "mensaje":mensaje, "borrador":borrador},
    }).done(function( msg ) {
      alert(msg);
      location.href="mensajes.php";
    });
}

function ir(){
  location.href="nuevomsj.php";
}