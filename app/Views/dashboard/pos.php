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
        xintegrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous" />

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="/assets/css/estilo-pos.css">

    <style>
        /* Estilo para el cuerpo y la fuente Inter */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Tu estilo personalizado para btn-warning */
        /* Estilos para los productos agotados (si los implementas) */
        .card.producto-agotado {
            background-color: #dc3545;
            /* Rojo de Bootstrap (danger) */
            color: white;
            /* Texto blanco para contraste */
            opacity: 0.7;
            /* Mantener la opacidad para indicar inactividad */
            cursor: not-allowed;
            text-decoration: line-through;
            /* Opcional: tachar el nombre */
        }

        .card.producto-agotado .card-body {
            pointer-events: none;
            /* Deshabilita clics en el contenido */
        }

        /* Asegurarse de que el atributo disabled funcione en el div */
        .card[disabled] {
            cursor: not-allowed;
            /* Muestra el cursor de "no permitido" */
            opacity: 0.6;
            /* Un poco más de opacidad para indicar que está deshabilitado */
        }

        /* Estilos específicos para los modales de Bootstrap para que se vean bien */
        .modal-backdrop.show {
            opacity: 0.5;
            /* Ajusta la opacidad del fondo oscuro */
        }

        /* Estilos para la calculadora de pago */
        .calculator-display {
            font-size: 2rem;
            /* Ajustado para el nuevo layout */
            font-weight: bold;
            text-align: right;
            padding: 8px;
            /* Ajustado */
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #e9ecef;
            height: auto;
        }

        .calculator-keypad button {
            width: 100%;
            height: 55px;
            /* Ajustado */
            font-size: 1.3rem;
            /* Ajustado */
            margin: 4px 0;
            /* Ajustado */
        }

        /* Altura máxima para el cuerpo del modal de la calculadora */
        #paymentCalculatorModal .modal-body {
            max-height: calc(100vh - 150px);
            /* Mantenido para controlar la altura */
            overflow-y: auto;
            /* Permite desplazamiento vertical si el contenido excede la altura */
            padding-top: 10px;
            padding-bottom: 10px;
        }

        /* Ajustes para pantallas más pequeñas (ej. iPad en horizontal) */
        @media (max-width: 768px) {
            #paymentCalculatorModal .modal-body .mb-3 {
                margin-bottom: 0.5rem !important;
                /* Reduce el margen inferior de los elementos de display */
            }

            #paymentCalculatorModal .modal-footer {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }

            /* Ajustes específicos para los inputs en línea */
            #paymentCalculatorModal .form-label {
                /* Ya no es small-label, aplica a todos */
                font-size: 0.8rem;
                /* Etiqueta más pequeña */
                margin-bottom: 0.1rem !important;
                /* Margen muy pequeño */
            }

            #paymentCalculatorModal .calculator-display {
                /* Ya no es small-input, aplica a todos */
                font-size: 1.1rem;
                /* Input más pequeño */
                padding: 4px;
                /* Padding reducido */
            }

            .calculator-keypad button {
                height: 45px;
                /* Más pequeño en pantallas chicas */
                font-size: 1.1rem;
            }
        }
    </style>

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
                                        // Determinar si el producto está agotado para aplicar clases CSS y deshabilitar
                                        $isAgotado = ($producto['cantidad_total'] <= 0);
                                        $cardClass = $isAgotado ? 'card producto-agotado' : 'card';
                                        $onClickAttribute = $isAgotado ? '' : "onclick=\"agregarArticulo(" . $producto['id'] . ",'" . $numero_venta . "', " . $producto['arrayIndex'] . ");\"";
                                        // Añadir el atributo disabled si el producto está agotado
                                        $disabledAttribute = $isAgotado ? 'disabled' : '';
                                ?>
                                        <div class="col">
                                            <div class="<?= $cardClass ?>" <?= $onClickAttribute ?> <?= $disabledAttribute ?>>
                                                <div class="card-body">
                                                    <p class="card-text text-nowrap overflow-hidden">
                                                        <?= $producto['nombre']; ?><br />
                                                        <?= $producto['precio_venta']; ?> Bs.
                                                        <?php if ($isAgotado) : ?>
                                                            <!-- <br><span class="badge bg-danger">AGOTADO</span> -->
                                                        <?php endif; ?>
                                                    </p>
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
                                        $isAgotado = ($producto['cantidad_total'] <= 0);
                                        $cardClass = $isAgotado ? 'card producto-agotado' : 'card';
                                        $onClickAttribute = $isAgotado ? '' : "onclick=\"agregarArticulo(" . $producto['id'] . ",'" . $numero_venta . "', " . $producto['arrayIndex'] . ");\"";
                                        $disabledAttribute = $isAgotado ? 'disabled' : '';
                                ?>
                                        <div class="col">
                                            <div class="<?= $cardClass ?>" <?= $onClickAttribute ?> <?= $disabledAttribute ?>>
                                                <div class="card-body">
                                                    <p class="card-text text-nowrap overflow-hidden">
                                                        <?= $producto['nombre']; ?><br />
                                                        <?= $producto['precio_venta']; ?> Bs.
                                                        <?php if ($isAgotado) : ?>
                                                            <br><span class="badge bg-danger">AGOTADO</span>
                                                        <?php endif; ?>
                                                    </p>
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
                            <h5 class="d-flex justify-content-between align-items-center">
                                <a href="/dashboard" class="btn bt-sm btn-warning">SALIR</a>
                                <button onclick="limpiarCanasta()" class="btn bt-sm btn-danger">Limpiar</button>
                            </h5>
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
                            <?php
                            foreach ($formas_pago as $forma_pago) {
                            ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-<?= $forma_pago['color'] ?> btn-lg w-100" onclick="guardarDatos('<?= $forma_pago['id'] ?>')" id="boton_pagar">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span>
                                        <?= $forma_pago['nombre'] ?>
                                    </button>
                                </div>
                                </br>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenedores para los modales de Bootstrap -->
    <div id="bootstrapConfirmModalContainer"></div>
    <div id="bootstrapAlertDialogContainer"></div>
    <div id="paymentCalculatorModalContainer"></div> <!-- Nuevo contenedor para la calculadora -->

    <!-- JAvascript hace la venta -->
    <script>
        // ¡IMPORTANTE! Este archivo debe ser procesado por PHP antes de ser enviado al navegador.
        // Asegúrate de que este archivo tiene una extensión .php (ej. pos_view.php)
        // y que es cargado por un controlador de CodeIgniter (ej. return view('pos_view');)
        var result = <?php echo json_encode($productos); ?>;
        var PRODUCTOS = result; // Carga todos los productos
        var ARTICULOS = []; // Artículos en la canasta

        // --- Funciones para Modales de Bootstrap ---

        /**
         * Muestra un modal de confirmación personalizado usando Bootstrap.
         * (Esta función ya no se usa directamente en guardarDatos, pero se mantiene por si es útil en otro lugar)
         * @param {string} message El mensaje a mostrar.
         * @returns {Promise<boolean>} Resuelve a true si el usuario confirma, false si cancela.
         */
        function showBootstrapConfirm(message) {
            return new Promise((resolve) => {
                const modalId = 'bootstrapConfirmModal';
                const container = document.getElementById('bootstrapConfirmModalContainer');

                // Limpiar cualquier modal anterior
                container.innerHTML = '';

                const modalHtml = `
                    <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="${modalId}Label">Confirmación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ${message}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" id="confirmOkBtnBootstrap">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML = modalHtml;

                const myModal = new bootstrap.Modal(document.getElementById(modalId));
                myModal.show();

                const okBtn = document.getElementById('confirmOkBtnBootstrap');
                const modalElement = document.getElementById(modalId);

                let confirmedResult = false; // Variable para almacenar el resultado de la confirmación

                // Listener para el botón Aceptar
                okBtn.onclick = () => {
                    confirmedResult = true; // Se ha confirmado
                    myModal.hide(); // Oculta el modal
                };

                // Listener para cuando el modal está completamente oculto
                modalElement.addEventListener('hidden.bs.modal', () => {
                    container.innerHTML = ''; // Limpia el contenedor después de ocultar
                    resolve(confirmedResult); // Resuelve la promesa con el resultado final
                }, {
                    once: true
                });
            });
        }

        /**
         * Muestra un modal de alerta personalizado usando Bootstrap.
         * @param {string} message El mensaje a mostrar.
         * @param {string} type Tipo de mensaje ('success', 'error', 'info').
         * @returns {Promise<void>} Resuelve cuando el usuario cierra el modal.
         */
        function showBootstrapAlert(message, type = 'info') {
            return new Promise((resolve) => {
                const modalId = 'bootstrapAlertDialog';
                const container = document.getElementById('bootstrapAlertDialogContainer');
                container.innerHTML = ''; // Limpiar cualquier modal anterior

                let headerClass = '';
                let buttonClass = '';
                let title = '';

                switch (type) {
                    case 'success':
                        headerClass = 'bg-success text-white';
                        buttonClass = 'btn-success';
                        title = 'Éxito';
                        break;
                    case 'error':
                        headerClass = 'bg-danger text-white';
                        buttonClass = 'btn-danger';
                        title = 'Error';
                        break;
                    case 'info':
                    default:
                        headerClass = 'bg-info text-white';
                        buttonClass = 'btn-info';
                        title = 'Información';
                        break;
                }

                const modalHtml = `
                    <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header ${headerClass}">
                                    <h5 class="modal-title" id="${modalId}Label">${title}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ${message}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn ${buttonClass}" data-bs-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML = modalHtml;

                const myModal = new bootstrap.Modal(document.getElementById(modalId));
                myModal.show();

                const modalElement = document.getElementById(modalId);
                modalElement.addEventListener('hidden.bs.modal', () => {
                    container.innerHTML = ''; // Limpia el contenedor después de ocultar
                    resolve();
                }, {
                    once: true
                });
            });
        }

        /**
         * Muestra un modal de calculadora de pago para ingresar el monto recibido y calcular el cambio.
         * @param {number} totalVenta El monto total de la venta.
         * @returns {Promise<{confirmed: boolean, montoRecibido: number, cambio: number}>} Resuelve con los detalles del pago o {confirmed: false} si se cancela.
         */
        function showPaymentCalculator(totalVenta) {
            return new Promise((resolve) => {
                const modalId = 'paymentCalculatorModal';
                const container = document.getElementById('paymentCalculatorModalContainer');
                container.innerHTML = ''; // Limpiar cualquier modal anterior

                const modalHtml = `
                    <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md"> <!-- Mantenido modal-md para ancho -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="${modalId}Label">Calculadora de Pago</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-1 mb-2 align-items-center"> <!-- Fila para Total y Recibido -->
                                        <div class="col-6 text-center"> <!-- Columna para Total -->
                                            <label for="totalVentaDisplay" class="form-label mb-0">Total:</label>
                                            <input type="text" class="form-control calculator-display" id="totalVentaDisplay" value="${totalVenta.toFixed(2)} Bs." readonly>
                                        </div>
                                        <div class="col-6 text-center"> <!-- Columna para Recibido -->
                                            <label for="montoRecibidoInput" class="form-label mb-0">Recibido:</label>
                                            <input type="number" step="0.01" class="form-control calculator-display" id="montoRecibidoInput" value="0.00">
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-3"> <!-- Fila separada para Cambio -->
                                        <div class="col-12 text-center"> <!-- Columna para Cambio -->
                                            <label for="cambioDisplay" class="form-label mb-0">Cambio:</label>
                                            <input type="text" class="form-control calculator-display" id="cambioDisplay" value="0.00 Bs." readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-2 calculator-keypad">
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="1">1</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="2">2</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="3">3</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="4">4</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="5">5</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="6">6</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="7">7</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="8">8</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="9">9</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value=".">.</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-primary" data-value="0">0</button></div>
                                        <div class="col-4"><button type="button" class="btn btn-outline-danger" data-action="clear">C</button></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-success" id="confirmPaymentBtn">Confirmar Pago</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML = modalHtml;

                const myModal = new bootstrap.Modal(document.getElementById(modalId));
                myModal.show();

                const montoRecibidoInput = document.getElementById('montoRecibidoInput');
                const cambioDisplay = document.getElementById('cambioDisplay');
                const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');
                const keypadButtons = document.querySelectorAll('.calculator-keypad button');
                const modalElement = document.getElementById(modalId);

                let currentInput = '0'; // Para construir el número del teclado virtual

                const updateDisplay = () => {
                    montoRecibidoInput.value = parseFloat(currentInput).toFixed(2);
                    const montoRecibido = parseFloat(currentInput);
                    const cambio = montoRecibido - totalVenta;
                    cambioDisplay.value = cambio.toFixed(2) + " Bs.";
                    confirmPaymentBtn.disabled = montoRecibido < totalVenta; // Deshabilita si no cubre el total
                };

                // Event listeners para el teclado virtual
                keypadButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const value = button.dataset.value;
                        const action = button.dataset.action;

                        if (action === 'clear') {
                            currentInput = '0';
                        } else if (value === '.') {
                            if (!currentInput.includes('.')) {
                                currentInput += value;
                            }
                        } else {
                            if (currentInput === '0' && value !== '.') {
                                currentInput = value;
                            } else {
                                currentInput += value;
                            }
                        }
                        updateDisplay();
                    });
                });

                // Event listener para el input directo (si el usuario teclea)
                montoRecibidoInput.addEventListener('input', () => {
                    currentInput = montoRecibidoInput.value;
                    if (currentInput === '') currentInput = '0'; // Evitar NaN si el campo está vacío
                    updateDisplay();
                });

                // Inicializar display
                updateDisplay();

                let paymentConfirmed = false; // Para saber si se confirmó el pago

                confirmPaymentBtn.onclick = () => {
                    paymentConfirmed = true;
                    myModal.hide();
                };

                modalElement.addEventListener('hidden.bs.modal', () => {
                    container.innerHTML = ''; // Limpia el contenedor
                    const montoRecibido = parseFloat(montoRecibidoInput.value);
                    const cambioCalculado = montoRecibido - totalVenta;
                    resolve({
                        confirmed: paymentConfirmed,
                        montoRecibido: montoRecibido,
                        cambio: cambioCalculado
                    });
                }, {
                    once: true
                });
            });
        }


        // --- Tu función guardarDatos actualizada ---

        async function guardarDatos(forma_pago_id) {
            console.log(ARTICULOS);
            // Verificar si la canasta está vacía
            if (ARTICULOS.length === 0) {
                await showBootstrapAlert("La canasta está vacía. Agregue productos para realizar una venta.", 'info');
                return; // Detener la ejecución si la canasta está vacía
            }

            let spinner = document.getElementById("spinner");
            let boton_pagar = document.getElementById("boton_pagar");

            // Deshabilitar botón y mostrar spinner inmediatamente
            boton_pagar.disabled = true;
            spinner.style.display = "inline-block";

            // Obtener el monto total de la venta
            const totalVenta = parseFloat(document.getElementById("valorTotal").innerText);

            // Usar el modal de calculadora de pago
            const paymentResult = await showPaymentCalculator(totalVenta);

            if (paymentResult.confirmed) {
                try {
                    // Construir la URL de forma segura para evitar "null" o "undefined" en la ruta
                    const url = `<?= base_url('dashboard/ventaproducto/') ?>${forma_pago_id !== null && forma_pago_id !== undefined ? forma_pago_id : ''}`;

                    const response = await fetch(url, { // Usar la URL construida
                        method: "POST",
                        body: JSON.stringify(ARTICULOS),
                        headers: {
                            "Content-type": "application/json; charset=UTF-8"
                        }
                    });

                    // Verificar si la respuesta no es OK (ej. 4xx o 5xx)
                    if (!response.ok) {
                        const errorData = await response.json(); // Intentar obtener el JSON de error
                        // Lanzar un error para que sea capturado por el bloque catch
                        throw new Error(errorData.message || 'Error desconocido del servidor.');
                    }

                    const data = await response.json(); // Parsear la respuesta JSON de éxito

                    if (data.status === 'success') {
                        // NO mostrar modal de éxito, solo recargar la página
                        // await showBootstrapAlert(data.message + "<br>Monto Recibido: " + paymentResult.montoRecibido.toFixed(2) + " Bs.<br>Cambio: " + paymentResult.cambio.toFixed(2) + " Bs.", 'success');
                        window.location.reload(); // Recargar la página para limpiar la canasta y actualizar el stock
                    } else {
                        // Si el status es 'error' (aunque response.ok debería haberlo capturado si el servidor envía 4xx/5xx)
                        // Esto es un fallback si el servidor devuelve 200 pero con status: 'error' en el JSON
                        await showBootstrapAlert(data.message, 'error'); // Mostrar mensaje de error
                        boton_pagar.disabled = false; // Re-habilitar botón
                        spinner.style.display = "none"; // Ocultar spinner
                    }

                } catch (error) {
                    // Captura errores de red, errores lanzados por el servidor (stock insuficiente, etc.)
                    await showBootstrapAlert("Error en la operación: " + error.message, 'error');
                    boton_pagar.disabled = false; // Re-habilitar botón
                    spinner.style.display = "none"; // Ocultar spinner
                }
            } else {
                // Si el usuario cancela la confirmación desde la calculadora, NO mostrar modal de cancelación
                // await showBootstrapAlert("Venta cancelada.", 'info');
                boton_pagar.disabled = false;
                spinner.style.display = "none";
            }
        }

        // --- Lógica para agregar/eliminar artículos y refrescar la vista ---

        function agregarArticulo(idProducto, numeroVenta, index) {
            // Verificar si el producto tiene stock antes de agregarlo
            const productoSeleccionado = PRODUCTOS[index];
            if (productoSeleccionado && productoSeleccionado.cantidad_total <= 0) {
                showBootstrapAlert(`El producto "${productoSeleccionado.nombre}" está agotado.`, 'error');
                return; // No agregar el artículo si no hay stock
            }

            for (let i = ARTICULOS.length - 1; i >= 0; i--) {
                if (isNaN(ARTICULOS[i].cantidad)) {
                    ARTICULOS[i].cantidad = 0;
                }
                if (ARTICULOS[i].id == idProducto) {
                    // Verificar stock antes de incrementar la cantidad
                    if (productoSeleccionado && ARTICULOS[i].cantidad >= productoSeleccionado.cantidad_total) {
                        showBootstrapAlert(`No hay más stock disponible para "${productoSeleccionado.nombre}".`, 'error');
                        return; // No incrementar si excede el stock
                    }
                    ARTICULOS[i].cantidad += 1;
                    ARTICULOS[i].numero_venta = numeroVenta;
                    refrescarVistaItems();
                    return;
                };
            }
            var temp = {
                ...PRODUCTOS[index]
            }; // Clonar el objeto para no modificar el original en PRODUCTOS
            temp.cantidad = 1;
            temp.numero_venta = numeroVenta;
            temp.forma_pago_id = 2; // Asegúrate de que este valor sea el correcto o se maneje dinámicamente
            ARTICULOS.push(temp);
            refrescarVistaItems();
        }

        function eliminarArticulo(idProducto, indiceItem) {
            console.log(idProducto);
            console.log(ARTICULOS);
            // Filtrar por ID y por el índice del item en la lista actual (para manejar duplicados si los hubiera)
            // Es más robusto si cada item en ARTICULOS tiene un ID único de canasta o se filtra por id y cantidad
            // Para simplificar, si idProducto es único en la canasta, el filtro por id está bien.
            // Si quieres eliminar por índice de la lista (para múltiples items del mismo producto),
            // necesitarías un enfoque diferente o que cada item en ARTICULOS tenga un ID de canasta único.
            // Por ahora, asumimos que ARTICULOS.filter(unarticulo => unarticulo.id != idProducto) es suficiente.
            ARTICULOS = ARTICULOS.filter(unarticulo => unarticulo.id != idProducto);
            console.log(ARTICULOS);
            refrescarVistaItems();
        }

        function refrescarVistaItems() {
            var compraTotal = 0;
            var cantidadTotal = 0;

            var articuloCanasta = document.getElementById("articulosLista")
            articuloCanasta.innerHTML = ""; // Limpiar la lista antes de volver a renderizar

            for (let i = 0; i < ARTICULOS.length; i++) { // Iterar desde el principio para mantener el orden
                articuloCanasta.innerHTML += agregarArticuloHtml(ARTICULOS[i], i);
                compraTotal += Number(ARTICULOS[i].precio_venta) * Number(ARTICULOS[i].cantidad);
                cantidadTotal += Number(ARTICULOS[i].cantidad);
            }

            document.getElementById("valorTotal").innerHTML = compraTotal.toFixed(2); // Formatear a 2 decimales
            document.getElementById("totalArticulos").innerHTML = cantidadTotal;
        }

        function agregarArticuloHtml(datos, indiceItem) {
            // Asegúrate de que el ID de la lista sea único para cada item si hay múltiples del mismo producto
            // Aquí se usa el indiceItem como ID, lo cual es válido si refrescas toda la lista
            return ` 
                <li id="${indiceItem}" class="d-flex justify-content-between align-items-center">
                    <span class="text-success">${datos.cantidad}</span>
                    ${datos.nombre}
                    <span class="text-danger">${(datos.precio_venta * datos.cantidad).toFixed(2)} Bs</span> 
                    <span class="h-50" onclick="eliminarArticulo(${datos.id}, ${indiceItem})">
                        <button type="button" class="btn btn-danger btn-sm"> - </button>
                    </span>
                </li>
            `;
        }

        function limpiarCanasta() {
            ARTICULOS.length = 0;
            refrescarVistaItems();
        }

        // --- Inicialización al cargar la página ---
        document.addEventListener('DOMContentLoaded', () => {
            refrescarVistaItems(); // Asegura que la canasta se muestre vacía al inicio
        });
    </script>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- Este es el script más importante de Bootstrap, contiene Popper.js y todos los componentes JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS (si ya usas el bundle, esta parte es redundante y puede eliminarse) -->
    <!-- <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        xintegrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        xintegrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script> -->
</body>

</html>