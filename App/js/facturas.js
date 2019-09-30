function mensage(msg, tipo, capa) {
    if (!document.getElementById("msjinterno")) {
        var midiv = document.createElement("div");
        midiv.setAttribute("id", "msjinterno");
        midiv.setAttribute("class", "alert alert-" + tipo + " alert-dismissible fade in");
        midiv.setAttribute("role", "alert");
        midiv.innerHTML = "<p>" + msg + "</p>";
        var btn = document.createElement("button");
        btn.setAttribute("type", "button");
        btn.setAttribute("class", "close");
        btn.setAttribute("data-dismiss", "alert");
        btn.setAttribute("aria-label", "close");
        midiv.appendChild(btn);
        document.getElementById(capa).appendChild(midiv);
    }
}

function borrar() {
    if (document.getElementById("msjinterno")) {
        document.getElementById("msjinterno").parentNode.removeChild(document.getElementById("msjinterno"));
    }
}
function borrar2() {
    if (document.getElementById("ser")) {
        document.getElementById("ser").parentNode.removeChild(document.getElementById("ser"));
    }
}

function guardar() {
    var nom = $('#nombre').val();
    var des = $('#descripcion').val();
    nom = nom.toUpperCase();
    des = des.toUpperCase();
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Categorias/nueva.php',
        data: {"nombre": nom, "descripcion": des},
    }).done(function (msg) {
        var m = "msj1";
        mensage(msg, "info", m);
        $('#nombre').val("");
        $('#descripcion').val("");
        listar();
    });
}



function cambio() {
    borrar();
    var id = document.servicio.ser.value;
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Servicios/consulta3.php',
        data: {"id2": id},
    }).done(function (msg) {
        var m = "msj1";
        if (msg === "<p>Este servicio no tiene datos asociados...</p>") {
            mensage(msg, "danger", m);
        } else {
            var id = msg.split(";")[0];
            var nom = msg.split(";")[1];
            var des = msg.split(";")[2];
            var pre = msg.split(";")[3];
            var iva = msg.split(";")[4];
            document.servicio.id.value = id;
            document.servicio.nombre.value = nom;
            document.servicio.descripcion.value = des;
            document.servicio.precio.value = pre;
            document.servicio.impuesto.value = iva;
        }

    });
}



$(document).ready(function () {
    listar();
    nroFactura();
    $('#size').change(function (e) {
        borrar();
        borrar2();
        var id = $(this).val();
        $.ajax({
            type: 'POST',
            url: urlg + '/Modules/Servicios/consulta2.php',
            data: {"id": id},
        }).done(function (msg) {
            var m = "msj1";
            if (msg === "<p>Esta Categoria no tiene servicios asociados...</p>") {
                mensage(msg, "danger", m);
            } else {
                var div = document.getElementById("se");
                div.innerHTML = msg;
            }

        });
    });


});

function factura() {
    location.href = "facturar.php";
}
function cancelar() {
    location.href = "facturacion.php";
}

function listar() {
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Facturas/listar.php',
        data: {"si": "si"},
    }).done(function (msg) {
        $('#tabla').html(msg);
        $('#table1').DataTable();
    });
}

function buscarnf() {
    var nom = $("#bnf").val();
    if (nom.length === 0) {
        if (document.getElementById("table")) {
            document.getElementById("table").parentNode.removeChild(document.getElementById("table"));
            return;
        } else {
            return;
        }
    }
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Facturas/consulta.php',
        data: {"no": nom},
    }).done(function (msg) {
        $('#result').html(msg);
        listar();
    });
}

function buscarc() {
    var nom = $("#bc").val();
    if (nom.length === 0) {
        if (document.getElementById("table")) {
            document.getElementById("table").parentNode.removeChild(document.getElementById("table"));
            return;
        } else {
            return;
        }
    }
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Facturas/consulta2.php',
        data: {"no": nom},
    }).done(function (msg) {
        $('#result').html(msg);
        listar();
    });
}

function eliminar(id) {
    if (confirm("¿Esta seguro de eliminar la Factura?")) {
        $.ajax({
            type: 'POST',
            url: urlg + '/Modules/Facturas/eliminar.php',
            data: {"id": id},
        }).done(function (msg) {
            //$('#result').html(msg);
            alert(msg);
            listar();
        });
    } else {
        return;
    }
}

