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
                        <?php
                        if ($is_admin) {
                        ?>
                            <div class="form-group">
                                <label for="costo">Costo</label>
                                <input type="text" class="form-control" name="costo" value="<?= $producto['costo'] ?>" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="costo">Fecha de Ingreso</label>
                                <input type="datetime-local" class="form-control" name="created_at" value="<?= date('Y-m-d\TH:i:s') ?>">
                            </div>

                        <?php
                        }
                        ?>

                        <div class="form-group">
                            <label for="cantidad">Tipo de Movimiento</label>
                            <?php
                            if ($is_admin) {
                            ?>
                                <select name="tipo_movimiento" id="tipo_movimiento" class="form-control">
                                    <option value="compra">Compra (Ingreso regular de productos comprados)</option>
                                    <option value="embolsado">Embolsado (Ingreso de productos embolsados)</option>
                                    <option value="ajuste_sobrante">Ajuste Sobrante (Corrección de inventario por conteo físico - sobrante)</option>
                                    <option value="ajuste_faltante">Ajuste Faltante (Corrección de inventario por conteo físico - faltante)</option>
                                    <option value="transferencia_salida">Transferencia Salida (Envío de productos a otro local)</option>
                                    <option value="devolucion_cliente">Devolucion Cliente (Producto devuelto por un cliente)</option>
                                    <option value="devolucion_proveedor">Devolucion Proveedor (Producto devuelto al proveedor)</option>
                                    <option value="merma">Merma (Producto dañado, vencido, perdido)</option>
                                </select>


                            <?php
                            } else {
                            ?>
                                <input type="text" class="form-control" name="tipo_movimiento" value="compra" readonly="readonly">
                            <?php
                            }
                            ?>
                        </div>


                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <?php
                            if ($is_admin) {
                            ?>
                                <input type="number" class="form-control" name="cantidad" autofocus>

                            <?php
                            } else {
                            ?>
                                <input type="number" class="form-control" name="cantidad" autofocus min="0">
                            <?php
                            }
                            ?>

                            <input type="hidden" name="user_id" value="<?= $idUsuario ?>">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <input type="hidden" name="monto" value="<?= $producto['costo'] ?>">
                            <input type="hidden" name="numero_ingreso" value="<?= $numero_ingreso ?>">
                        </div>
                        <div class="form-group">
                            <label for="comentario">Comentario</label>
                            <input type="text" class="form-control" name="comentario" placeholder="Ingrese un comentario opcional">
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