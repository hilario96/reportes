<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <a class="btn btn-primary" href="<?php echo base_url(); ?>Insumos/Listar"><i class="fas fa-arrow-alt-circle-left"></i> Regresar</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="Table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>clave promotor</th>
                                    <th>Código</th>
                                    <th>Objeto</th>
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
                                            <form action="<?php echo base_url() ?>Insumos/reingresar?id=<?php echo $pro['id']; ?>" method="post" class="d-inline confirmar">
                                                <button type="submit" class="btn btn-success"><i class="fas fa-ad"></i></button>
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
<?php pie() ?>