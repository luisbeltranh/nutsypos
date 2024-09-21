<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Nuevo Ingreso - #<?= $numero_ingreso ?>
                        </div>
                    </div>
                    <?= form_open('dashboard/guardaringreso') ?>
                    <div class="card-body">
                        <?= validation_list_errors() ?>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" maxlength="12" value="<?= $producto['nombre'] ?>" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <input type="text" class="form-control" name="categoria" maxlength="12" value="<?= $producto['categoria'] ?>" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" value="<?= $producto['descripcion'] ?>" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo</label>
                            <input type="text" class="form-control" name="monto" value="<?= $producto['costo'] ?>" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="text" class="form-control" name="cantidad" autofocus>
                            <input type="hidden" name="user_id" value="<?= $idUsuario ?>">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <input type="hidden" name="numero_ingreso" value="<?= $numero_ingreso ?>">
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