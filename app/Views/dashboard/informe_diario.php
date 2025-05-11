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
                        <tbody>
                            <tr><td>Fecha: <?= date('d/m/y',strtotime($fecha_hoy)); ?></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->