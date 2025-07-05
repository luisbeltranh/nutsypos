<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-8">
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
                                    <th>Cantidad por Bolsa</th>
                                    <!-- <th>Cantidad Total</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($composicion as $compo) : ?>
                                    <tr>
                                        <td><?= esc($compo['nombre_granel']) ?></td>
                                        <td><?= esc($compo['cantidad_por_bolsa']) ?></td>
                                        <input type="hidden" class="form-control" name="cantidad[<?= esc($compo['producto_granel_id']) ?>]" id="cantidad[<?= esc($compo['producto_granel_id']) ?>]" value="<?= esc($compo['cantidad_por_bolsa']) ?>" required readonly>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php
                        if (isset($existe_composicion)) {
                        ?>
                            <div class="form-group">
                                <label for="cantidad_bolsas_producidas">Cantidad de Bolsas a Producir</label>
                                <input type="number" class="form-control" id="cantidad_bolsas_producidas" name="cantidad_bolsas_producidas" autofocus required>
                            </div>
                            <div class="form-group">
                            </div>

                        <?php
                        } else {
                        ?>
                            <div class="bg-danger text-center">
                                <div>
                                    <p>NO EXISTE LA COMPOSICION DEL EMBOLSADO.</p>
                                    <p>Click en en el boton "Crear Composición" para crear la composicion.</p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <?php
                        if (isset($existe_composicion)) {
                        ?>
                            <input type="submit" class="btn btn-primary" value="Siguiente">
                            <a href="/dashboard/agregarembolsadogranel" class="btn btn-danger" role="button">Cancelar</a>
                        <?php
                        } else {
                        ?>
                            <a href="/dashboard/crear_composicion/<?= $producto['id'] ?>" class="btn btn-primary" role="button">Crear Composición</a>
                            <a href="/dashboard/agregarembolsadogranel" class="btn btn-danger" role="button">Cancelar</a>
                        <?php
                        }
                        ?>


                    </div>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->


<!-- footer.php -->