<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Lista de Productos <span> <a class="btn btn-primary" href="/dashboard/nuevoproducto">Nuevo</a></span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th># Venta</th>
                                <th>Producto Id</th>
                                <th>Monto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ventas as $venta) {
                            ?>

                                <tr>
                                    <td><?= $venta['numero_venta']; ?></td>
                                    <td><?= $venta['producto_id']; ?></td>
                                    <td><?= $venta['monto']; ?></td>
                                    <td><?= $venta['cantidad']; ?></td>
                                    <td><?= $venta['total']; ?></td>
                                    <td><a href="/dashboard/editar" class="btn btn-primary"><i class="bi bi-pencil"></i></a><a href="/dashboard/editar" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
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
<footer class="app-footer"> <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">Anything you want</div> <!--end::To the end--> <!--begin::Copyright--> <strong>
        Copyright &copy; 2014-2024&nbsp;
        <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer> <!--end::Footer-->
</div> <!--end::App Wrapper--> <!--begin::Script-->