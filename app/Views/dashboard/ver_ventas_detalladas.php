<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="">
                        <div class="input-group">
                            <div class="col-sm-4">
                                Elegir fecha:
                            </div>
                            <div cls="col-sm-6">
                                <?= form_open('dashboard/verventasdetalladas') ?>
                                <input type="date" name="fecha" value="<?= $fecha_hoy ?>">
                                <input type="submit" class="btn btn-primary">
                                <?= form_close() ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Venta Id</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                                <th>Forma Pago</th>
                                <?php
                                if ($is_admin) {
                                ?>
                                    <th>Costo</th>
                                    <th>T. Costo</th>
                                    <th>Ganancia</th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ventas as $venta) {
                            ?>

                                <tr>
                                    <td><?= $venta['numero_venta']; ?></td>
                                    <td><?= $venta['producto_nombre']; ?></td>
                                    <td><?= $venta['cantidad']; ?></td>
                                    <td><?= $venta['monto']; ?></td>
                                    <td><?= $venta['total']; ?></td>
                                    <td><?= $venta['forma_pago_nombre']; ?></td>
                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td><?= $venta['costo']; ?></td>
                                        <td><?= $venta['costo'] * $venta['cantidad']; ?></td>
                                        <td><?= $venta['total'] - ($venta['costo'] * $venta['cantidad']); ?></td>
                                    <?php
                                    }
                                    ?>

                                </tr>

                            <?php
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td><?= $venta_forma_nombre[1]; ?></td>
                                <td><?= $venta_forma_total[1]; ?></td>
                                <td><?= $venta_forma_nombre[2]; ?></td>
                                <td><?= $venta_forma_total[2]; ?></td>

                                <?php
                                if ($is_admin) {
                                ?>
                                    <td></td>
                                <?php
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->