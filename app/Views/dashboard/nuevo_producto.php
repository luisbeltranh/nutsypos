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
                    <?= form_open('dashboard/nuevoproducto') ?>
                    <div class="card-body">
                        <?= validation_list_errors() ?>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select class="form-control" name="categoria">
                                <option value="">Categoría</option>
                                <option value="frutos_secos">Frutos Secos</option>
                                <option value="bebidas">Bebidas</option>
                                <option value="snacks">Snacks</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" maxlength="12">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" name="descripcion">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Tamaño</label>
                            <input type="text" class="form-control" name="tamano">
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="text" class="form-control" name="cantidad">
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo</label>
                            <input type="text" class="form-control" name="costo">
                        </div>
                        <div class="form-group">
                            <label for="precio_venta">Precio de Venta</label>
                            <input type="text" class="form-control" name="precio_venta">
                            <input type="hidden" name="user_id" value="<?= $idUsuario ?>">
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