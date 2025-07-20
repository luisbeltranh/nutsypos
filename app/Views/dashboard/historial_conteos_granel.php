<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= esc($titulo) ?></h3>
                <div class="card-tools">
                    <?php if (!$conteoEnCurso): ?>
                        <a href="<?= site_url('dashboard/conteo-inventario-granel/formularioConteo') ?>" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Iniciar Nuevo Ajuste
                        </a>
                    <?php else: ?>
                        <a href="#" class="btn btn-secondary" disabled>Iniciar Nuevo Ajuste</a>
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
                                <th class="text-center">Dif. (Kg/Lt)</th>
                                <th class="text-end">Dif. (Dinero)</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($resumenes)): foreach ($resumenes as $resumen): ?>
                                    <tr class="<?= (isset($resumen['en_curso'])) ? 'table-warning' : '' ?>">
                                        <td class="text-center"><span class="badge <?= (isset($resumen['en_curso'])) ? 'bg-warning text-dark' : 'bg-secondary' ?>"><?= esc($resumen['numero_ajuste']) ?></span></td>
                                        <td><?= date('d/m/Y H:i', strtotime($resumen['fecha_ajuste'])) ?></td>
                                        <td><?= esc($resumen['username'] ?? 'N/A') ?></td>
                                        <td class="text-center fw-bold"><?= esc($resumen['total_unidades_diferencia']) ?></td>
                                        <td class="text-end fw-bold"><?= esc($resumen['total_dinero_diferencia']) ?></td>
                                        <td class="text-center">
                                            <?php if (isset($resumen['en_curso'])): ?>
                                                <a href="<?= site_url('dashboard/conteo-inventario-granel/formularioConteo') ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Continuar</a>
                                            <?php else: ?>
                                                <a href="<?= site_url('dashboard/conteo-inventario-granel/resultadoAjuste/' . $resumen['numero_ajuste']) ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Ver</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No hay ajustes registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>