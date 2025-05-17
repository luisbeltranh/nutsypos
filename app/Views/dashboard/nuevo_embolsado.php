<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-8">
                <?= form_open('dashboard/agregarembolsadogranel') ?>
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">
                            Producto a Granel
                        </div>
                    </div>
                    <div class="card-body">
                        <?= validation_list_errors() ?>
                        <div class="form-group">
                            <label for="producto_id">Producto Embolsado</label>
                            <select name="producto_id" id="producto_id" class="form-control">
                                <option value="">Seleccionar Producto</option>

                                <?php
                                if (!empty($productos)) {
                                    foreach ($productos as $producto) {
                                        echo '<option value="' . $producto['id'] . '"';
                                        echo 'producto_embolsado="' . esc(($producto['producto_embolsado'] > 0) ? 'true' : 'false') . '"';
                                        echo '>';
                                        echo  $producto['nombre'];
                                        echo '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cantidad_bolsas_producidas">Cantidad de Bolsas a Producir</label>
                            <input type="number" class="form-control" id="cantidad_bolsas_producidas" name="cantidad_bolsas_producidas" autofocus required>
                        </div>
                        <div class="form-group">
                            <div id="ingredientes-mezcla" style="display: none;">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="producto-simple" style="display:none">
                                <label for="producto_granel_id" class="form-label">Producto a Granel Utilizado</label>
                                <select class="form-select" id="producto_granel_id" name="producto_granel_id">
                                    <option value="">Seleccionar Producto a Granel</option>
                                    <?php if (!empty($productos_granel)) : ?>
                                        <?php foreach ($productos_granel as $producto) : ?>
                                            <option value="<?= esc($producto['id']) ?>" "><?= esc($producto['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <input type=" hidden" id="cantidad_granel_usada" name="cantidad_granel_usada" value="">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->


<!-- footer_nuevo_embolsado.php -->
<footer class="app-footer"> <!--begin::To the end-->
    <!--begin::Copyright-->
    <strong>
        Copyright &copy; 2024&nbsp;
        <a href="https://nutsypos.com" class="text-decoration-none">NutsyPOS v. 0.6.2</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer> <!--end::Footer-->
</div> <!--end::App Wrapper--> <!--begin::Script-->

<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="/assets/admin/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- sortablejs -->
<!-- Escript para ver la cantidad de productos a granel que necesitamos para embolsar el producto embolsado -->

<script>
    const productoEmbolsadoSelect = document.getElementById('producto_id');
    const cantidadBolsasInput = document.getElementById('cantidad_bolsas_producidas');
    const ingredientesMezclaDiv = document.getElementById('ingredientes-mezcla');
    const productoSimpleDiv = document.getElementById('producto-simple');

    productoEmbolsadoSelect.addEventListener('change', function() {
        cantidad_bolsas_producidas.innerHTML = ''; // Limpiar campos anteriores
        const esEmbolsado = selectedOption.getAttribute('producto_embolsado') === 'true';

    });
</script>

</body><!--end::Body-->

</html>