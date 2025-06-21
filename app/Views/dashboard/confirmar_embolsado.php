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
                                    <th>Cantidad por Bolsa [Kg]</th>
                                    <th>Cantidad de Bolsas</th>
                                    <th>Total en Kilogramos</th>
                                    <!-- <th>Cantidad Total</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($composicion as $compo) : ?>
                                    <tr>
                                        <td><?= esc($compo['nombre_granel']) ?></td>
                                        <td><?= esc($compo['cantidad_por_bolsa']) / 1000 ?></td>
                                        <td><?= $cantidad_embolsar; ?></td>
                                        <td>
                                            <input type="number" class="form-control" name="cantidad[<?= esc($compo['producto_granel_id']) ?>]" id="cantidad[<?= esc($compo['producto_granel_id']) ?>]" value="<?= esc($compo['cantidad_por_bolsa'] * $cantidad_embolsar / 1000) ?>" required readonly>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="cantidad_bolsas_producidas" name="cantidad_bolsas_producidas" value="<?= $cantidad_embolsar; ?>" required>
                            <input type="hidden" class="form-control" id="confirmar" name="confirmar" value="true">
                        </div>
                        <div class="form-group">
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <input type="submit" class="btn btn-primary" value="Siguiente" onclick="return confirm('Are you sure you want to search Google?')">
                        <a href="<?= base_url('dashboard/agregarembolsadogranel') ?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->


<!-- footer.php -->