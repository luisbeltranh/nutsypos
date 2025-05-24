<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Nuevo Producto a Granel
                        </div>
                    </div>
                    <?= form_open('dashboard/nuevoproductogranel') ?>
                    <div class="card-body">
                        <?= validation_list_errors() ?>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select class="form-control" name="categoria" autofocus>
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
                            <label for="descripcion">Minimo en kg</label>
                            <input type="number" class="form-control" name="minimo" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="costo_kg">Costo por Kg</label>
                            <input type="number" class="form-control" name="costo_kg" step="0.01">
                            <input type="hidden" name="user_id" value="<?= $idUsuario ?>">
                            <input type="hidden" name="cantidad_total" value="0">
                        </div>
                        <div class="form-group">
                            <label for="precio_venta_gramo">Precio de Venta por gramo</label>
                            <input type="number" class="form-control" name="precio_venta_gramo" value="0" step="0.01">
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