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
                                <a class="btn btn-primary" href="/dashboard/agregarembolsadogranel">Embolsar Productos</a>
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
                                <th>Numero Embolsado</th>
                                <th>Producto Embolsado</th>
                                <th>Producto Granel</th>
                                <th>Cantidad Granel Usado [kg]</th>
                                <th>Cantidad Producto Embolsado</th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($embolsados as $embolsado) {
                            ?>

                                <tr class="<?= ($embolsado['numero_embolsado'] % 2 == 0) ? 'table-secondary' : '' ?>">
                                    <td><?= $embolsado['numero_embolsado'] ?></td>
                                    <td><?= $embolsado['producto_nombre']; ?></td>
                                    <td><?= $embolsado['producto_granel_nombre']; ?></td>
                                    <td><?= $embolsado['cantidad_granel_usado']; ?></td>
                                    <td><?= $embolsado['cantidad_producto_embolsado']; ?></td>
                                    <td><?= $embolsado['embolsados_created_at']; ?></td>
                                    <td><?= $embolsado['user_id']; ?></td>
                                    <td>
                                        <?php
                                        if ($is_admin) {
                                        ?>
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