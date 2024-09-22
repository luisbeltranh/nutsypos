<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Lista de Usuarios <span> <a class="btn btn-primary" href="/dashboard/nuevoproducto">Nuevo</a></span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Teléfono</th>
                                <th>Teléfono de Emgergencia</th>
                                <th>Grupo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($usuarios as $usuario) {
                            ?>

                                <tr>
                                    <td><?= $usuario['id']; ?></td>
                                    <td><?= $usuario['nombres']; ?></td>
                                    <td><?= $usuario['apellido_paterno']; ?></td>
                                    <td><?= $usuario['apellido_materno']; ?></td>
                                    <td><?= $usuario['telefono']; ?></td>
                                    <td><?= $usuario['telefono_emergencia']; ?></td>
                                    <td><?= $usuario['group']; ?></td>
                                    <td>
                                        <a href="/dashboard/editarusuario" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                        <a href="/dashboard/eliminarusuario" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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