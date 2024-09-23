<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Nuevo Producto
                        </div>
                    </div>
                    <?= form_open('dashboard/nuevousuario') ?>
                    <div class="card-body">
                        <?= validation_list_errors() ?>
                        <div class="form-group">
                            <label for="nombre">Nombre de Usuario</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Correo Electrónico</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Contraseña</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombres</label>
                            <input type="text" class="form-control" name="nombres">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apellido_paterno">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Apellido Materno</label>
                            <input type="text" class="form-control" name="apellido_materno">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Documento CI</label>
                            <input type="text" class="form-control" name="documento_ci">
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Teléfono</label>
                            <input type="text" class="form-control" name="telefono">
                        </div>
                        <div class="form-group">
                            <label for="costo">Teléfono de Emergencia</label>
                            <input type="text" class="form-control" name="telefono_emergencia">
                        </div>
                        <div class="form-group">
                            <label for="costo">Contacto de Emergencia</label>
                            <input type="text" class="form-control" name="contacto_emergencia">
                        </div>
                        <div class="form-group">
                            <label for="precio_venta">Dirección</label>
                            <input type="text" class="form-control" name="direccion">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->
d::App Wrapper--> <!--begin::Script-->