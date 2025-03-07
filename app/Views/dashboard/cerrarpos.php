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
                        <?= validation_list_errors() ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nombre">VENTAS</label>
                                    <input type="text" class="form-control" name="venta" value="<?= $total_ventas_hoy ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="gasto_1">GASTOS</label>
                                    <input type="text" class="form-control" name="gasto" value="<?= $total_gastos_hoy ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label>INGRESOS</label>
                                <div class="col-md-6">
                                    <label for="efectivo">Efectivo</label>
                                    <input type="number" class="form-control" name="efectivo">
                                </div>
                                <div class=" col-md-6">
                                    <label for="pago_qr">Pagos por QR</label>
                                    <input type="number" class="form-control" name="pago_qr" value="0">
                                    <input type="hidden" class="form-control" name="user_id" value="<?= $idUsuario ?>">
                                    <input type="hidden" class="form-control" name="validado" value="true">
                                </div>
                            </div>
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