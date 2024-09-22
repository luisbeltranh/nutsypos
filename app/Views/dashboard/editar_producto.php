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
                    <?= form_open('dashboard/editarproducto') ?>
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
                            <input type="text" class="form-control" name="nombre" maxlength="11" value="<?= $producto['nombre'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" value="<?= $producto['descripcion'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="text" class="form-control" name="cantidad_total" value="<?= $producto['cantidad_total'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo</label>
                            <input type="text" class="form-control" name="costo" value="<?= $producto['costo'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="precio_venta">Precio de Venta</label>
                            <input type="text" class="form-control" name="precio_venta" value="<?= $producto['precio_venta'] ?>">
                            <input type="hidden" name="user_id" value="<?= $idUsuario ?>">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
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