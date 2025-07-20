<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= esc($titulo) ?></h3>
                <div class="card-tools">
                    <!-- Se ha eliminado el atributo onclick de este enlace -->
                    <a href="<?= site_url('dashboard/conteo-inventario/finalizarAjuste') ?>" id="finalizarBtn" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Finalizar Ajuste
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Stock Sistema</th>
                                <th style="width: 150px;" class="text-center">Conteo Físico</th>
                                <th style="width: 100px;" class="text-center">Confirmar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($productos)): ?>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td><?= esc($producto['nombre']) ?></td>
                                        <td class="text-center"><?= esc($producto['cantidad_total']) ?></td>
                                        <td>
                                            <input
                                                type="number"
                                                step="any"
                                                class="form-control form-control-sm text-center conteo-fisico"
                                                data-id="<?= $producto['id'] ?>"
                                                value="<?= esc($producto['cantidad_contada']) ?>"
                                                <?= $producto['contado'] ? 'readonly' : '' ?>>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check d-flex justify-content-center">
                                                <input
                                                    class="form-check-input confirmar-conteo"
                                                    type="checkbox"
                                                    data-id="<?= $producto['id'] ?>"
                                                    <?= $producto['contado'] ? 'checked' : '' ?>>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No se encontraron productos.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- INICIO: Capa de bloqueo y carga -->
<div id="loader-overlay" style="display: none;">
    <div class="loader-spinner"></div>
    <p>Guardando...</p>
</div>
<!-- FIN: Capa de bloqueo y carga -->