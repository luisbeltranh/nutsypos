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
                    <?= form_open('dashboard/editarproductogranel') ?>
                    <div class="card-body">
                        <?= validation_list_errors() ?>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select class="form-control" name="categoria">
                                <option value="">Categoría</option>
                                <option value="frutos_secos" <?php echo $producto['categoria'] == 'frutos_secos' ? 'selected' : ''; ?>>Frutos Secos</option>
                                <option value="bebidas" <?php echo $producto['categoria'] == 'bebidas' ? 'selected' : ''; ?>>Bebidas</option>
                                <option value="snacks" <?php echo $producto['categoria'] == 'snacks' ? 'selected' : ''; ?>>Snacks</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?= $producto['nombre'] ?>" maxlength="12">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" value="<?= $producto['descripcion'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Minimo</label>
                            <input type="text" class="form-control" name="minimo" value="<?= $producto['minimo'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo por Gramo</label>
                            <input type="text" class="form-control" name="costo_gramo" value="<?= $producto['costo_gramo'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="precio_venta">Precio de Venta por Gramo</label>
                            <input type="text" class="form-control" name="precio_venta_gramo" value="<?= $producto['precio_venta_gramo'] ?>">
                            <input type="hidden" name="user_id" value="<?= $idUsuario ?>">
                            <input type="hidden" name="producto_granel_id" value="<?= $producto['id'] ?>">
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