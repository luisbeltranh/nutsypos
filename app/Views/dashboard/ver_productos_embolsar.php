<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Lista de Productos <span>
                            <?php
                            if ($is_admin) {
                            ?>
                                <a class="btn btn-primary" href="/dashboard/nuevoproductogranel">Nuevo</a>
                            <?php
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Tamaño de Bolsa</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($embolsados as $producto) {
                            ?>

                                <tr>

                                    <td><?= $producto['categoria']; ?></td>
                                    <td><?= $producto['nombre']; ?></td>
                                    <td><?= $producto['tamano_bolsa']; ?></td>
                                    <td>
                                        <?php
                                        if (true) {
                                        ?>
                                            <a href="/dashboard/nuevo_embolsar/<?= $producto['id'] ?>" class="btn btn-warning"><i class="bi bi-bag-plus"></i></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->