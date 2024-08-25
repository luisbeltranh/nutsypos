<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

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
                            Embolsados
                            <div class="row row-cols-xs-1 row-cols-sm-6 g-1">
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Almendra', 10);">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Almendra<br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Amaranto', 5);">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Amaranto<br />5 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Arvejas', 10);">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Arvejas<br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Camote', 5);">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Camote <br />5 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Camote', 10);">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Camote <br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Cayu P', 10);">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Cayu<br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" onclick="articulocanasta('Cayu M', 20);">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Cayu <br />20 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Fid Choc<br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Papa Sal<br />5 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Papa Sal<br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Papa Pic<br />5 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Papa Pic<br />10 Bs.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text"><small>Camote 10</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Cayu 10</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Cayu 20</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text"><small>Fid Choc</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Almendra</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Amaranto</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Arvejas</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Camote 5</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text"><small>Camote 10</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Cayu 10</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Cayu 20</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text"><small>Fid Choc</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Almendra</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Amaranto</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Arvejas</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Camote 5</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text"><small>Camote 10</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Cayu 10</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Cayu 20</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Fideo Choc</p>
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
                            <h5>Order</h5>
                            <hr>
                            <ul id="articuloslista" class="list-unstyled">
                                <li><span class="text-success">2 </span>Papa Sal <span class="text-danger">10 Bs</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h1>Hello, world!</h1>

    <!-- SUMA DE LOS PRODUCTOS -->
    <script>
        function articulocanasta(nombreArticulo, precioArticulo) {
            const articuloslista = document.getElementById('articuloslista');
            const articuloVendido = document.createElement('li');
            const articuloVendidoPrecioSpan = document.createElement('span');
            const articuloVendidoNombre = document.createTextNode(nombreArticulo);
            const articuloVendidoPrecio = document.createTextNode(' ' + precioArticulo + ' Bs.')
            articuloVendidoPrecioSpan.className = 'text-danger';
            articuloVendidoPrecioSpan.appendChild(articuloVendidoPrecio);

            articuloVendido.appendChild(articuloVendidoNombre);
            articuloVendido.appendChild(articuloVendidoPrecioSpan);
            articuloslista.appendChild(articuloVendido);

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