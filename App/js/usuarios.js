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
    var id = $('#id').val();
    var nom = $('#nom').val();
    var ape = $('#ape').val();
    var dir = $('#dir').val();
    var tel = $('#tel').val();
    var mail = $('#mail').val();
    var rol = $('#rol').val();
    var pw = $('#pw').val();
    nom=nom.toUpperCase();
    ape=ape.toUpperCase();
    dir=dir.toUpperCase();
    mail=mail.toUpperCase();
    rol=rol.toUpperCase();
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Usuarios/nueva.php',
        data:{"id":id, "nom":nom, "ape":ape, "dir":dir, "tel":tel, "mail":mail, "rol":rol, "pw":pw},
    }).done(function( msg ) {
      var m="msj1";
        mensage(msg,"info",m);
        $('#id').val("");
        $('#nom').val("");
        $('#ape').val("");
        $('#dir').val("");
        $('#tel').val("");
        $('#mail').val("");
        $('#rol').val("");
        $('#pw').val("");
        listar();
    });
}

$(document).ready(function() {
  listar();
    
});

function listar() {
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Usuarios/listar.php',
        data:{"si":"si"},
    }).done(function( msg ) {
        $('#tabla').html(msg);
        $('#table1').DataTable();
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
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Usuarios/consulta.php',
        data:{"id":nom},
    }).done(function( msg ) {
        $('#result').html(msg);
        listar();
    });
}

function eliminar(id){
  if (confirm("¿Esta seguro de eliminar el Usuario?")){
      $.ajax({
        type:'POST',
        url:urlg + '/Modules/Usuarios/eliminar.php',
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
    var id=str.split(";")[0];
    var nom=str.split(";")[1];
    var ape=str.split(";")[2];
    var dir=str.split(";")[3];
    var tel=str.split(";")[4];
    var ema=str.split(";")[5];
    var rol=str.split(";")[6];
    var pas=str.split(";")[7];
    document.usuario2.id.value=id;
    document.usuario2.nom.value=nom;
    document.usuario2.ape.value=ape;
    document.usuario2.dir.value=dir;
    document.usuario2.tel.value=tel;
    document.usuario2.mail.value=ema;
    document.usuario2.rol.value=rol;
    document.usuario2.pw.value=pas;
}

function cargaidp(str){
  var id=str.split(";")[0];
  var nom=str.split(";")[1];
  var p=str.split(";")[2];
  var m=str.split(";")[3];
  var d=str.split(";")[4];
  var i=str.split(";")[5];
  var f=str.split(";")[6];
  var fi=str.split(";")[7];
  var r=str.split(";")[8];
  var u=str.split(";")[9];
  var c=str.split(";")[10];
  var co=str.split(";")[11];
   var pro=str.split(";")[12];
  document.priv.id.value=id;
  document.priv.nom.value=nom;
  var a= [p,m,d,i,f,fi,r,u,c,co,pro]; 
  var checkboxes = document.getElementById("priv").check;
  for (var x=0; x < checkboxes.length; x++) {
    if (a[x]==="SI"){
      checkboxes[x].checked=1;
    }else{
      checkboxes[x].checked=0;
    }
  }

}

function modificar(){
    var id = document.usuario2.id.value;
    var nom = document.usuario2.nom.value;
    var ape = document.usuario2.ape.value;
    var dir = document.usuario2.dir.value;
    var tel = document.usuario2.tel.value;
    var mail = document.usuario2.mail.value;
    var rol = document.usuario2.rol.value;
    var pw = document.usuario2.pw.value;
    nom=nom.toUpperCase();
    ape=ape.toUpperCase();
    dir=dir.toUpperCase();
    mail=mail.toUpperCase();
    rol=rol.toUpperCase();
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Usuarios/modificar.php',
        data:{"id":id, "nom":nom, "ape":ape, "dir":dir, "tel":tel, "mail":mail, "rol":rol, "pw":pw},
    }).done(function( msg ) {
      var m="msj2";
        mensage(msg,"info",m);
        $('#id').val("");
        $('#nom').val("");
        $('#ape').val("");
        $('#dir').val("");
        $('#tel').val("");
        $('#mail').val("");
        $('#rol').val("");
        $('#pw').val("");
        listar();
    });
}

function privilegios(){
  var id = document.priv.id.value;
  var checkboxes = document.getElementById("priv").check;
  var str=id; 
  for (var x=0; x < checkboxes.length; x++) {
     if (checkboxes[x].checked) {
      str= str + ";SI";
     }else{
      str= str + ";NO"
     }
  }
  $.ajax({
        type:'POST',
        url:urlg + '/Modules/Usuarios/permisos.php',
        data:{"str":str},
    }).done(function( msg ) {
      var m="msj3";
        mensage(msg,"info",m);
        listar();
    });
}