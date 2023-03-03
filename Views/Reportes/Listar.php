<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <div class="page-header bg-light">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom"> Reporte </h2>
        </div>
    </div>
    <section>
        <div class="container-fluid">
            <form action="" method="post" id="frmReportes" class="row" autocomplete="off">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="buscar_codigo"><i class="fas fa-barcode"></i> Código </label>
                        <input type="hidden" id="id" name="id">
                        <input id="buscar_codigo" onkeyup="BuscarCodigo(event);" class="form-control" type="text" name="codigo" placeholder="Código en serie">
                        <span class="text-danger d-none" id="error"><i class="fas fa-ad"></i> No hay objeto</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="nombre">objeto</label>
                        <input id="nombre" class="form-control" type="hidden" name="nombre">
                        <br />
                        <strong id="nombreP"></strong>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" class="form-control" type="text" name="cantidad" onkeyup="IngresarCantidad(event);">
                    </div>
                </div>                
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="tablaReportes">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>clave promotor</th>
                                    <th>Objeto</th>
                                    <th>codigo</th>
                                    <th>Cantidad</th>
                                    <th>condicion</th>
                                    <th>fecha</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="ListarReportes">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <div class="form-group mt-2">
                        <strong id="totalD"></strong><br>
                        <button class="btn btn-danger" type="button" id="AnularReporte"><i class="fas fa-ad"></i> Anular</button>
                        <button class="btn btn-success" type="button" id="procesarReporte"><i class="fas fa-ad"></i> Procesar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php pie() ?>