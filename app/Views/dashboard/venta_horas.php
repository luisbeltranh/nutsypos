<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-12">

                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <div class="">
                            <div class="input-group">
                                <div class="col-sm-4">
                                    Elegir fecha:
                                </div>
                                <div cls="col-sm-6">
                                    <?= form_open('dashboard/vistaventashoyhoras') ?>
                                    <input type="date" name="fecha" value="<?= $fecha_hoy ?>">
                                    <input type="submit" class="btn btn-primary">
                                    <?= form_close() ?>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>