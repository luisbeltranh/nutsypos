<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="card">
                <div class="card-header">
                    <div class="">
                        <div class="input-group">
                            <div class="col-sm-4">
                                Elegir fecha:
                            </div>
                            <div cls="col-sm-6">
                                <?= form_open('dashboard/reportediario') ?>
                                <input type="date" name="fecha" value="<?= $fecha_hoy ?>">
                                <input type="submit" class="btn btn-primary">
                                <?= form_close() ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="text-center">
                            <h4>Informe de Cierre del Día <?= $fecha_informe ?></h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3><?= $informe['ventas_total']['total'] ?></h3>
                                    <p>Ingresos Totales</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                                </svg>
                            </div> <!--end::Small Box Widget 1-->
                        </div>
                        <div class="col-lg-2 col-4">
                            <div class="small-box text-bg-danger">
                                <div class="inner">
                                    <h3><?= $informe['costo_productos_vendidos']['total_costo'] ?></h3>
                                    <p>Costo Mercancia</p>
                                </div><svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                                </svg>
                            </div> <!--end::Small Box Widget 1-->
                        </div>
                        <div class="col-lg-2 col-4">
                            <div class="small-box text-bg-danger">
                                <div class="inner">
                                    <h3><?= $informe['gastos_total']['monto'] ?></h3>
                                    <p>Gastos</p>
                                </div><svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                                </svg>
                            </div> <!--end::Small Box Widget 1-->
                        </div>
                        <div class="col-lg-2 col-4">
                            <div class="small-box text-bg-info">
                                <div class="inner">
                                    <h3><?= $informe['efectivo_caja'] ?></h3>
                                    <p>Efectivo en Caja</p>
                                    </p>
                                </div><svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                                </svg>
                            </div> <!--end::Small Box Widget 1-->
                        </div>
                        <div class="col-lg-2 col-4">
                            <div class="small-box text-bg-info">
                                <div class="inner">
                                    <h3><?= $informe['ganancia_bruta'] ?></h3>
                                    <p>Ganancia Bruta del Día</p>
                                </div><svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                                </svg>
                            </div> <!--end::Small Box Widget 1-->
                        </div>
                        <div class="col-lg-2 col-4">
                            <div class="small-box text-bg-success">
                                <div class="inner">
                                    <h3><?= $informe['efectivo_arqueo'] ?></h3>
                                    <p>Efectivo Arqueo</p>
                                </div><svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                                </svg>
                            </div> <!--end::Small Box Widget 1-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Operaciones de Día</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Cantidad de Ventas </td>
                                        <td><?= $informe['cantidad_ventas']['cantidad_ventas'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Articulos Vendidos </td>
                                        <td><?= $informe['cantidad_articulos_vendidos']['cantidad_articulos_vendidos'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Venta Promedio </td>
                                        <td><?= $informe['venta_promedio'] ?></td>
                                    </tr>
                                </tbody>
                            </table> <!--end::Table-->
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Metodos de Pago</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Efectivo </td>
                                        <td><?= $informe['ventas_Efectivo']['total'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>QR </td>
                                        <td><?= $informe['ventas_QR']['total'] ?></td>
                                    </tr>
                                </tbody>
                            </table> <!--end::Table-->
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <h5>Movimiento de Productos Embolsados</h5>
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Movimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($informe['ingreso_productos'] as $ingreso) {
                                    ?>
                                        <tr>
                                            <td><?= $ingreso['producto_nombre'] ?></td>
                                            <td><?= $ingreso['cantidad'] ?></td>
                                            <td><?= $ingreso['tipo_ingreso'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table> <!--end::Table-->
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <h5>Movimiento de Productos a Granel</h5>
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad [g]</th>
                                        <th>Movimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($informe['ingresos_granel'] as $ingreso) {
                                    ?>
                                        <tr>
                                            <td><?= $ingreso['producto_granel_nombre'] ?></td>
                                            <td><?= $ingreso['cantidad'] ?></td>
                                            <td><?= $ingreso['tipo_movimiento'] ?> </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table> <!--end::Table-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h4>Rendimiento de Productos</h4>
                    <div class="col-lg-12">
                        <div class="table-responsive p-0">
                            <table class="table table-hover table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Productos Más Vendidos</th>
                                        <th>Cantidad</th>
                                        <th>Total Vendido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($informe['mas_vendidos'] as $producto) {
                                    ?>
                                        <tr>
                                            <td><?= $producto['producto_nombre'] ?></td>
                                            <td><?= $producto['total_cantidad'] ?></td>
                                            <td><?= $producto['total_vendido'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table> <!--end::Table-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="alert alert-warning" role="alert">
                        <h4>Alertas de inventario Unitario Bajo</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive p-0">
                            <table class="table table-hover table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($informe['inventario_unitario_bajo'] as $producto) {
                                    ?>
                                        <tr>
                                            <td><?= $producto['nombre'] ?></td>
                                            <td><?= $producto['cantidad_total'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table> <!--end::Table-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="alert alert-warning">
                        <h4>Alertas de inventario a Granel Bajo</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive p-0">
                            <table class="table table-hover table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad [g]</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($informe['inventario_granel_bajo'] as $producto) {
                                    ?>
                                        <tr>
                                            <td><?= $producto['nombre'] ?></td>
                                            <td><?= $producto['cantidad_total'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table> <!--end::Table-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <pre>
                    <?php //print_r($informe); 
                    ?>
                    </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main> <!--end::App Main--> <!--begin::Footer-->