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
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Almendra', 10);">
                                        <div class="card-body">
                                            <p class="card-text">Almendra<br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Amaranto', 5);">
                                        <div class="card-body">
                                            <p class="card-text">Amaranto<br />5 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Arvejas', 10);">
                                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                                        <div class="card-body">
                                            <p class="card-text">Arvejas<br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Camote', 5);">
                                        <div class="card-body">
                                            <p class="card-text">Camote <br />5 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Camote', 10);">
                                        <div class="card-body">
                                            <p class="card-text">Camote <br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Cayu P', 10);">
                                        <div class="card-body">
                                            <p class="card-text">Cayu<br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Cayu M', 20);">
                                        <div class="card-body">
                                            <p class="card-text">Cayu <br />20 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Barra Maní M', 1.5);">
                                        <div class="card-body">
                                            <p class="card-text">Barra Maní <br />1.5 Bs.</p>
                                        </div>
                                    </div>
                                </div>

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
                            <h5 class="d-flex justify-content-between align-items-center"><span>Order</span><button onclick="articulosCanastaLimpiar()" class="btn bt-sm btn-danger">Limpiar</button></h5>
                            <hr>
                            <ul id="articuloslista" class="list-unstyled">
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

    <!-- SUMA DE LOS PRODUCTOS -->
    <script>
        const ordenIdArray = [];
        const totalArticulosArray = [];
        const totalCostoArray = [];
        let i = 0;

        // funcion para agregar articulos a la canasta
        function articulocanasta(nombreArticulo, precioArticulo) {
            ordenIdArray.push(i);
            totalArticulosArray.push(nombreArticulo);
            totalCostoArray.push(precioArticulo);



            //selecciona el ul con id articuloslista 
            let articuloslista = document.getElementById('articuloslista');

            // crea la etiqueta li
            const articuloVendido = document.createElement('li');
            // crea la clase de li
            articuloVendido.className = 'm-1 d-flex justify-content-between align-items-center';
            articuloVendido.setAttribute('onclick', 'borrarItem(' + i + ')');

            // Crea el span para el color rojo
            const articuloVendidoPrecioSpan = document.createElement('span');

            // Crea un nodo de texto con el nombreArticulo y el precioArticulo
            const articuloVendidoNombre = document.createTextNode(nombreArticulo);
            const articuloVendidoPrecio = document.createTextNode(' ' + precioArticulo + ' Bs.  ')
            // Ajusta el color a text-danger
            articuloVendidoPrecioSpan.className = 'text-danger';
            // Agregar articuloVendidoPrecio a el SPAN
            articuloVendidoPrecioSpan.appendChild(articuloVendidoPrecio);
            // Agregar articuloVendidoNombre a la etiqueta LI
            articuloVendido.appendChild(articuloVendidoNombre);
            // Agregar articuloVendidoPrecioSpan a la etiqueta LI

            articuloVendido.appendChild(articuloVendidoPrecioSpan);
            // Agregar la etiqueta LI a el padre id=ORDERLIST 
            articuloslista.appendChild(articuloVendido);




            // crea el boton de borrar
            const articuloVendidoBotonBorrar = document.createElement('button');
            const botonEliminar = document.createTextNode('-');
            articuloVendidoBotonBorrar.className = 'btn btn-danger';
            articuloVendidoBotonBorrar.appendChild(botonEliminar);
            articuloVendidoPrecioSpan.appendChild(articuloVendidoBotonBorrar);



            // Muestra la cantidad de articulos en el totalArticulosArray en el ID totalArticulos
            sumaCantidadArticulos();
            // Muestra la suma de articulos en el totalCostoArray en el ID costoTotal
            sumaCostoArticulos();


            i++;

            console.log(ordenIdArray);



        }


        function sumaCantidadArticulos() {
            document.getElementById('totalArticulos').innerText = totalArticulosArray.length;
        }

        function sumaCostoArticulos() {
            if (totalCostoArray.length === 0) {
                document.getElementById('costoTotal').innerText = 0;
            } else {
                document.getElementById('costoTotal').innerText = totalCostoArray.reduce(sumaCostoArray).toFixed(2);

                //  suma el array sumaCostoArray y luego devuelve el resultado
                function sumaCostoArray(total, num) {
                    return total + num;
                }
            }
        }

        function articulosCanastaLimpiar() {
            let articuloslista = document.getElementById('articuloslista');
            articuloslista.innerHTML = '';
            totalArticulosArray.length = 0;
            totalCostoArray.length = 0;
            ordenIdArray.length = 0;
            i = 0;
            // Muestra la cantidad de articulos en el totalArticulosArray en el ID totalArticulos
            sumaCantidadArticulos();
            // Muestra la suma de articulos en el totalCostoArray en el ID costoTotal
            sumaCostoArticulos();
        }

        function borrarItem(itemId) {
            const indexNumero = ordenIdArray.indexOf(itemId);
            ordenIdArray.splice(indexNumero, 1);
            // totalArticulosArray.splice(indexNumero, 1);
            // totalCostoArray.splice(indexNumero, 1);
            sumaCantidadArticulos();
            sumaCostoArticulos();
            console.log(ordenIdArray);



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