//var urlg="http://contabilidad.acuerdosysolucionessas.com/App";
var urlg="http://localhost/Inventario/App";

function mensage(msg, tipo, capa){
    if (!document.getElementById("msjinterno")){
      var midiv = document.createElement("div");
      midiv.setAttribute("id","msjinterno");
      midiv.setAttribute("class","alert alert-"+ tipo +" alert-dismissible fade in");
      midiv.setAttribute("role","alert");
      midiv.innerHTML = "<p>"+ msg +"</p>";
      var btn = document.createElement("button");
      btn.setAttribute("type","button");
      btn.setAttribute("class","close");
      btn.setAttribute("data-dismiss","alert");
      btn.setAttribute("aria-label","close");
      midiv.appendChild(btn);
      document.getElementById(capa).appendChild(midiv);
    }
}

function borrar(){
    if (document.getElementById("msjinterno")){
      document.getElementById("msjinterno").parentNode.removeChild(document.getElementById("msjinterno"));
    }
}

function guardar(){
    var nom = $('#nombre').val();
    var des = $('#descripcion').val();
    nom=nom.toUpperCase();
    des=des.toUpperCase();
    $.ajax({
        type:'POST',
        url: urlg + '/Modules/Categorias/nueva.php',
        data:{"nombre":nom, "descripcion":des},
    }).done(function( msg ) {
      var m="msj1";
        mensage(msg,"info",m);
        $('#nombre').val("");
        $('#descripcion').val("");
        listar();
    });
}

$(document).ready(function() {
  listar();
    
});

function listar() {
    $.ajax({
        type:'POST',
        url: urlg + '/Modules/Categorias/listar.php',
        data:{"si":"si"},
    }).done(function( msg ) {
        $('#tabla').html(msg);
    });
}

function consultar(){
    var nom = $("#inputName").val();
    if (nom.length === 0) {
        if (document.getElementById("tablen")) {
            document.getElementById("tablen").parentNode.removeChild(document.getElementById("tablen"));
            return;
        } else {
            return;
        }
    }
    nom = nom.toUpperCase();
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Categorias/consulta.php',
        data: {"nombre": nom},
    }).done(function(msg) {
        $('#result').html(msg);
    });
}

function eliminar(id){
  if (confirm("¿Esta seguro de eliminar la categoria?")){
      $.ajax({
        type:'POST',
        url: urlg + '/Modules/Categorias/eliminar.php',
        data:{"id":id},
      }).done(function( msg ) {
          //$('#result').html(msg);
          alert(msg);
          listar();
      });
  }else{
    return;
  }
}

function ponerDatos(str){
    var idc=str.split(";")[0];
    var nom=str.split(";")[1];
    var des=str.split(";")[2];
    document.cat.id.value=idc;
    document.cat.nom.value=nom;
    document.cat.des.value=des;
}

function modificar(){
    var id = document.cat.id.value;
    var nom = document.cat.nom.value;
    var des = document.cat.des.value;
    nom=nom.toUpperCase();
    des=des.toUpperCase();
    $.ajax({
        type:'POST',
        url: urlg + '/Modules/Categorias/modificar.php',
        data:{"id":id, "nombre":nom, "descripcion":des},
    }).done(function( msg ) {
      var m="msj2";
        mensage(msg,"info",m);
        $('#nom').val("");
        $('#des').val("");
        listar();
    });
}