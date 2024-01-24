<?php

include_once '../Conexion/conexion.php';
include_once 'ProveedorBD.php';
include_once 'ProductoBD.php';

class PruebaBD {
    
    public static function probarFunciones() {
        try {
            // Crear un proveedor
            $proveedor = new Proveedor("P001", "contrasena", "proveedor@example.com", "Proveedor Ejemplo");
            ProveedorBD::add($proveedor);

            // Autenticar al proveedor
            if (ProveedorBD::autenticar("P001", "contrasena")) {
                echo "Proveedor autenticado correctamente.\n";
            } else {
                echo "Error de autenticación del proveedor.\n";
            }

            // Modificar datos del proveedor
            $proveedor->setCorreo("nuevo_correo@example.com");
            $proveedor->setNombre("Nuevo Nombre");
            ProveedorBD::update($proveedor);

            // Crear un producto asociado al proveedor
            $producto = new Producto("PR001", "Producto Ejemplo", 50.0, 100, $proveedor);
            ProductoBD::add($producto, $proveedor);

            // Buscar un producto por descripción
            $productoEncontrado = ProductoBD::buscarProductoPorDescripcion($proveedor, "Producto Ejemplo");
            if ($productoEncontrado) {
                echo "Producto encontrado: " . $productoEncontrado->getDescripcion() . "\n";
            } else {
                echo "Producto no encontrado.\n";
            }

            // Modificar el producto
            $producto->setPrecio(60.0);
            ProductoBD::modificarProducto($producto);

            // Mostrar todos los productos del proveedor
            $productosProveedor = ProductoBD::getProductosPorProveedor($proveedor);
            echo "Productos del proveedor:\n";
            foreach ($productosProveedor as $productoProveedor) {
                echo $productoProveedor->getDescripcion() . "\n";
            }

            // Eliminar el producto
            ProductoBD::borrarProducto($producto);

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}

// Ejecutar las pruebas
PruebaBD::probarFunciones();

?>
