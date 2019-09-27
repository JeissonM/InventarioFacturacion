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
    var precio = $('#precio').val();
    var imp = $('#impuesto').val();
    var cat = $('#size').val();
    nom=nom.toUpperCase();
    des=des.toUpperCase();
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Servicios/nueva.php',
        data:{"nombre":nom, "descripcion":des, "precio":precio, "impuesto":imp, "categoria":cat},
    }).done(function( msg ) {
      var m="msj1";
        mensage(msg,"info",m);
        $('#nombre').val("");
        $('#descripcion').val("");
        $('#precio').val("");
        $('#impuesto').val("");
        listar();
    });
}

$(document).ready(function() {
  listar();
    
});

function listar() {
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Servicios/listar.php',
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
        url: urlg + '/Modules/Servicios/consulta.php',
        data: {"nombre": nom},
    }).done(function(msg) {
        $('#result').html(msg);
    });
}

function eliminar(id){
  if (confirm("¿Esta seguro de eliminar el Servicio?")){
      $.ajax({
        type:'POST',
        url:urlg + '/Modules/Servicios/eliminar.php',
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
    var ids=str.split(";")[0];
    var nom=str.split(";")[1];
    var des=str.split(";")[2];
    var pre=str.split(";")[3];
    var por=str.split(";")[4];
    var cat=str.split(";")[5];
    document.servicio2.id.value=ids;
    document.servicio2.nombre2.value=nom;
    document.servicio2.descripcion2.value=des;
    document.servicio2.precio2.value=pre;
    document.servicio2.impuesto2.value=por;
    //var t="#size > option:contains('"+ cat +"')";
    //alert(t);
    $('#size2 option:contains("'+ cat +'")').prop('selected', true);
    //$(t).attr('selected', 'selected');
}

function modificar(){
    var ids= $('#id').val();
    var nom = $('#nombre2').val();
    var des = $('#descripcion2').val();
    var precio = $('#precio2').val();
    var por = $('#impuesto2').val();
    var cat = $('#size2').val();
    nom=nom.toUpperCase();
    des=des.toUpperCase();
    $.ajax({
        type:'POST',
        url:urlg + '/Modules/Servicios/modificar.php',
        data:{"id":ids, "nombre":nom, "descripcion":des, "precio":precio, "impuesto":por, "categoria":cat},
    }).done(function( msg ) {
      var m="msj2";
        mensage(msg,"info",m);
        $('#nombre2').val("");
        $('#precio2').val("");
        $('#impuesto2').val("");
        $('#descripcion2').val("");
        listar();
    });
}