<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Nuevo Gasto - <?= $numero_gasto ?>
                        </div>
                    </div>
                    <?= form_open('dashboard/nuevogasto') ?>
                    <div class="card-body">
                        <?= validation_list_errors() ?>
                        <div class="form-group">
                            <div class="row">
                                <label for="gasto_1">Gastos</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="monto" placeholder="Monto">
                                    <input type="hidden" class="form-control" name="numero_gasto" value="<?= $numero_gasto ?>">
                                    <input type="hidden" class="form-control" name="user_id" value="<?= $id_usuario ?>">
                                </div>
                                <div class=" col-md-9">
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripcion">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->