<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Resultado del Ajuste a Granel #<?= esc($resumen['numero_ajuste']) ?></h3>
                <div class="card-tools">
                    <a href="<?= site_url('dashboard/conteo-inventario-granel/formularioConteo') ?>" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Realizar Nuevo Ajuste</a>
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
                                <th class="text-center">Diferencia (Kg/Lt)</th>
                                <th class="text-end">Diferencia (Dinero)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ajustes)): foreach ($ajustes as $ajuste): ?>
                                    <tr>
                                        <td><?= esc($ajuste['nombre_producto']) ?></td>
                                        <td class="text-center"><?= number_format($ajuste['cantidad_sistema'], 3) ?></td>
                                        <td class="text-center"><?= number_format($ajuste['cantidad_contada'], 3) ?></td>
                                        <td class="text-center fw-bold"><?= ($ajuste['diferencia'] > 0 ? '+' : '') . number_format($ajuste['diferencia'], 3) ?></td>
                                        <td class="text-end fw-bold"><?= number_format($ajuste['total_diferencia'], 2) ?></td>
                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Totales Generales:</th>
                                <th class="text-center fs-5 fw-bolder"><?= ($resumen['total_unidades_diferencia'] > 0 ? '+' : '') . number_format($resumen['total_unidades_diferencia'], 3) ?></th>
                                <th class="text-end fs-5 fw-bolder"><?= number_format($resumen['total_dinero_diferencia'], 2) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>