<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-8">
                <?= form_open('dashboard/agregarembolsadogranel') ?>
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">
                            Producto a Granel
                        </div>
                    </div>
                    <div class="card-body">
                        <?= validation_list_errors() ?>
                        <div class="form-group">
                            <label for="productos_granel_id">Producto a Granel</label>
                            <select name="producto_granel_id" id="" class="form-control">
                                <option value="">Seleccionar Producto</option>
                                <?php
                                foreach ($productos_granel as $producto_granel) {
                                    echo '<option value="' . $producto_granel['id'] . '"';
                                    echo '>';
                                    echo  $producto_granel['nombre'];
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad a Granel para el Embolsado</label>
                            <input type="text" class="form-control" name="cantidad_granel" autofocus>
                        </div>
                    </div>
                </div>
                <div class="card card-warning">
                    <div class="card-header">
                        <div class="card-title">
                            Producto Embolsado
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="productos_granel_id">Producto Embolsado</label>
                            <select name="producto_id" id="" class="form-control">
                                <option value="">Seleccionar Producto</option>
                                <?php
                                foreach ($productos as $producto) {
                                    echo '<option value="' . $producto['id'] . '"';
                                    echo '>';
                                    echo  $producto['nombre'];
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad de Embolsados</label>
                            <input type="text" class="form-control" name="cantidad_embolsado" autofocus>
                            <input type="hidden" name="numero_embolsado" value="<?= $numero_embolsado ?>">
                            <input type="hidden" name="user_id" value="<?= $idUsuario ?>">
                            <input type="hidden" name="numero_ingreso" value="<?= $numero_embolsado ?>">
                        </div>
                    </div>

                </div>
                <div class="card">
                    <div class="card-body">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->