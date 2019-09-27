//var urlg="http://contabilidad.acuerdosysolucionessas.com/App";
var urlg="http://localhost/Inventario/App";


function ivaGGConsulta(){
  ivaGG();
}

function ivaGNConsulta(){
  ivaGN();
}

function ivaDGConsulta(){
  ivaDG();
}

function ivaDNConsulta(){
  ivaDN();
}


function ivaGG(){
  var fi=$("#fi").val();
  var ff=$("#ff").val();
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturas/consultaIVAGG.php',
        data:{"fi":fi, "ff":ff},
    }).done(function( msg ){
        $('#tabla').html(msg);
        calculo(fi,ff);
    });
}

function ivaGN(){
  var fi=$("#fi").val();
  var ff=$("#ff").val();
  var nit=$("#nit").val();
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturas/consultaIVAGN.php',
        data:{"fi":fi, "ff":ff, "nit":nit},
    }).done(function( msg ){
        $('#tabla').html(msg);
        calculo2(fi,ff,nit);
    });
}

function ivaDG(){
  var fi=$("#fi").val();
  var ff=$("#ff").val();
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturasi/consultaIVADG.php',
        data:{"fi":fi, "ff":ff},
    }).done(function( msg ){
        $('#tabla').html(msg);
        calculo3(fi,ff);
    });
}

function ivaDN(){
  var fi=$("#fi").val();
  var ff=$("#ff").val();
  var nit=$("#nit").val();
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturasi/consultaIVADN.php',
        data:{"fi":fi, "ff":ff, "nit":nit},
    }).done(function( msg ){
        $('#tabla').html(msg);
        calculo4(fi,ff,nit);
    });
}



function calculo(fi,ff){
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturas/consultaIVAGGCalcular.php',
        data:{"fi":fi, "ff":ff},
    }).done(function( msg ){
        $('#encb').html(msg);
    });
}

function calculo2(fi,ff,nit){
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturas/consultaIVAGNCalcular.php',
        data:{"fi":fi, "ff":ff, "nit":nit},
    }).done(function( msg ){
        $('#encb').html(msg);
    });
}

function calculo3(fi,ff){
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturasi/consultaIVADGCalcular.php',
        data:{"fi":fi, "ff":ff},
    }).done(function( msg ){
        $('#encb').html(msg);
    });
}

function calculo4(fi,ff,nit){
   $.ajax({
        type:'POST',
        url:urlg + '/Modules/Facturasi/consultaIVADNCalcular.php',
        data:{"fi":fi, "ff":ff, "nit":nit},
    }).done(function( msg ){
        $('#encb').html(msg);
    });
}


function ver(id){
  abrirVentana("verFactura.php?id=" + id);
}

function abrirVentana(url) {
    window.open(url, "Ver Factura", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=1000, height=600");
}
