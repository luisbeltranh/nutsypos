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
                                <a class="btn btn-primary" href="/dashboard/nuevoproductogranel">Nuevo</a>
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
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <?php
                                if ($is_admin) {
                                ?>
                                    <th>Costo</th>
                                <?php
                                }
                                ?>
                                <th>Precio</th>
                                <th>Minimo</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($productos_granel as $producto) {
                            ?>

                                <tr>
                                    <td><?= $producto['id']; ?></td>
                                    <td><?= $producto['categoria']; ?></td>
                                    <td><?= $producto['nombre']; ?></td>
                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td><?= $producto['costo_gramo']; ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?= $producto['precio_venta_gramo']; ?></td>
                                    <td><?= $producto['minimo']; ?></td>
                                    <td><?= $producto['descripcion']; ?></td>
                                    <td>
                                        <a href="/dashboard/agregaringresogranel/<?= $producto['id'] ?>" class="btn btn-success"><i class="bi bi-clipboard2-plus"></i></a>
                                        <?php
                                        if ($is_admin) {
                                        ?>
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