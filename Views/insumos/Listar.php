<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
       <div class="page-header bg-light">
            <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Insumos</h2>
        </div>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#nuevo_insumo"><i class="fas fa-plus-circle"></i> Nuevo</button>
                            <a class="btn btn-danger" href="<?php echo base_url(); ?>Insumos/eliminados"><i class="fas fa-user-slash"></i> Inactivos</a>
                        </div>
                        <div class="col-lg-6">
                            <?php if (isset($_GET['msg'])) {
                                $alert = $_GET['msg'];
                                if ($alert == "existe") { ?>
                                    <div class="alert alert-warning" role="alert">
                                        <strong>El insumo ya existe</strong>
                                    </div>
                                <?php } else if ($alert == "error") { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error al registrar</strong>
                                    </div>
                                <?php } else if ($alert == "registrado") { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Insumo registrado</strong>
                                    </div>
                                <?php } else if ($alert == "modificado") { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Insumo Modificado</strong>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="Table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>clave promotor</th>
                                    <th>Código</th>
                                    <th>objeto</th>
                                    <th>Stock</th>
                                    <th>fecha</th>
                                    <th>condicion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $insu) { ?>
                                    <tr>
                                        <td><?php echo $insu['id']; ?></td>
                                        <td><?php echo $insu['clave_promotor']; ?></td>
                                        <td><?php echo $insu['codigo']; ?></td>
                                        <td><?php echo $insu['objeto']; ?></td>
                                        <td><?php echo $insu['cantidad']; ?></td>
                                        <td><?php echo $insu['fecha']; ?></td>
                                        <td><?php echo $insu['condicion']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() ?>Insumos/editar?id=<?php echo $insu['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <form action="<?php echo base_url() ?>Insumos/eliminar?id=<?php echo $insu['id']; ?>" method="post" class="d-inline elim">
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="nuevo_insumo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fas fa-clipboard-list"></i> Nuevo Insumo</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo base_url(); ?>Insumos/insertar" autocomplete="off">
                <div class="modal-body">
                <div class="form-group">
                        <label for="clave_promotor">Clave promotor</label>
                        <input id="clave_promotor" class="form-control" type="text" name="clave_promotor" placeholder="Clave promotor">
                    </div>
                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código">
                    </div>
                    <div class="form-group">
                        <label for="objeto">Objeto</label>
                        <input id="objeto" class="form-control" type="text" name="objeto" placeholder="Descripción">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cantidad">cantidad</label>
                                <input id="cantidad" class="form-control" type="text" name="cantidad" placeholder="cantidad">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="fecha">fecha</label>
                                <input id="fecha" class="form-control" type="date" name="fecha" placeholder="fecha">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="condicion">condicion</label>
                                <input id="condicion" class="form-control" type="text" name="condicion" placeholder="condicion">
                            </div>
                        </div>
                    </div>
                           
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                </div>
                                
            </form>
        </div>
    </div>
</div>
<?php pie() ?>