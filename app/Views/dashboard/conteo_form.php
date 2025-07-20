<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= esc($titulo) ?></h3>
                <div class="card-tools">
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
                        <!-- Se añade un ID al tbody para identificarlo con JS -->
                        <tbody id="tabla-conteo-body">
                            <?= view('dashboard/_tabla_conteo_body', ['productos' => $productos]) ?>
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