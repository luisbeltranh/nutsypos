<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <div class="card-title">
                            Ingreso Exitoso <?= $ingreso_exitoso['numero_ingreso']; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-4 col-6 mx-auto"> <!--begin::Small Box Widget 1-->
                            <div class="small-box text-bg-success text-center">
                                <div class="inner">
                                    <h3><?= $ingreso_exitoso['numero_ingreso'] ?></h3>
                                    <p>Número de Ingreso</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
                                </svg>
                            </div> <!--end::Small Box Widget 1-->
                        </div> <!--end::Col-->
                        <p>Se ingreso exitosamente el siguiente producto:</p>
                        <p><b>Producto:</b> <?= $ingreso_exitoso['nombre'] ?></p>
                        <p><b>Cantidad:</b> <?= $ingreso_exitoso['cantidad'] ?></p>
                        <p><b>Fecha:</b> <?= $ingreso_exitoso['fecha_ingreso'] ?></p>

                        <div class="card text-white bg-danger">
                            <div class="card-header">ATENCION</div>
                            <div class="card-body">
                                <p class="card-title">Ingreso # <?= $ingreso_exitoso['numero_ingreso'] ?></p>
                                <p class="card-text">Se debe registrar este numero de ingreso en el cuaderno fisico de ingresos.</p>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="/dashboard/veringresos" class="btn btn-primary" role="button">Continuar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->