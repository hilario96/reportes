<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <div class="page-header bg-light">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Nueva Documentacion</h2>
        </div>
    </div>
    <section>
        <div class="container-fluid">
            <form action="" method="post" id="frmDocumentacion" class="row" autocomplete="off">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="buscar_codigo">Código </label>
                        <input type="hidden" id="id" name="id">
                        <input id="buscar_codigo" onkeyup="BuscarCodigo(event);" class="form-control" type="text" name="codigo" placeholder="Código">
                        <span class="text-danger d-none" id="error">No hay Objeto</span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="stockD" type="hidden">
                        <input id="cantidad" class="form-control" type="text" name="cantidad" onkeyup="IngresarCantidad(event);">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="tablaDocumentacion">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>clave promotor</th>
                                    <th>Objeto</th>
                                    <th>codigo</th>
                                    <th>Cantidad</th>
                                    <th>Condicion</th>
                                    <th>fecha</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="Listardocumentacion">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mt-1">
                    <div class="form-group">
                        <strong class="text-primary">Datos del Promotor</strong>
                        <input type="hidden" id="clave_promotor" name="clave_promotor">
                        <input type="text" id="clave_promotor" onkeyup="Buscarpromotor(event);" name="clave_promotor" class="form-control" placeholder="Clav del Promotor">
                        <strong id="clav_prom" class="form-control border-0 text-success"></strong>
                        <strong id="nom_prom" class="form-control border-0 text-success"></strong>
                        <strong id="dir_prom" class="form-control border-0 text-success"></strong>
                        <strong id="tel_prom" class="form-control border-0 text-success"></strong>
                    </div>
                </div>
                <div class="col-lg-4 mt-1">
                    <div class="form-group">
                        <!--<strong class="text-primary">Cuanto Mide</strong>-->
                        <input type="hidden" id="total" name="total" class="form-control  mb-2">
                        <strong id="tDocumentacion" class="form-control border-0 text-success"></strong>
                        <button class="btn btn-danger" type="button" id="AnularReporte">Anular Reporte</button>
                        <button class="btn btn-success" type="button" id="procesarReporte"><i class="fas fa-money-check-alt"></i> Procesar Reporte</button>
                    </div>
                </div> 
            </div>
        </div>
    </section>
</div>
<?php pie() ?>