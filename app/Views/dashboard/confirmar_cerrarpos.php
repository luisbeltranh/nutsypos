<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Cerrar POS
                        </div>
                    </div>
                    <?= form_open('dashboard/cerrarpos') ?>
                    <div class="card-body">
                        <div class="table">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Descripcion</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>Ventas ingresadas al sistema</td>
                                        <td><?= $venta ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gastos ingresados el sistema</td>
                                        <td><?= $gasto ?></td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-group-divider">
                                    <tr>
                                        <th>Total Sistema</th>
                                        <th><?= $total_sistema ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="table">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Descripcion</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>Efectivo en caja</td>
                                        <td><?= $efectivo ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pagos con QR</td>
                                        <td><?= $pago_qr ?></td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-group-divider">
                                    <tr>
                                        <th>Total caja</th>
                                        <th><?= $total_caja ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="table">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Descripcion</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="<?= $color_tabla ?>">
                                        <td>Diferencia</td>
                                        <td><?= $diferencia ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar y Salir">
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->