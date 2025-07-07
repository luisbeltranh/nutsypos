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
                                        <td>Total de Ventas en Efectivo Ingresadas al Sistema</td>
                                        <td><?= $total_ventas_efectivo ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total de Ventas en QR Ingresadas al Sistema</td>
                                        <td><?= $total_ventas_qr ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total de Gastos Ingresados el Sistema</td>
                                        <td><?= $total_gastos ?></td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-group-divider">
                                    <tr>
                                        <th>Total de Ingreso</th>
                                        <th><?= $total_ventas_registrado - $total_gastos ?></th>
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
                                        <td>Efectivo en caja - Sistema</td>
                                        <td><?= $total_efectivo ?></td>
                                    </tr>
                                    <tr>
                                        <td>Efectivo en caja - Conteo Manual</td>
                                        <td><?= $efectivo_arqueo ?></td>
                                    </tr>

                                </tbody>
                                <tfoot class="table-group-divider">
                                    <tr class="<?= $color_tabla ?>">
                                        <th>Diferencia</th>
                                        <th><?= $arqueo_diferencia ?></th>
                                    </tr>
                                    <tr>
                                        <td> <?= $arqueo_mensaje ?> </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input type="hidden" class="form-control" name="total_ventas_registrado" value="<?= $total_ventas_registrado ?>">
                        <input type="hidden" class="form-control" name="total_ventas_efectivo" value="<?= $total_ventas_efectivo ?>">
                        <input type="hidden" class="form-control" name="total_ventas_qr" value="<?= $total_ventas_qr ?>">
                        <input type="hidden" class="form-control" name="total_gastos" value="<?= $total_gastos ?>">
                        <input type="hidden" class="form-control" name="total_efectivo" value="<?= $total_efectivo ?>">
                        <input type="hidden" class="form-control" name="efectivo_arqueo" value="<?= $efectivo_arqueo ?>">
                        <input type="hidden" class="form-control" name="arqueo_diferencia" value="<?= $arqueo_diferencia ?>">
                        <input type="hidden" class="form-control" name="guardar_datos" value="guardar">
                        <input type="hidden" class="form-control" name="user_id" value="<?= $idUsuario ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar y Salir">
                        <a href="/dashboard" class="btn btn-danger" role="button">Cancelar</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->