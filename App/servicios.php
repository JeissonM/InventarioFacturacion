<?php
session_start();
if (empty($_SESSION["logged"])) {
    echo "<script type=\"text/javascript\">alert(\"No tiene permiso para entrar a este apartado\");</script>";
    header("Location: ../index.html");
    exit;
}
include("cabecera.php");
head();
menuTop();
menu("gestion");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestion de Productos
            <small>Ferretería FerroCoyot | Admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="#"><i class="fa fa-database"></i> Gestionar Datos</a></li>
            <li class="active"><a href="servicios.php"><i class="fa fa-wrench"></i> Productos</a></li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Producto</button>
            </div>
        </div>

        <!--      <div class="box box-primary color-palette-box">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-search"></i> Consulta de Servicios</h3>
                  <form class="form-horizontal">
                          <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Consultar por Nombre</label>
        
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName" onkeyup="consultar()" placeholder="Nombre de Servicio...">
                            </div>
                          </div>
                  </form>
                  <div class="row">
                    <div class="col-sm-12 col-md-12" id="result" name="result">
                        
                    </div>
                   
                  </div>
                </div>
              </div>-->



        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-wrench"></i> Listado de Productos &nbsp;&nbsp;| &nbsp;&nbsp;</h3> 
                <button type="button" name="btn" id="btn" class="btn btn-success" onclick="listar()"><i class="fa fa-refresh"></i></button>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 table-responsive" id="tabla" name="tabla">


                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
pie();
?>
<script type="text/javascript" src="js/servicios.js"></script>
<?php
fin();
?>





<!-- Modal -->
<div class="modal fade modal-success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Crear Nuevo Producto</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="servicio" name="servicio">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" onfocus="borrar()" placeholder="Nombre Aqui...">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" onfocus="borrar()" placeholder="Descripcion Aqui...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Precio Compra</label>
                            <input type="number" class="form-control" id="precio" name="precio" onfocus="borrar()" placeholder="Precio de compra del producto...">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Precio Venta</label>
                            <input type="number" class="form-control" id="preciov" name="preciov" onfocus="borrar()" placeholder="Precio de venta al público...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Existencia Producto</label>
                            <input type="number" class="form-control" id="existencia" name="existencia" onfocus="borrar()" placeholder="Existencia del producto en inventario...">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Unidad de Medida</label>
                            <input type="text" maxlength="250" class="form-control" id="unidad" name="unidad" onfocus="borrar()" placeholder="Unidad de medida del producto (KG, LIBRA, X UNIDAD, BOLSA, PACA, CUÑETE, GALON, ETC)...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Impuesto IVA/otro</label>
                            <input type="number" class="form-control" id="impuesto" name="impuesto" onfocus="borrar()" placeholder="Escriba asi: para 16% --> 16, para 5.5% --> 5.5">
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Categoria de Producto</label>
                            <select class="form-control" name="size" id="size">
                                <?php
                                $con = conectar();
                                $query = "SELECT *FROM as_categoria";
                                $result = $con->query($query);
                                if ($con->affected_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="control-label">Si Tiene Descuento ¿Es Porcentaje?</label>
                            <select class="form-control" name="esdescuento" id="esdescuento">
                                <option value='0'>EL DESCUENTO ES EN VALOR MONETARIO ($)</option>
                                <option value='1'>EL DESCUENTO ES POR PORCENTAJE (%)</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Valor del Descuento (0=SIN DESCUENTO)</label>
                            <input type="text" class="form-control" id="descuento" name="descuento" onfocus="borrar()" placeholder="Si el producto no tiene descuento escriba 0">
                        </div>
                    </div>
                    <div id="msj1">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="
                        if (document.servicio.nombre.value.length == 0 || document.servicio.descripcion.value.length == 0 || document.servicio.precio.value.length == 0 || document.servicio.impuesto.value.length == 0 || document.servicio.size.value.length == 0 || document.servicio.existencia.value.length == 0 || document.servicio.unidad.value.length == 0 || document.servicio.preciov.value.length == 0) {
                            borrar();
                            mensage('Rellene todos los campos del formulario!', 'danger', 'msj1');
                        } else {
                            borrar();
                            guardar();
                        }
                        ">Guardar Producto</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edicion-->
<div class="modal fade modal-success" id="myModalE" name="myModalE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Editar Producto</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="servicio2" name="servicio2">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre2" name="nombre2" onfocus="borrar()" placeholder="Nombre Aqui...">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion2" name="descripcion2" onfocus="borrar()" placeholder="Descripcion Aqui...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Precio Compra</label>
                            <input type="number" class="form-control" id="precio2" name="precio2" onfocus="borrar()" placeholder="Precio de compra del producto...">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Precio Venta</label>
                            <input type="number" class="form-control" id="preciov2" name="preciov2" onfocus="borrar()" placeholder="Precio de venta al público...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Existencia Producto</label>
                            <input type="number" class="form-control" id="existencia2" name="existencia2" onfocus="borrar()" placeholder="Existencia del producto en inventario...">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Unidad de Medida</label>
                            <input type="text" maxlength="250" class="form-control" id="unidad2" name="unidad2" onfocus="borrar()" placeholder="Unidad de medida del producto (KG, LIBRA, X UNIDAD, BOLSA, PACA, CUÑETE, GALON, ETC)...">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Impuesto IVA/otro</label>
                            <input type="number" class="form-control" id="impuesto2" name="impuesto2" onfocus="borrar()" placeholder="Escriba asi: para 16% --> 16, para 5.5% --> 5.5">
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label">Categoria de Producto</label>
                            <select class="form-control" name="size2" id="size2">
                                <?php
                                $con2 = conectar();
                                $query2 = "SELECT *FROM as_categoria";
                                $result2 = $con2->query($query2);
                                if ($con2->affected_rows > 0) {
                                    while ($row = $result2->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="control-label">Si Tiene Descuento ¿Es Porcentaje?</label>
                            <select class="form-control" name="esdescuento2" id="esdescuento2">
                                <option value='0'>EL DESCUENTO ES EN VALOR MONETARIO ($)</option>
                                <option value='1'>EL DESCUENTO ES POR PORCENTAJE (%)</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="inputName" class="control-label">Valor del Descuento (0=SIN DESCUENTO)</label>
                            <input type="text" class="form-control" id="descuento2" name="descuento2" onfocus="borrar()" placeholder="Si el producto no tiene descuento escriba 0">
                        </div>
                    </div>
                    <div id="msj2">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="
                        if (document.servicio2.nombre2.value.length == 0 || document.servicio2.descripcion2.value.length == 0 || document.servicio2.precio2.value.length == 0 || document.servicio2.impuesto2.value.length == 0 || document.servicio2.size2.value.length == 0 || document.servicio2.existencia2.value.length == 0 || document.servicio2.unidad2.value.length == 0 || document.servicio2.preciov2.value.length == 0) {
                            borrar();
                            mensage('Rellene todos los campos del formulario!', 'danger', 'msj2');
                        } else {
                            borrar();
                            modificar();
                        }
                        ">Guardar Producto</button>
            </div>
        </div>
    </div>
</div>
