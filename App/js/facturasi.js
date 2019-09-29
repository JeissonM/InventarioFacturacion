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

function ver(id){
  location.href="verFactura.php?id=" + id;
}

function borrar(){
    if (document.getElementById("msjinterno")){
      document.getElementById("msjinterno").parentNode.removeChild(document.getElementById("msjinterno"));
    }
}
function borrar2(){
    if (document.getElementById("ser")){
      document.getElementById("ser").parentNode.removeChild(document.getElementById("ser"));
    }
}

function guardar(){
    var nom = $('#nombre').val();
    var des = $('#descripcion').val();
    nom=nom.toUpperCase();
    des=des.toUpperCase();
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Categorias/nueva.php',
        data:{"nombre":nom, "descripcion":des},
    }).done(function( msg ) {
      var m="msj1";
        mensage(msg,"info",m);
        $('#nombre').val("");
        $('#descripcion').val("");
        listar();
    });
}



function cambio() {
      borrar();
      var id=document.servicio.ser.value;
      $.ajax({
          type:'POST',
          url:urlg + '/Modules/Servicios/consulta3.php',
          data:{"id2":id},
      }).done(function( msg ) {
        var m="msj1";
        if(msg==="<p>Este servicio no tiene datos asociados...</p>"){
          mensage(msg,"danger",m);
        }else{
          var id=msg.split(";")[0];
          var nom=msg.split(";")[1];
          var des=msg.split(";")[2];
          var pre=msg.split(";")[3];
          document.servicio.id.value=id;
          document.servicio.nombre.value=nom;
          document.servicio.descripcion.value=des;
          document.servicio.precio.value=pre;
        }
          
      });
}



$(document).ready(function() {
  listar();
    $('#size').change(function(e) {
      borrar();
      borrar2();
      var id=$(this).val();
      $.ajax({
          type:'POST',
          url:urlg + '/Modules/Servicios/consulta2.php',
          data:{"id":id},
      }).done(function( msg ) {
        var m="msj1";
        if(msg==="<p>Esta Categoria no tiene servicios asociados...</p>"){
          mensage(msg,"danger",m);
        }else{
          var div=document.getElementById("se");
          div.innerHTML=msg;
        }
          
      });
    });

    
});

function factura(){
  location.href="defacturar.php";
}
function cancelar(){
  location.href="facturacioni.php";
}

function listar() {
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturasi/listar.php',
        data:{"si":"si"},
    }).done(function( msg ) {
        $('#tabla').html(msg);
        $('#table1').DataTable();
    });
}

function buscarnf(){
  var nom=$("#bnf").val();
  if (nom.length === 0) {
        if (document.getElementById("table")) {
            document.getElementById("table").parentNode.removeChild(document.getElementById("table"));
            return;
        } else {
            return;
        }
    }
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturasi/consulta.php',
        data:{"no":nom},
    }).done(function( msg ) {
        $('#result').html(msg);
        listar();
    });
}

function buscarc(){
  var nom=$("#bc").val();
  if (nom.length === 0) {
        if (document.getElementById("table")) {
            document.getElementById("table").parentNode.removeChild(document.getElementById("table"));
            return;
        } else {
            return;
        }
    }
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturasi/consulta2.php',
        data:{"no":nom},
    }).done(function( msg ) {
        $('#result').html(msg);
        listar();
    });
}

function eliminar(id){
  if (confirm("¿Esta seguro de eliminar la Factura?")){
      $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturasi/eliminar.php',
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
        url:urlg + '/Modules/Categorias/modificar.php',
        data:{"id":id, "nombre":nom, "descripcion":des},
    }).done(function( msg ) {
      var m="msj2";
        mensage(msg,"info",m);
        $('#nom').val("");
        $('#des').val("");
        listar();
    });
}

function Add(){
  var destino=document.getElementById("tbDetalle");
  var tr=document.createElement("tr");
  tr.appendChild(crearCampo("det_nombres[]",false));
  tr.appendChild(crearCampo("det_cant[]","",false,'calcular()'));
  tr.appendChild(crearCampo("det_valou[]",false,'calcular()'));
  tr.appendChild(crearCampo("det_imp[]",false,'calcular()'));
  tr.appendChild(crearCampo("det_valimp[]",true));
  tr.appendChild(crearCampo("det_valt[]",true));
  var td=document.createElement("td");
  var btn=document.createElement("button");
  btn.type="button";
  btn.innerHTML="<i class='fa fa-trash'></i>";
  btn.setAttribute("class","btn btn-danger btn-md btn-xs");
  btn.setAttribute("onclick","eliminarFila(this)");
  td.appendChild(btn);
  tr.appendChild(td);
  destino.appendChild(tr);
}

function crearCampo(nombre,readonly,evento){
  var td=document.createElement("td");
  var txt= document.createElement("input");
  txt.type="text";
  txt.setAttribute("name",nombre);
  txt.setAttribute("onkeyup",evento);
  txt.setAttribute("class","form-control");
  if (readonly){
    txt.setAttribute("readonly","readonly");
  }
  td.appendChild(txt);
  return td;
}

function eliminarFila(btn){
  var fila=btn.parentNode.parentNode;
  fila.parentNode.removeChild(fila);
  calcular();
  total();
}

function calcular(){
  var sub=0;
  var st=0;
  var impf=0;
  var cant=document.getElementsByName("det_cant[]");
  var valu=document.getElementsByName("det_valou[]");
  var valimp=document.getElementsByName("det_valimp[]");
  var dimp=document.getElementsByName("det_imp[]");
  var valt=document.getElementsByName("det_valt[]");
  for (i=0;i<cant.length;i++){
    st+=parseFloat(cant[i].value)*parseFloat(valu[i].value);
    valimp[i].value=(parseFloat(cant[i].value)*parseFloat(valu[i].value))*(parseFloat(dimp[i].value)/100);
    impf+=parseFloat(valimp[i].value);
    sub=(parseFloat(cant[i].value)*parseFloat(valu[i].value))+(parseFloat(valimp[i].value));
    valt[i].value=sub;
  }
  document.getElementById("st").value=st;
  document.getElementById("impv").value=impf;
  total();
}


function total(){
  var tot=document.getElementById("tota");
  var imp=document.getElementById("impv");
  var subt=document.getElementById("st");
  tot.value=parseFloat(imp.value) + parseFloat(subt.value);
}
function cargarInfo2(){
  var id=document.con.snc.value;
  var nit=id.split(";")[0];
  var nom=id.split(";")[1];
  var dir=id.split(";")[2];
  var ciu=id.split(";")[3];
  var tel=id.split(";")[4];
  document.getElementById("cliente").value=nom;
  document.getElementById("nitc").value=nit;
  document.getElementById("direccion").value=dir;
  document.getElementById("ciudad").value=ciu;
  document.getElementById("telefono").value=tel;
}