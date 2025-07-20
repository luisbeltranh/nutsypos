<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?= esc($titulo) ?></h3>
                    </div>
                    <!-- Formulario para procesar la salida -->
                    <form action="<?= site_url('dashboard/transferencias/procesarSalida') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="producto_id" value="<?= esc($producto['id']) ?>">

                        <div class="card-body">
                            <!-- Mostrar información del producto -->
                            <div class="mb-3">
                                <h5>Producto: <span class="fw-light"><?= esc($producto['nombre']) ?></span></h5>
                                <h5>Stock Actual: <span class="fw-light"><?= esc($producto['cantidad_total']) ?> unidades</span></h5>
                            </div>

                            <!-- Campo para la cantidad -->
                            <div class="form-group mb-3">
                                <label for="cantidad" class="form-label">Cantidad a Transferir</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad"
                                    placeholder="Ingrese la cantidad de unidades" required step="any" min="0.01">
                            </div>

                            <!-- Campo para comentario -->
                            <div class="form-group">
                                <label for="comentario" class="form-label">Comentario (Opcional)</label>
                                <textarea class="form-control" id="comentario" name="comentario" rows="3"
                                    placeholder="Ej: Para la sucursal del centro"></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Registrar Transferencia</button>
                            <a href="<?= site_url('dashboard/productos') ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>