function ponerDatos(str) {
    var idc = str.split(";")[0];
    var nom = str.split(";")[1];
    var des = str.split(";")[2];
    document.cat.id.value = idc;
    document.cat.nom.value = nom;
    document.cat.des.value = des;
}

function modificar() {
    var id = document.cat.id.value;
    var nom = document.cat.nom.value;
    var des = document.cat.des.value;
    nom = nom.toUpperCase();
    des = des.toUpperCase();
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Categorias/modificar.php',
        data: {"id": id, "nombre": nom, "descripcion": des},
    }).done(function (msg) {
        var m = "msj2";
        mensage(msg, "info", m);
        $('#nom').val("");
        $('#des').val("");
        listar();
    });
}

function add(str) {
    var v = str.split(";");
    var id = v[0];
    var nom = v[1] + ": " + v[2];
    var precio = v[3];
    var imp = v[4];
    var esp = v[6];
    var des = v[7];
    verificar.push({producto: v[0], cantidad: v[5]});
    var destino = document.getElementById("tbDetalle");
    var tr = document.createElement("tr");
    tr.appendChild(crearCampo("det_nombres[]", nom, false, id, false));
    tr.appendChild(crearCampo("det_cant[]", "", false, 'calcular(this.id)', id, true));
    tr.appendChild(crearCampo("det_valou[]", precio, false, 'calcular(-1)', id, false));
    tr.appendChild(crearCampo("det_imp[]", imp, false, 'calcular(-1)', id, false));
    tr.appendChild(crearCampo("det_valimp[]", "", true, id, false));
    tr.appendChild(crearCampo("det_valt[]", "", true, id, false));
    var td = document.createElement("td");
    var btn = document.createElement("button");
    btn.type = "button";
    btn.innerHTML = "<i class='fa fa-trash'></i>";
    btn.setAttribute("class", "btn btn-danger btn-md btn-xs");
    btn.setAttribute("onclick", "eliminarFila(this)");
    td.appendChild(btn);
    tr.appendChild(td);
//    if (des > 0) {
//        var td2 = document.createElement("td");
//        var btn2 = document.createElement("button");
//        btn2.type = "button";
//        var txt = "";
//        if (esp == '1') {
//            txt = "(" + des + "%)";
//        } else {
//            txt = "($" + des + ")";
//        }
//        btn2.innerHTML = "DESCUENTO " + txt;
//        btn2.setAttribute("class", "btn btn-primary btn-md btn-xs");
//        btn2.setAttribute("id", esp + ";" + des);
//        btn2.setAttribute("onclick", "aplicarDescuento(this.id)");
//        td2.appendChild(btn2);
//        tr.appendChild(td2);
//    }
    destino.appendChild(tr);
    var pago = document.getElementById("pago");
    pago.value = 0;
}

function crearCampo(nombre, valor, readonly, evento, id, ponerId) {
    var td = document.createElement("td");
    var txt = document.createElement("input");
    txt.type = "text";
    txt.setAttribute("name", nombre);
    txt.setAttribute("value", valor);
    txt.setAttribute("onkeyup", evento);
    txt.setAttribute("class", "form-control");
    if (ponerId) {
        txt.setAttribute("id", id);
    }
    if (readonly) {
        txt.setAttribute("readonly", "readonly");
    }
    td.appendChild(txt);
    return td;
}

function eliminarFila(btn) {
    var fila = btn.parentNode.parentNode;
    fila.parentNode.removeChild(fila);
    calcular();
    total();
}

function calcular(id) {
    if (id != '-1') {
        //verificar existencia
        var val = $("#" + id).val();
        var pro = 0;
        verificar.forEach(function (element) {
            if (parseFloat(id) == parseFloat(element.producto)) {
                pro = element.cantidad;
            }
        });
        if (parseFloat(val) > parseFloat(pro)) {
            alert("La cantidad que esta ingresando excede la disponibilidad del producto en el inventario.");
            $("#" + id).val("");
            return;
        }
    }
    var sub = 0;
    var st = 0;
    var impf = 0;
    var cant = document.getElementsByName("det_cant[]");
    var valu = document.getElementsByName("det_valou[]");
    var valimp = document.getElementsByName("det_valimp[]");
    var dimp = document.getElementsByName("det_imp[]");
    var valt = document.getElementsByName("det_valt[]");
    for (i = 0; i < cant.length; i++) {
        st += parseFloat(cant[i].value) * parseFloat(valu[i].value);
        valimp[i].value = (parseFloat(cant[i].value) * parseFloat(valu[i].value)) * (parseFloat(dimp[i].value) / 100);
        impf += parseFloat(valimp[i].value);
        sub = (parseFloat(cant[i].value) * parseFloat(valu[i].value)) + (parseFloat(valimp[i].value));
        valt[i].value = sub;
    }
    document.getElementById("st").value = st;
    document.getElementById("impv").value = impf;
    total();
}


