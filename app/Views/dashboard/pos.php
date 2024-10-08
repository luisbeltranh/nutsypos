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
    <title>Caja - NutsyPOS</title>
</head>

<body>
    <div class="bg-dark p-3">
        <div class="row bg-light">
            <div class="col-sm-8">
                <div class="row">
                    <ul class="nav nav-pills m-1" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Snacks</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-bebidas-tab" data-bs-toggle="pill" data-bs-target="#pills-bebidas" type="button" role="tab" aria-controls="pills-bebidas" aria-selected="false">Bebidas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Otros</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row row-cols-xs-1 row-cols-sm-6 g-1">
                                <?php
                                $indice = 0;
                                foreach ($productos as $producto) {
                                    $productos[$indice]['arrayIndex'] = $indice;
                                    $indice++;
                                }
                                foreach ($productos as $producto) {
                                    if ($producto['categoria'] == 'snacks') {

                                ?>
                                        <div class="col">
                                            <div class="card" onclick="agregarArticulo(<?= $producto['id']; ?>,'<?= $numero_venta; ?>', <?= $producto['arrayIndex'] ?>);">
                                                <div class="card-body">
                                                    <p class="card-text text-nowrap overflow-hidden"><?= $producto['nombre']; ?><br /><?= $producto['precio_venta']; ?> Bs.</p>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-bebidas" role="tabpanel" aria-labelledby="pills-bebidas-tab">
                            <div class="row row-cols-xs-1 row-cols-sm-6 g-1">
                                <?php
                                foreach ($productos as $producto) {
                                    if ($producto['categoria'] == 'bebidas') {
                                ?>
                                        <div class="col">
                                            <div class="card" onclick="agregarArticulo(<?= $producto['id']; ?>,'<?= $numero_venta ?>', <?= $producto['arrayIndex'] ?>);">
                                                <div class="card-body">
                                                    <p class="card-text text-nowrap overflow-hidden"><?= $producto['nombre']; ?><br /><?= $producto['precio_venta']; ?> Bs.</p>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-3">Venta: <?= $numero_venta ?></div>
                    <div class="col-sm-9">Fecha: <?= date('d-m-y h:m:s'); ?></div>

                </div>

                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex justify-content-between align-items-center"><a href="/dashboard" class="btn bt-sm btn-warning">SALIR</a><button onclick="limpiarCanasta()" class="btn bt-sm btn-danger">Limpiar</button></h5>
                            <hr>
                            <ul id="articulosLista" class="list-unstyled">
                            </ul>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <big>Total Articulos: </big><big id="totalArticulos" class="card-text fw-bold">0</big>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <big>Monto Total: </big> <big class="card-text fw-bold" id="valorTotal"><span>0</span> Bs.</big>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary btn-lg w-100" onclick="guardarDatos('asd')" id="boton_pagar">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span>
                                    PAGAR
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JAvascript hace la venta -->

    <script>
        //var PRODUCTOS = {};
        var result = <?php echo json_encode($productos); ?>;
        //var obj = JSON.parse(result);
        //var PRODUCTOS = [];
        var PRODUCTOS = result;
        var ARTICULOS = [];
        var compraTotal = 0;
        // console.log(PRODUCTOS);

        function agregarArticulo(idProducto, numeroVenta, index) {
            for (let i = ARTICULOS.length - 1; i >= 0; i--) {
                if (isNaN(ARTICULOS[i].cantidad)) {
                    ARTICULOS[i].cantidad = 0;
                }
                if (ARTICULOS[i].id == idProducto) {
                    ARTICULOS[i].cantidad += 1;
                    ARTICULOS[i].numero_venta = numeroVenta;
                    refrescarVistaItems();
                    return;
                };
            }

            var temp = PRODUCTOS[index];
            temp.cantidad = 1;
            temp.numero_venta = numeroVenta;
            ARTICULOS.push(temp);
            //compraTotal += Number(PRODUCTOS[index].precio_venta);
            // console.log(ARTICULOS);
            refrescarVistaItems();
            //console.log(compraTotal);

        }

        function eliminarArticulo(idProducto, indiceItem) {
            console.log(idProducto);
            console.log(ARTICULOS);
            ARTICULOS = ARTICULOS.filter(unarticulo => unarticulo.id != idProducto);
            console.log(ARTICULOS);
            refrescarVistaItems();
            //  var element = document.getElementById(idProducto);
            // element.parentNode.removeChild(element);
        }


        function refrescarVistaItems() {
            var compraTotal = 0;
            var cantidadTotal = 0;

            // Agregamos el producto al UL articulosLista
            var articuloCanasta = document.getElementById("articulosLista")
            articuloCanasta.innerHTML = "";
            for (let i = ARTICULOS.length - 1; i >= 0; i--) {
                articuloCanasta.innerHTML += agregarArticuloHtml(ARTICULOS[i], i);
                compraTotal += Number(ARTICULOS[i].precio_venta) * Number(ARTICULOS[i].cantidad);
                cantidadTotal += Number(ARTICULOS[i].cantidad);
            }
            // sumar el total de la venta
            valorTotal = document.getElementById("valorTotal");
            valorTotal.innerHTML = compraTotal;
            // Incrementamos el total de articulos en totalArticulos
            var contadorArticulos = document.getElementById("totalArticulos");
            contadorArticulos.innerHTML = cantidadTotal;
        }

        function agregarArticuloHtml(datos, indiceItem) {
            return ` 
            <li id = "${indiceItem}" class = "d-flex justify-content-between align-items-center"> <span class = "text-success"> ${datos.cantidad} </span>${datos.nombre}<span class="text-danger">${datos.precio_venta} Bs</span> <span class = "h-50" onclick = "eliminarArticulo(${datos.id}, ${indiceItem})"><button type="button" class="btn btn-danger btn-md"> - </button></span></li>
                `;
        }



        function sumarArticulos(costoArticulo) {}

        function limpiarCanasta() {
            ARTICULOS.length = 0;
            refrescarVistaItems();
        }

        function guardarDatos($datos) {
            console.log(ARTICULOS);
            let mensaje = "Guardar Venta?";
            let spinner = document.getElementById("spinner");
            let boton_pagar = document.getElementById("boton_pagar");
            boton_pagar.disabled = true;
            spinner.style.display = "inline-block";
            if (confirm(mensaje) == true) {
                fetch("<?= base_url('dashboard/ventaproducto') ?>", {
                    method: "POST",
                    body: JSON.stringify(ARTICULOS),
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    }
                }).then(response => {
                    if (response.status === 200) {
                        window.location.reload();
                        return response.json();
                    }
                });
                //limpiarCanasta();

            } else {
                return;
            }
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