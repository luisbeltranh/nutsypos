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
                                <th>ID</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Costo</th>
                                <th>Precio</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($productos as $producto) {
                            ?>

                                <tr>
                                    <td><?= $producto['id']; ?></td>
                                    <td><?= $producto['categoria']; ?></td>
                                    <td><?= $producto['nombre']; ?></td>
                                    <td><?= $producto['costo']; ?></td>
                                    <td><?= $producto['precio_venta']; ?></td>
                                    <td><?= $producto['descripcion']; ?></td>
                                    <td>
                                        <a href="/dashboard/editar" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                        <a href="/dashboard/agregaringreso/<?= $producto['id'] ?>" class="btn btn-success"><i class="bi bi-clipboard2-plus"></i></a>
                                        <a href="/dashboard/editar" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
<footer class="app-footer"> <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">Anything you want</div> <!--end::To the end--> <!--begin::Copyright--> <strong>
        Copyright &copy; 2014-2024&nbsp;
        <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer> <!--end::Footer-->
</div> <!--end::App Wrapper--> <!--begin::Script-->