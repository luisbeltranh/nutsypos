<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Lista de Productos <span>
                            <?php
                            if ($is_admin) {
                            ?>
                                <a class="btn btn-primary" href="/dashboard/nuevoproductogranel">Embolsar Productos</a>
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
                                <th>ID</th>
                                <th>Producto Granel</th>
                                <th>Producto Embolsado</th>
                                <th>Cantidad Granel Usado</th>
                                <th>Cantidad Producto Embolsado</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($embolsados as $embolsado) {
                            ?>

                                <tr>
                                    <td><?= $producto['id']; ?></td>
                                    <td><?= $producto['producto_granel_id']; ?></td>
                                    <td><?= $producto['producto_id']; ?></td>
                                    <td><?= $producto['cantidad_granel_usado'] / 1000; ?></td>
                                    <td><?= $producto['cantidad_producto_embolsado'] * 1000; ?></td>
                                    <td><?= $producto['user_id']; ?></td>
                                    <td>
                                        <?php
                                        if ($is_admin) {
                                        ?>
                                            <a href="/dashboard/agregaringresogranel/<?= $producto['id'] ?>" class="btn btn-success"><i class="bi bi-clipboard2-plus"></i></a>
                                            <a href="/dashboard/editarproductogranel/<?= $producto['id'] ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                            <a href="/dashboard/eliminarproductogranel/<?= $producto['id'] ?>" class="btn btn-danger" onclick="return confirm('Realmente desea eliminar el producto: <?php echo $producto['nombre']; ?>')"><i class="bi bi-trash"></i></a>
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