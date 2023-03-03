<?php encabezado() ?>
<!-- Begin Page Content -->
<div class="page-content bg-light">
    <div class="page-header bg-light">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Documentacion Generada</h2>
        </div>
    </div>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="Tabledocumentacion">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>clave promotor</th>
                                    <th>objeto</th>
                                    <th>codigo</th>
                                    <th>cantidad</th>
                                    <th>condicion</th>
                                    <th>fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $lista) { ?>
                                    <tr>
                                        <td><?php echo $lista['id']; ?></td>
                                        <td><?php echo $lista['clave_promotor']; ?></td>
                                        <td><?php echo $lista['objeto']; ?></td>
                                        <td><?php echo $lista['codigo']; ?></td>
                                        <td><?php echo $lista['cantidad']; ?></td>
                                        <td><?php echo $lista['condicion']; ?></td>
                                        <td><?php echo $lista['fecha']; ?></td>
                                        <td>
                                          
                                            <a href="<?php echo base_url(); ?>reportes/ver?id=<?php echo $lista['id']; ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Ver</a>
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