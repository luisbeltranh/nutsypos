<?= view('dashboard/templates/footer') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const baseURL = '<?= site_url() ?>';
        const loader = $('#loader-overlay');

        $('.confirmar-conteo').on('change', function() {
            const checkbox = $(this);
            const productoId = checkbox.data('id');
            const inputConteo = $(`.conteo-fisico[data-id="${productoId}"]`);
            const cantidad = inputConteo.val();

            if (checkbox.is(':checked')) {
                if (cantidad === '' || isNaN(parseFloat(cantidad))) {
                    alert('Por favor, ingresa una cantidad válida.');
                    checkbox.prop('checked', false);
                    return;
                }
                inputConteo.prop('readonly', true);
                loader.show();
                $.ajax({
                    url: `${baseURL}dashboard/conteo-inventario-granel/guardarConteoTemporal`,
                    type: 'POST',
                    data: {
                        producto_id: productoId,
                        cantidad: cantidad,
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                    },
                    complete: function() {
                        loader.hide();
                    }
                });
            } else {
                inputConteo.prop('readonly', false);
                loader.show();
                $.ajax({
                    url: `${baseURL}dashboard/conteo-inventario-granel/eliminarConteoTemporal`,
                    type: 'POST',
                    data: {
                        producto_id: productoId,
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                    },
                    complete: function() {
                        loader.hide();
                    }
                });
            }
        });

        $('#finalizarBtn').on('click', function(e) {
            e.preventDefault();
            if (confirm('¿Estás seguro de que deseas finalizar el ajuste?')) {
                $('#loader-overlay p').text('Finalizando ajuste...');
                loader.show();
                window.location.href = $(this).attr('href');
            }
        });
    });
</script>