<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-12">
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
                                    <th>Cantidad por Bolsa [g]</th>
                                    <th>Cantidad de Bolsas</th>
                                    <th>Total en [g]</th>
                                    <th>Inventario [g]</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($embolsado as $compo) : ?>
                                    <tr class="<?= esc($compo['clase']) ?>">
                                        <td><?= esc($compo['nombre_granel']) ?></td>
                                        <td><?= esc($compo['cantidad_por_bolsa']) ?></td>
                                        <td><?= $cantidad_embolsar; ?></td>
                                        <td>
                                            <input type="number" class="form-control" name="cantidad[<?= esc($compo['producto_granel_id']) ?>]" id="cantidad[<?= esc($compo['producto_granel_id']) ?>]" value="<?= esc($compo['peso_total_requerido']) ?>" size="8" required readonly>
                                        </td>
                                        <td><?= esc($compo['inventario_total_granel']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div>
                            <?php foreach ($embolsado as $compo) : ?>
                                <div><?= esc($compo['mensaje']) ?></div>
                            <?php endforeach; ?>
                        </div>
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
                        <input type="submit" class="btn btn-primary" value="Confirmar" onclick="return confirm('¿Esta seguro de continuar?')" <?= esc($boton_continuar) ?>>
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