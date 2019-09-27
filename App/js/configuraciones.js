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
    var res = $('#nrores').val();
    var num = $('#numhab').val();
    var nit = $('#nit').val();
    var dir = $('#dir').val();
    var pag = $('#web').val();
    var tel = $('#tel').val();
    var fecha=$("#fecha").val();
    num=num.toUpperCase();
    dir=dir.toUpperCase();
    $.ajax({
        type:'POST',
        url: urlg + '/Modules/Configuraciones/nueva.php',
        data:{"res":res, "num":num, "nit":nit, "dir":dir, "pag":pag, "tel":tel, "fecha":fecha},
    }).done(function( msg ) {
        var m="msj1";
        mensage(msg,"info",m);
        $('#nrores').val("");
        $('#numhab').val("");
        $('#nit').val("");
        $('#dir').val("");
        $('#web').val("");
        $('#tel').val("");
        listar();
    });
}

$(document).ready(function() {
  listar();
    
});

function listar() {
    $.ajax({
        type:'POST',
        url: urlg + '/Modules/Configuraciones/listar.php',
        data:{"si":"si"},
    }).done(function( msg ) {
        $('#tabla').html(msg);
    });
}

function consultar(){
  var nom = $("#inputName").val();
    if (nom.length === 0) {
        if (document.getElementById("table")) {
            document.getElementById("table").parentNode.removeChild(document.getElementById("table"));
            return;
        } else {
            return;
        }
    }
    nom = nom.toUpperCase();
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Configuraciones/consulta.php',
        data: {"nombre": nom},
    }).done(function(msg) {
        $('#result').html(msg);
    });
}

function eliminar(id){
  if (confirm("¿Esta seguro de eliminar la Configuracion?")){
      $.ajax({
        type:'POST',
        url: urlg + '/Modules/Configuraciones/eliminar.php',
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
    var res=str.split(";")[1];
    var f=str.split(";")[2];
    var num=str.split(";")[3];
    var nit=str.split(";")[4];
    var dir=str.split(";")[5];
    var pag=str.split(";")[6];
    var tel=str.split(";")[7];
    document.config2.id.value=idc;
    document.config2.nrores.value=res;
    document.config2.fecha.value=f;
    document.config2.numhab.value=num;
    document.config2.nit.value=nit;
    document.config2.dir.value=dir;
    document.config2.web.value=pag;
    document.config2.tel.value=tel;
}

function modificar(){
    var id=document.config2.id.value;
    var res = document.config2.nrores.value;
    var f=document.config2.fecha.value;
    var num = document.config2.numhab.value;
    var nit = document.config2.nit.value;
    var dir = document.config2.dir.value;
    var pag = document.config2.web.value;
    var tel = document.config2.tel.value;
    num=num.toUpperCase();
    dir=dir.toUpperCase();
    $.ajax({
        type:'POST',
        url: urlg + '/Modules/Configuraciones/modificar.php',
        data:{"id":id, "res":res, "num":num, "nit":nit, "dir":dir, "pag":pag, "tel":tel, "fecha":f},
    }).done(function( msg ) {
        var m="msj2";
        mensage(msg,"info",m);
        $('#nrores').val("");
        $('#numhab').val("");
        $('#nit').val("");
        $('#dir').val("");
        $('#web').val("");
        $('#tel').val("");
        listar();
        listar();
    });
}