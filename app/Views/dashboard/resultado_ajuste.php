<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= esc($titulo) ?></h3>
                <div class="card-tools">
                    <a href="<?= site_url('dashboard/conteo-inventario/formularioConteo') ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Realizar Nuevo Ajuste
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cant. Sistema</th>
                                <th class="text-center">Cant. Contada</th>
                                <th class="text-center">Diferencia (Uds.)</th>
                                <th class="text-end">Diferencia (Dinero)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ajustes)): ?>
                                <?php foreach ($ajustes as $ajuste): ?>
                                    <tr>
                                        <td><?= esc($ajuste['nombre_producto']) ?></td>
                                        <td class="text-center"><?= esc($ajuste['cantidad_sistema']) ?></td>
                                        <td class="text-center"><?= esc($ajuste['cantidad_contada']) ?></td>
                                        <td class="text-center fw-bold 
                                            <?= ($ajuste['diferencia'] > 0) ? 'text-success' : (($ajuste['diferencia'] < 0) ? 'text-danger' : '') ?>">
                                            <?= ($ajuste['diferencia'] > 0 ? '+' : '') . esc($ajuste['diferencia']) ?>
                                        </td>
                                        <?php
                                        // Se añade un valor por defecto de 0 si la clave no existe para evitar el error.
                                        $total_diferencia_item = $ajuste['total_diferencia'] ?? 0;
                                        ?>
                                        <td class="text-end fw-bold
                                            <?= ($total_diferencia_item > 0) ? 'text-success' : (($total_diferencia_item < 0) ? 'text-danger' : '') ?>">
                                            <?= number_format($total_diferencia_item, 2) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Totales Generales:</th>
                                <th class="text-center fs-5 fw-bolder
                                    <?= ($resumen['total_unidades_diferencia'] > 0) ? 'text-success' : (($resumen['total_unidades_diferencia'] < 0) ? 'text-danger' : '') ?>">
                                    <?= ($resumen['total_unidades_diferencia'] > 0 ? '+' : '') . esc($resumen['total_unidades_diferencia']) ?>
                                </th>
                                <th class="text-end fs-5 fw-bolder
                                    <?= ($resumen['total_dinero_diferencia'] > 0) ? 'text-success' : (($resumen['total_dinero_diferencia'] < 0) ? 'text-danger' : '') ?>">
                                    <?= number_format($resumen['total_dinero_diferencia'], 2) ?>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center">
                <p>El ajuste se ha completado y el inventario ha sido actualizado.</p>
            </div>
        </div>
    </div>
</div>