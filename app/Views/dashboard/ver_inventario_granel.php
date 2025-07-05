<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Inventario de Productos - <?php echo $menu_activo ?></div>
                    <div class="card-tools">
                        <div class="btn-group">
                            <a href="/dashboard/verinventariogranel/nombre" class="btn btn-info">Nombre</a>
                            <a href="/dashboard/verinventariogranel/invmenos" class="btn btn-info">Inventario - </a>
                            <a href="/dashboard/verinventariogranel/invmas" class="btn btn-info">Inventario + </a>
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
                                    <th>Costo gr</th>
                                    <th>Total</th>

                                <?php
                                }
                                ?>
                                <th>Minimo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($productos_granel as $producto) {
                            ?>

                                <tr>
                                    <td <?php echo ($producto['cantidad_total'] < $producto['minimo']) ? 'class="bg-danger"' : '';  ?>><?= $producto['id']; ?></td>
                                    <td <?php echo ($producto['cantidad_total'] < $producto['minimo']) ? 'class="bg-danger"' : '';  ?>><?= $producto['categoria']; ?></td>
                                    <td <?php echo ($producto['cantidad_total'] < $producto['minimo']) ? 'class="bg-danger"' : '';  ?>><?= $producto['nombre']; ?></td>
                                    <td <?php echo ($producto['cantidad_total'] < $producto['minimo']) ? 'class="bg-danger"' : '';  ?>><?= $producto['cantidad_total']; ?></td>
                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td <?php echo ($producto['cantidad_total'] < $producto['minimo']) ? 'class="bg-danger"' : '';  ?>><?= $producto['costo_gramo']; ?></td>
                                        <td <?php echo ($producto['cantidad_total'] < $producto['minimo']) ? 'class="bg-danger"' : '';  ?>><?= $producto['costo_gramo'] * $producto['cantidad_total']; ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td <?php echo ($producto['cantidad_total'] < $producto['minimo']) ? 'class="bg-danger"' : '';  ?>><?= $producto['minimo']; ?></td>

                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td <?php echo ($producto['cantidad_total'] < $producto['minimo']) ? 'class="bg-danger"' : '';  ?>>
                                            <a href="/dashboard/agregaringresogranel/<?= $producto['id'] ?>" class="btn btn-success"><i class="bi bi-clipboard2-plus"></i></a>
                                        </td>
                                    <?php
                                    }
                                    ?>




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