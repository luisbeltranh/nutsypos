<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Inventario de Productos - <?php echo $menu_activo ?></div>
                    <div class="card-tools">
                        <div class="btn-group">
                            <a href="/dashboard/verinventario/nombre" class="btn btn-info">Nombre</a>
                            <a href="/dashboard/verinventario/invmenos" class="btn btn-info">Inventario - </a>
                            <a href="/dashboard/verinventario/invmas" class="btn btn-info">Inventario + </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Producto ID</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <?php
                                if ($is_admin) {
                                ?>
                                    <th>Costo</th>
                                    <th>Total</th>

                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($productos as $producto) {
                            ?>

                                <tr>
                                    <td><?= $producto['producto_id']; ?></td>
                                    <td><?= $producto['categoria']; ?></td>
                                    <td><?= $producto['nombre']; ?></td>
                                    <td><?= $producto['cantidad']; ?></td>
                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td><?= $producto['costo']; ?></td>
                                        <td><?= $producto['total']; ?></td>
                                    <?php
                                    }
                                    ?>

                                    <td>
                                        <a href="/dashboard/agregaringreso/<?= $producto['producto_id'] ?>" class="btn btn-success"><i class="bi bi-clipboard2-plus"></i></a>
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