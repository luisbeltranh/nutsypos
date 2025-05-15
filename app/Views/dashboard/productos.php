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
                                <a class="btn btn-primary" href="/dashboard/nuevoproducto">Nuevo</a>
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
                                <th>Tamaño</th>
                                <?php
                                if ($is_admin) {
                                ?>
                                    <th>Costo</th>
                                <?php
                                }
                                ?>
                                <th>Precio</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($productos as $producto) {
                            ?>

                                <tr class="<?= $producto['deleted_at'] != null ? 'table-secondary' : '' ?>">
                                    <td><?= $producto['id']; ?></td>
                                    <td><?= $producto['categoria']; ?></td>
                                    <td><?= $producto['nombre']; ?></td>
                                    <td><?= $producto['tamano']; ?></td>
                                    <?php
                                    if ($is_admin) {
                                    ?>
                                        <td><?= $producto['costo']; ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?= $producto['precio_venta']; ?></td>
                                    <td><?= $producto['descripcion']; ?></td>
                                    <td>
                                        <?php
                                        if ($is_admin) {
                                        ?>
                                            <a href="/dashboard/agregaringreso/<?= $producto['id'] ?>" class="btn btn-success"><i class="bi bi-clipboard2-plus"></i></a>
                                            <a href="/dashboard/editarproducto/<?= $producto['id'] ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                            <a href="/dashboard/eliminarproducto/<?= $producto['id'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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