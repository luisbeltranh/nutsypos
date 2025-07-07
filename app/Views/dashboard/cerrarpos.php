<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-12">
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
                                    <input type="text" class="form-control" name="total_ventas_registrado" value="<?= $total_ventas_hoy ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="gasto_1">GASTOS</label>
                                    <input type="text" class="form-control" name="total_gastos" value="<?= $total_gastos_hoy ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label>INGRESOS</label>
                                <div class="col-md-6">
                                    <label for="efectivo">PAGOS EN EFECTIVO</label>
                                    <input type="number" class="form-control" name="total_ventas_efectivo" value="<?= $total_ventas_efectivo ?>" readonly>
                                </div>
                                <div class=" col-md-6">
                                    <label for="pago_qr">PAGOS POR QR</label>
                                    <input type="number" class="form-control" name="total_ventas_qr" value="<?= $total_ventas_qr ?>" readonly>
                                    <input type="hidden" class="form-control" name="user_id" value="<?= $idUsuario ?>">
                                    <input type="hidden" class="form-control" name="validado" value="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label>ARQUEO DE CAJA</label>
                                <div class="col-md-6">
                                    <label for="efectivo_arqueo">EFECTIVO EN CAJA - CONTEO MANUAL</label>
                                    <input type="number" class="form-control" name="efectivo_arqueo">
                                </div>
                                <div class="col-md-6">
                                    <label for="total_efectivo">EFECTIVO EN CAJA - REGISTRO SISTEMA</label>
                                    <input type="number" class="form-control" name="total_efectivo" value="<?= $efectivo_arqueo ?>" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Siguiente">
                        <a href="/dashboard" class="btn btn-danger" role="button">Cancelar</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->