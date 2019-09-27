function modificar(){
    var id = document.act.id.value;
    var nom = document.act.nom.value;
    var ape = document.act.ape.value;
    var dir = document.act.dir.value;
    var tel = document.act.tel.value;
    var email = document.act.email.value;
    var rol = document.act.rol.value;
    var est = document.act.estudios.value;
    var not = document.act.notas.value;
    var pp = document.act.pp.value;
    if (id.length==0 || nom.length==0 || rol.length==0){
      alert("Debe rellenar todos los campos...");
      return;
    }
    nom=nom.toUpperCase();
    ape=ape.toUpperCase();
    dir=dir.toUpperCase();
    email=email.toUpperCase();
    rol=rol.toUpperCase();
    est=est.toUpperCase();
    not=not.toUpperCase();
    pp=pp.toUpperCase();
    $.ajax({
        type:'POST',
        url:urlg +'/Modules/Usuarios/modificar2.php',
        data:{"id":id, "nom":nom, "ape":ape, "dir":dir, "tel":tel, "email":email, "rol":rol, "est":est, "not":not, "pp":pp},
    }).done(function(msg){
        var m="msj2";
        mensage(msg,"success",m);
    });
}


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


function cambiarPass(){
    var id = document.cp.id.value;
    var cv = document.cp.pw1.value;
    var cn = document.cp.pwn.value;
    var cn2 = document.cp.pwn2.value;
    var m="msj1";
    if (id.length==0 || cv.length==0 || cn.length==0 || cn2.length==0){
      borrar();
      mensage("Debe Rellenar todos los campos","warning",m);
      return;
    }
    if (cn!=cn2){
      borrar();
      mensage("Las contraseñas no coinciden","danger",m);
      return;
    }
    $.ajax({
        type:'POST',
        url:urlg +'/Modules/Usuarios/cambioclave.php',
        data:{"id":id, "cv":cv, "cn":cn, "cn2":cn2},
    }).done(function(msg){
      borrar();
        var m="msj1";
        mensage(msg,"success",m);
    });
}

function borrar(){
    if (document.getElementById("msjinterno")){
      document.getElementById("msjinterno").parentNode.removeChild(document.getElementById("msjinterno"));
    }
}