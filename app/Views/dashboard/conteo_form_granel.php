<div class="app-content">
    <div class="container-fluid">

        <!-- INICIO: Bloque para mostrar mensajes de sesión -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <!-- FIN: Bloque para mostrar mensajes de sesión -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= esc($titulo) ?></h3>
                <div class="card-tools">
                    <a href="<?= site_url('dashboard/conteo-inventario-granel/finalizarAjuste') ?>" id="finalizarBtn" class="btn btn-success"><i class="bi bi-check-circle"></i> Finalizar Ajuste</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Stock Sistema (Kg/Lt)</th>
                                <th style="width: 150px;" class="text-center">Conteo Físico</th>
                                <th style="width: 100px;" class="text-center">Confirmar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($productos)): foreach ($productos as $producto): ?>
                                    <tr>
                                        <td><?= esc($producto['nombre']) ?></td>
                                        <td class="text-center"><?= number_format($producto['cantidad_total'], 3) ?></td>
                                        <td><input type="number" step="0.001" class="form-control form-control-sm text-center conteo-fisico" data-id="<?= $producto['id'] ?>" value="<?= esc($producto['cantidad_contada']) ?>" <?= $producto['contado'] ? 'readonly' : '' ?>></td>
                                        <td class="text-center">
                                            <div class="form-check d-flex justify-content-center"><input class="form-check-input confirmar-conteo" type="checkbox" data-id="<?= $producto['id'] ?>" <?= $producto['contado'] ? 'checked' : '' ?>></div>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No se encontraron productos a granel.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loader-overlay" style="display: none;">
    <div class="loader-spinner"></div>
    <p>Guardando...</p>
</div>