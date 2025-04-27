# Changelog

2025-02-01
v0.6
Se agregó la posibilidad de trabajar con articulos a granel, tambien se agrego la funcion para registrar los productos
que se embolsaron a partir de productos a granel, esto para poder tener control del inventario a granel.
Esta funcion descuenta el producto a granel y agrega la cantidad paquetes embolsados a partir del producto a granel.

    Se hicieron cambios en el menú sidebar para agregar los enlaces hacias las nuevas funcionalidades.
    Tambien se cambio el estilo del menu que era simple a uno que tiene algunos enlaces anidados.

2025-02-02
v0.6.1
Se pusieron en funcionamiento los botones de editar y eliminar productos a granel.
2025-02-03
v0.6.2
Se elimino la opcion para que los usuarios que no sean administradoes puedan agregar ingresos a productos por unidad o a granel.

-- FORMA DE PAGO --
Se agrego una tabla formas_pago a la base de datos, esto para almacenar los diferentes tipos de pago que se puede aceptar, antes de este cambio solo se tenia como pago el Efectivo, ahora se podran aceptar pagos en efectivo, QR, tarjeta y cualquier otro que se necesite, esto se establece en esta nueva tabla. Tambien se agrego el campo forma_pago_id a la tabla ventas para poder almacenar el tipo de pago que se realizó para la venta.
Se agrego el boton de QR en la pagina de ventas, auque veremos la forma de que se pueda agregar los botones de acuerdo a las formas de pago en la tabla formas_de_pago.
