<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Lista de Productos Mas Vendidos <span>
                        </span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Monto</th>
                                <?php
                                if ($is_admin) {
                                ?>
                                    <th>Costo</th>
                                <?php
                                }
                                ?>
                                <th>Cantidad</th>
                                <th>Total Ingreso</th>
                                <?php
                                if ($is_admin) {
                                ?>
                                    <th>Total Costo</th>
                                    <th>Total Ganancia</th>
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
                                    <td><?= $producto['monto']; ?></td>
                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td><?= $producto['costo']; ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?= $producto['cantidad']; ?></td>
                                    <td><?= $producto['total']; ?></td>
                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td><?= $producto['costo'] * $producto['cantidad']; ?></td>
                                        <td><?= $producto['total'] - ($producto['costo'] * $producto['cantidad']); ?></td>
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