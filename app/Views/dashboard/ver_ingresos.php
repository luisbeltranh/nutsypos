<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ingresos - <?php echo $menu_activo ?></div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Producto ID</th>
                                <th>Número Ingreso</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <?php
                                if ($is_admin) {
                                ?>
                                    <th>Costo</th>
                                    <th>Total</th>

                                <?php
                                }
                                ?>
                                <th>Usuario</th>
                                <th>Fecha Creacion</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ingresos as $ingreso) {
                            ?>

                                <tr>
                                    <td><?= $ingreso['id']; ?></td>
                                    <td><?= $ingreso['numero_ingreso']; ?></td>
                                    <td><?= $ingreso['nombre']; ?></td>
                                    <td><?= $ingreso['cantidad']; ?></td>
                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td><?= $ingreso['monto']; ?></td>
                                        <td><?= $ingreso['total']; ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?= $ingreso['username']; ?></td>
                                    <td><?= $ingreso['created_at']; ?></td>

                                    <td>
                                        <a href="/dashboard/eliminaringresounidad/<?= $ingreso['id'] ?>" onclick="return confirm('Esta seguro que quiere borrar el ingreso del producto '+'<?= $ingreso['nombre'] ?>'+' x '+'<?= $ingreso['cantidad'] ?>'+'?');" class="btn btn-danger"><i class="bi bi-trash"></i></a>

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