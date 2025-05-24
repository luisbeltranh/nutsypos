<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-8">
                <?= form_open('dashboard/nuevo_embolsar/' . $producto['id']); ?>
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">
                            Embolsar - <?= esc($producto['nombre']) ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <?= validation_list_errors() ?>
                        <div>
                            Lista de Productos a Granel Necesarios para Emolsar este Producto
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Producto Granel</th>
                                    <th>Cantidad por Bolsa</th>
                                    <!-- <th>Cantidad Total</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($composicion as $compo) : ?>
                                    <tr>
                                        <td><?= esc($compo['nombre_granel']) ?></td>
                                        <td><?= esc($compo['cantidad_por_bolsa']) ?></td>
                                        <input type="hidden" class="form-control" name="cantidad[<?= esc($compo['producto_granel_id']) ?>]" id="cantidad[<?= esc($compo['producto_granel_id']) ?>]" value="<?= esc($compo['cantidad_por_bolsa']) ?>" required readonly>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label for="productos_granel_id">Producto a Granel</label>
                            <select name="producto_granel_id" id="" class="form-control" autofocus>
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
                            <label for="cantidad_bolsas_producidas">Cantidad de Producto en "GRAMOS"</label>
                            <input type="number" class="form-control" id="cantidad_producto_gr" name="cantidad_producto_gr" required>
                        </div>
                        <div class="form-group">
                        </div>


                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <input type="submit" class="btn btn-primary" value="Agregar Elemento">
                        <a href="#" class="btn btn-danger" role="button">Salir</a>


                    </div>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->


<!-- footer.php -->