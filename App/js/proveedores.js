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
    var nit = $('#nit').val();
    var nom = $('#nombre').val();
    var des = $('#descripcion').val();
    var dir = $('#dir').val();
    var tel = $('#tel').val();
    var mail = $('#mail').val();
    var ciu= $('#ciu').val();
    nom=nom.toUpperCase();
    des=des.toUpperCase();
    dir=dir.toUpperCase();
    mail=mail.toUpperCase();
    ciu=ciu.toUpperCase();
    $.ajax({
        type:'POST',
        url: urlg + '/Modules/Proveedores/nueva.php',
        data:{"nit":nit, "nom":nom, "des":des, "dir":dir, "tel":tel, "mail":mail, "ciu":ciu},
    }).done(function( msg ) {
      var m="msj1";
        mensage(msg,"info",m);
        $('#nit').val("");
        $('#nombre').val("");
        $('#descripcion').val("");
        $('#dir').val("");
        $('#tel').val("");
        $('#mail').val("");
        $("#ciu").val("");
        listar();
    });
}

$(document).ready(function() {
  listar();
    
});

function listar() {
    $.ajax({
        type:'POST',
        url: urlg + '/Modules/Proveedores/listar.php',
        data:{"si":"si"},
    }).done(function( msg ) {
        $('#tabla').html(msg);
    });
}

function consultar(){
  var nom=$("#inputName").val();
  if (nom.length === 0) {
        if (document.getElementById("tablen")) {
            document.getElementById("tablen").parentNode.removeChild(document.getElementById("tablen"));
            return;
        } else {
            return;
        }
  }
  nom=nom.toUpperCase();
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Proveedores/consulta.php',
        data:{"nombre":nom},
    }).done(function( msg ) {
        $('#result').html(msg);
        listar();
    });
}

function eliminar(id){
  if (confirm("¿Esta seguro de eliminar el Proveedor?")){
      $.ajax({
        type:'POST',
        url: urlg + '/Modules/Proveedores/eliminar.php',
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
    var dir=str.split(";")[3];
    var tel=str.split(";")[4];
    var mail=str.split(";")[5];
    var ciu=str.split(";")[6];
    document.cliente2.nit2.value=idc;
    document.cliente2.nombre2.value=nom;
    document.cliente2.descripcion2.value=des;
    document.cliente2.dir2.value=dir;
    document.cliente2.tel2.value=tel;
    document.cliente2.mail2.value=mail;
    document.cliente2.ciu2.value=ciu;
}

function modificar(){
    var nit = $('#nit2').val();
    var nom = $('#nombre2').val();
    var des = $('#descripcion2').val();
    var dir = $('#dir2').val();
    var tel = $('#tel2').val();
    var mail = $('#mail2').val();
    var ciu = $('#ciu2').val();
    nom=nom.toUpperCase();
    des=des.toUpperCase();
    dir=dir.toUpperCase();
    mail=mail.toUpperCase();
    ciu=ciu.toUpperCase();
    $.ajax({
        type:'POST',
        url: urlg + '/Modules/Proveedores/modificar.php',
        data:{"nit":nit, "nom":nom, "des":des, "dir":dir, "tel":tel, "mail":mail, "ciu":ciu},
    }).done(function( msg ) {
      var m="msj2";
        mensage(msg,"info",m);
        $('#nit2').val("");
        $('#nombre2').val("");
        $('#descripcion2').val("");
        $('#dir2').val("");
        $('#tel2').val("");
        $('#mail2').val("");
        $('#ciu2').val("");
        listar();
    });
}