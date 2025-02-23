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
                            <label for="nombre">Ventas Sistema</label>
                            <input type="text" class="form-control" name="nombre" value="<?= $total_ventas_hoy ?>">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="gasto_1">Gastos</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="gasto_1" placeholder="Monto - 1">
                                </div>
                                <div class=" col-md-9">
                                    <input type="text" class="form-control" name="descripcion_gasto_1" placeholder="Descripcion Gasto 1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="gasto_1">INGRESOS</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="efectivo" placeholder="Efectivo">
                                </div>
                                <div class=" col-md-6">
                                    <input type="text" class="form-control" name="pago_qr" placeholder="Pago QR">
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