<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= esc($titulo) ?></h3>
                <div class="card-tools">
                    <?php if (!$conteoEnCurso): ?>
                        <a href="<?= site_url('dashboard/conteo-inventario/formularioConteo') ?>" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Iniciar Nuevo Ajuste
                        </a>
                    <?php else: ?>
                        <a href="#" class="btn btn-secondary" disabled title="Finalice el conteo en curso para iniciar uno nuevo.">
                            <i class="bi bi-plus-circle"></i> Iniciar Nuevo Ajuste
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"># Ajuste</th>
                                <th>Fecha de Inicio</th>
                                <th>Realizado por</th>
                                <th class="text-center">Dif. (Uds.)</th>
                                <th class="text-end">Dif. (Dinero)</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($resumenes)): ?>
                                <?php foreach ($resumenes as $resumen): ?>
                                    <tr class="<?= (isset($resumen['en_curso']) && $resumen['en_curso']) ? 'table-warning' : '' ?>">
                                        <td class="text-center">
                                            <span class="badge <?= (isset($resumen['en_curso']) && $resumen['en_curso']) ? 'bg-warning text-dark' : 'bg-secondary' ?>">
                                                <?= esc($resumen['numero_ajuste']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($resumen['fecha_ajuste'])) ?></td>
                                        <td><?= esc($resumen['username'] ?? 'N/A') ?></td>
                                        <td class="text-center fw-bold
                                            <?php if (!isset($resumen['en_curso'])) {
                                                echo ($resumen['total_unidades_diferencia'] > 0) ? 'text-success' : (($resumen['total_unidades_diferencia'] < 0) ? 'text-danger' : '');
                                            } ?>">
                                            <?= isset($resumen['en_curso']) ? esc($resumen['total_unidades_diferencia']) : (($resumen['total_unidades_diferencia'] > 0 ? '+' : '') . esc($resumen['total_unidades_diferencia'])) ?>
                                        </td>
                                        <td class="text-end fw-bold
                                            <?php if (!isset($resumen['en_curso'])) {
                                                echo ($resumen['total_dinero_diferencia'] > 0) ? 'text-success' : (($resumen['total_dinero_diferencia'] < 0) ? 'text-danger' : '');
                                            } ?>">
                                            <?= isset($resumen['en_curso']) ? esc($resumen['total_dinero_diferencia']) : number_format($resumen['total_dinero_diferencia'], 2) ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if (isset($resumen['en_curso']) && $resumen['en_curso']): ?>
                                                <a href="<?= site_url('dashboard/conteo-inventario/formularioConteo') ?>" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Continuar Conteo
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= site_url('dashboard/conteo-inventario/resultadoAjuste/' . $resumen['numero_ajuste']) ?>" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> Ver Detalles
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No hay ajustes de inventario registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>