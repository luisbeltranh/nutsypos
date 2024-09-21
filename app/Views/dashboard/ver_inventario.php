<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Inventario de Productos <span></span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Producto ID</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Costo</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($productos as $producto) {
                            ?>

                                <tr>
                                    <td><?= $producto['producto_id']; ?></td>
                                    <td><?= $producto['categoria']; ?></td>
                                    <td><?= $producto['nombre']; ?></td>
                                    <td><?= $producto['cantidad']; ?></td>
                                    <td><?= $producto['costo']; ?></td>
                                    <td><?= $producto['total']; ?></td>
                                    <td>
                                        <a href="/dashboard/agregaringreso/<?= $producto['producto_id'] ?>" class="btn btn-success"><i class="bi bi-clipboard2-plus"></i></a>
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