<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="">
                        <div class="input-group">
                            <div class="col-sm-4">
                                Elegir fechas:
                            </div>
                            <div cls="col-sm-6">
                                <?= form_open('dashboard/verventasperiodo') ?>
                                <label for="fecha_inicio">Fecha Inicio</label>
                                <input type="date" name="fecha_inicio" value="<?= $fecha_hoy ?>">
                                <label for="fecha_fin">Fecha Fin</label>
                                <input type="date" name="fecha_fin" value="<?= $fecha_hoy ?>">
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
                                <th>Fecha</th>
                                <th>Ventas</th>
                                <?php
                                if ($is_admin) {
                                ?>
                                    <th>Costo</th>
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
                                    <td><?= $venta['fecha']; ?></td>
                                    <td><?= $venta['total_precio']; ?></td>
                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td><?= $venta['total_costo']; ?></td>
                                        <td><?= $venta['ganancia']; ?></td>
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
                                <?php
                                if ($is_admin) {
                                ?>
                                    <td></td>
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