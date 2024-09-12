<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Reporte de ventas <span> </span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Producto Id</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ventas as $venta) {
                            ?>

                                <tr>
                                    <td><?= $venta['producto_id']; ?></td>
                                    <td><?= $venta['nombre']; ?></td>
                                    <td><?= $venta['cantidad']; ?></td>
                                    <td><?= $venta['monto']; ?></td>
                                    <td><?= $venta['total']; ?></td>
                                </tr>

                            <?php
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td> <?= $monto_total ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->
<footer class="app-footer"> <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">Anything you want</div> <!--end::To the end--> <!--begin::Copyright--> <strong>
        Copyright &copy; 2014-2024&nbsp;
        <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer> <!--end::Footer-->
</div> <!--end::App Wrapper--> <!--begin::Script-->