function total() {
    var tot = document.getElementById("tota");
    var imp = document.getElementById("impv");
    var subt = document.getElementById("st");
    var saldo = document.getElementById("saldo");
    var t = parseFloat(imp.value) + parseFloat(subt.value);
    tot.value = t;
    saldo.value = t;
}

function ver(id) {
    location.href = "verFactura.php?id=" + id;
}

function cargarInfo() {
    nroFactura();
    var id = document.con.enc.value;
    var container = document.getElementById("encb");
    if (container) {
        var f = new Date();
        var res = id.split(";")[0];
        var num = id.split(";")[1];
        var nit = id.split(";")[2];
        var dir = id.split(";")[3];
        var pag = id.split(";")[4];
        var tel = id.split(";")[5];
        var id2 = id.split(";")[6];
        var str = "<center><label id='1'>RESOLUCION DIAN No. " + res + "</label><br>";
        str += "<label id='2'>FECHA " + f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear() + "</label><br>";
        str += "<label id='3'>NUMERACION HABILITADA " + num + "</label><br>";
        str += "<label id='4'>Nit. " + nit + "</label><br>";
        str += "<label id='5'>" + dir + "</label><br>";
        str += "<label id='6'>PAGINA WEB: " + pag + "</label><br>";
        str += "<label id='7'>TEL. " + tel + "</label><br>";
        str += "<label id='8'>VALLEDUPAR-CESAR</label><br><input type='hidden' id='idenc' name='idenc' value='" + id2 + "'></center>";
        container.innerHTML = str;
    }
}

function cargarInfo2() {
    var id = document.con.snc.value;
    var nit = id.split(";")[0];
    var nom = id.split(";")[1];
    var dir = id.split(";")[2];
    var ciu = id.split(";")[3];
    var tel = id.split(";")[4];
    document.getElementById("cliente").value = nom;
    document.getElementById("nitc").value = nit;
    document.getElementById("direccion").value = dir;
    document.getElementById("ciudad").value = ciu;
    document.getElementById("telefono").value = tel;
}

function calculoTotal() {
    var total = document.getElementById("tota");
    var pago = document.getElementById("pago");
    var saldo = document.getElementById("saldo");
    var t = parseFloat(total.value) - parseFloat(pago.value);
    if (pago.value == "NaN" || pago.value == "" || saldo.value == "NaN") {
        saldo.value = total.value;
    } else {
        saldo.value = t;
    }
}

function ponerPago(id) {
    var nro = id.split(";")[0];
    var saldo = id.split(";")[1];
    document.getElementById("n").value = nro;
    document.getElementById("s").value = saldo;
}

function guardarPago() {
    var saldo = document.getElementById("s").value;
    var pago = document.getElementById("v").value;
    var nro = document.getElementById("n").value;
    var tipo = "";
    if (parseFloat(pago) > parseFloat(saldo)) {
        mensage("No puede pagar mas de lo que debe! Pago: " + pago + "  Saldo: " + saldo, "warning", "msj1");
        return;
    }
    if (parseFloat(pago) == parseFloat(saldo)) {
        tipo = "FINAL";
    } else {
        tipo = "NO";
    }
    var t = parseFloat(saldo) - parseFloat(pago);
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Facturas/modificar2.php',
        data: {"pago": t, "nro": nro, "tipo": tipo},
    }).done(function (msg) {
        var m = "msj1";
        mensage(msg, "info", m);
        listar();
    });
}

function nroFactura() {
    var nro = document.getElementById("nofactura");
    $.ajax({
        type: 'POST',
        url: urlg + '/Modules/Facturas/consultanro.php',
        data: {"si": "si"},
    }).done(function (msg) {
        var lg = msg.length;
        var rt = "";
        if (lg == 1) {
            rt = "000" + msg;
        }
        if (lg == 2) {
            rt = "00" + msg;
        }
        if (lg == 3) {
            rt = "0" + msg;
        }
        if (lg == 4) {
            rt = msg;
        }
        nro.value = rt;
    });
}

function verFacn(id) {
    var url = urlg + "/crearPDF.php?nro=" + id;
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
}