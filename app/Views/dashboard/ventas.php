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
                                <?= form_open('dashboard/verventas') ?>
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
                                <th>Producto Id</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ventas as $venta) {
                            ?>

                                <tr>
                                    <td><?= $venta['producto_id']; ?></td>
                                    <td><?= $venta['nombre']; ?></td>
                                    <td><?= $venta['cantidad']; ?></td>
                                    <td><?= $venta['monto']; ?></td>
                                    <td><?= $venta['total']; ?></td>
                                </tr>

                            <?php
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td><?= $costo_total ?></td>
                                <td> <?= $monto_total ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->