<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Lista de Gastos de hoy <?= $fecha ?> <span>
                            <?php
                            if ($is_admin) {
                            ?>
                                <a class="btn btn-primary" href="/dashboard/nuevogasto">Nuevo Gasto</a>
                            <?php
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Monto</th>
                                <th>Descripcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($gastos as $gasto) {
                            ?>

                                <tr>

                                    <td><?= $gasto['numero_gasto']; ?></td>
                                    <td><?= $gasto['monto']; ?></td>
                                    <td><?= $gasto['descripcion']; ?></td>
                                    <td>
                                        <?php
                                        if ($is_admin) {
                                        ?>
                                            <a href="/dashboard/editargasto/<?= $gasto['id'] ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                            <a href="/dashboard/eliminargasto/<?= $gasto['id'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>

                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->