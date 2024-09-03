<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="/assets/css/estilo-pos.css">
    <title>Hello, world!</title>
</head>

<body>
    <div class="bg-dark p-3">
        <div class="row bg-light">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">Venta: 35</div>
                    <div class="col-sm-6">Fecha: 12 de octubre de 2024</div>

                </div>
                <div class="row">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Embolsados</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Bebidas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Otros</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row row-cols-xs-1 row-cols-sm-6 g-1">
                                <?php
                                foreach ($productos as $producto) {
                                ?>
                                    <div class="col">
                                        <div class="card" onclick="agregarArticulo(<?= $producto['id']; ?>,'<?= $producto['nombre']; ?>', <?= $producto['precio_venta']; ?>);">
                                            <div class="card-body">
                                                <p class="card-text"><?= $producto['nombre']; ?><br /><?= $producto['precio_venta']; ?> Bs.</p>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">Bebidas</div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex justify-content-between align-items-center"><span>Order</span><button onclick="limpiarCanasta()" class="btn bt-sm btn-danger">Limpiar</button></h5>
                            <hr>
                            <ul id="articulosLista" class="list-unstyled">
                                <li class="d-flex justify-content-between align-items-center"><span class="text-success">2 </span>Papa Sal <span class="text-danger">10 Bs</span><span>hola</span></li>
                            </ul>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <big>Total Articulos: </big><big id="totalArticulos" class="card-text fw-bold">0</big>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <big>Monto Total: </big> <big class="card-text fw-bold"><span id="costoTotal">0</span> Bs.</big>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary btn-lg w-100">PAGAR</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h1>Hello, world!</h1>
    <?= "<pre>" ?>
    <?php print_r($productos); ?>
    <?= "</pre>" ?>
    <?php echo "</br>" . json_encode($productos); ?>

    <!-- JAvascript hace la venta -->

    <script>
        var ARTICULOS = [];
        //var PRODUCTOS = {};
        var PRODUCTOS = <?php echo  json_encode($productos); ?>;

        function agregarArticulo(idProducto, nombreProducto, precioProducto) {


            // alert(idArticulo + " - " + nombreArticulo + " - " + precioArticulo);
            // PRODUCTOS = {
            //     idProducto: idProducto,
            //     nombreProducto: nombreProducto,
            //     precioProducto: precioProducto
            // };
            //ver si el articulo se repite en la canasta




            ARTICULOS.push(PRODUCTOS);
            refrescarVistaItems();
            console.log(ARTICULOS);
            //console.log(PRODUCTOS);

        }

        function refrescarVistaItems() {
            // Incrementamos el total de articulos en totalArticulos
            var contadorArticulos = document.getElementById("totalArticulos");
            contadorArticulos.innerHTML = ARTICULOS.length;
            // Agregamos el producto al UL articulosLista
            var articuloCanasta = document.getElementById("articulosLista")
            articuloCanasta.innerHTML = "";
            for (let i = ARTICULOS.length - 1; i >= 0; i--) {
                articuloCanasta.innerHTML += agregarArticuloHtml(ARTICULOS[i]);
                alert(ARTICULOS[i]);
            }

        }

        function agregarArticuloHtml(datos) {
            return ` 
            <li class = "d-flex justify-content-between align-items-center"> <span class = "text-success"> - </span>${datos.nombre}<span class="text-danger">${datos.precioProducto} Bs</span> <span> hola </span></li >
                `;
        }

        function limpiarCanasta() {
            ARTICULOS.length = 0;
            refrescarVistaItems();
            alert('Limpiar Canasta');
        }
    </script>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>