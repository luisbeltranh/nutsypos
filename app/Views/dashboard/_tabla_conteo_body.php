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