<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <section>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-6 m-auto">
                    <form method="post" action="<?php echo base_url(); ?>Insumos/actualizar" autocomplete="off">
                        <div class="card-header bg-dark">
                            <h6 class="title text-white text-center">Modificar Insumo</46>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="clave_promotor">Clave promotor</label>
                                <input type="hidden" name="clave_promotor" value="<?php echo $data['clave_promotor']; ?>">
                                <input id="codigo" class="form-control" type="text" name="codigo" value="<?php echo $data['codigo']; ?>">
                            </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                <input id="codigo" class="form-control" type="text" name="codigo" value="<?php echo $data['codigo']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="objeto">Objeto</label>
                                <input id="objeto" class="form-control" type="text" name="objeto" value="<?php echo $data['objeto']; ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="cantidad">Stock</label>
                                        <input id="cantidad" class="form-control" type="text" name="cantidad" value="<?php echo $data['cantidad']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fecha">fecha</label>
                                        <input id="fecha" class="form-control" type="date" name="fecha" value="<?php echo $data['fecha']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="condicion">condicion</label>
                                        <input id="condicion" class="form-control" type="text" name="condicion" value="<?php echo $data['condicion']; ?>">
                                    </div>
                                </div>
                        <div class="card-footer">
                            <button class="btn btn-dark" type="submit">Modificar</button>
                            <a href="<?php echo base_url(); ?>Insumos/Listar" class="btn btn-danger">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php pie() ?>