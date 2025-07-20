<?= view('dashboard/templates/footer') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // **CORRECCIÓN: Generamos las URLs completas con el helper site_url()**
        const reloadUrl = '<?= site_url('dashboard/conteo-inventario/ajaxObtenerTabla') ?>';
        const saveUrl = '<?= site_url('dashboard/conteo-inventario/guardarConteoTemporal') ?>';
        const deleteUrl = '<?= site_url('dashboard/conteo-inventario/eliminarConteoTemporal') ?>';

        const loader = $('#loader-overlay');
        const tablaBody = $('#tabla-conteo-body');

        /**
         * Función para recargar la tabla usando POST para más seguridad.
         */
        function reloadTable() {
            $.ajax({
                url: reloadUrl, // **CORRECCIÓN: Usamos la variable con la URL completa**
                type: 'POST',
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.html) {
                        tablaBody.html(response.html);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error al recargar la tabla:", textStatus, errorThrown);
                    alert('Error al recargar la lista de productos. Por favor, revise la consola del navegador para más detalles.');
                },
                complete: function() {
                    loader.hide();
                }
            });
        }

        // Usamos delegación de eventos para que funcionen en el contenido recargado
        tablaBody.on('change', '.confirmar-conteo', function() {
            const checkbox = $(this);
            const productoId = checkbox.data('id');
            const inputConteo = $(`.conteo-fisico[data-id="${productoId}"]`);
            const cantidad = inputConteo.val();

            let url = '';
            const isChecking = checkbox.is(':checked');

            if (isChecking) {
                if (cantidad === '' || isNaN(parseFloat(cantidad))) {
                    alert('Por favor, ingresa una cantidad válida antes de confirmar.');
                    checkbox.prop('checked', false);
                    return;
                }
                inputConteo.prop('readonly', true);
                url = saveUrl; // **CORRECCIÓN: Usamos la variable**
            } else {
                inputConteo.prop('readonly', false);
                url = deleteUrl; // **CORRECCIÓN: Usamos la variable**
            }

            loader.show();

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    producto_id: productoId,
                    cantidad: cantidad,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function(response) {
                    reloadTable();
                },
                error: function() {
                    alert('Error al guardar el conteo. No se pudo comunicar con el servidor.');
                    if (isChecking) {
                        checkbox.prop('checked', false);
                        inputConteo.prop('readonly', false);
                    } else {
                        checkbox.prop('checked', true);
                        inputConteo.prop('readonly', true);
                    }
                    loader.hide();
                }
            });
        });

        $('#finalizarBtn').on('click', function(e) {
            e.preventDefault();
            if (confirm('¿Estás seguro de que deseas finalizar el ajuste?')) {
                $('#loader-overlay p').text('Finalizando ajuste, por favor espera...');
                loader.show();
                window.location.href = $(this).attr('href');
            }
        });
    });
</script>