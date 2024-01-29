<?php

include 'Producto.php';
include_once 'Proveedor.php';
include_once 'ProveedorBD.php';

class ProductoBD {
    
    // Insertar un producto nuevo
    public static function add(Producto $producto,$proveedor): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();

            // Verificar si el producto ya existe para este proveedor
            if (self::productoExiste($producto->getCodigo())) {
                // Producto ya registrado para este proveedor, devolver false
                return false;
            }

            // Obtenemos los valores del producto
            $codigo = $producto->getCodigo();
            $descripcion = $producto->getDescripcion();
            $precio = $producto->getPrecio();
            $stock = $producto->getStock();

            // Preparamos la consulta SQL
            $sql = "INSERT INTO producto (codigo, descripcion, precio, stock, codigo_prov) VALUES (?, ?, ?, ?, ?)";

            $sentencia = $conexion->prepare($sql);

            $sentencia->bindParam(1, $codigo, PDO::PARAM_STR);
            $sentencia->bindParam(2, $descripcion, PDO::PARAM_STR);
            $sentencia->bindParam(3, $precio, PDO::PARAM_STR);
            $sentencia->bindParam(4, $stock, PDO::PARAM_INT);
            $sentencia->bindParam(5, $proveedor, PDO::PARAM_STR);

            // Ejecutamos la consulta y devolvemos el resultado
            return $sentencia->execute();
        } catch (PDOException $e) {
            // Manejo de errores (puedes personalizar el manejo según tus necesidades)
            throw new Exception("Error al agregar producto: " . $e->getMessage());
        }
    }

    // Función para verificar si un producto ya existe
    private static function productoExiste($codigo): bool {
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();
    
        $sql = "SELECT COUNT(*) FROM producto WHERE codigo = :codigo";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute(['codigo' => $codigo]);
    
        return $sentencia->fetchColumn() > 0;
    }
    
    // Buscar un producto por su descripción (para el proveedor actual)
    public static function buscarProductoPorDescripcion($proveedor, $descripcion): ?Producto {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Preparamos la consulta SQL
            $sql = "SELECT * FROM producto WHERE codigo_prov = :codigo_prov AND descripcion = :descripcion";
    
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(['codigo_prov' => $proveedor, 'descripcion' => $descripcion]);
    
            $productoEncontrado = $sentencia->fetch(PDO::FETCH_ASSOC);
    
            if ($productoEncontrado) {
                // Crear un objeto Producto y devolverlo
                $producto = new Producto(
                    $productoEncontrado['codigo'],
                    $productoEncontrado['descripcion'],
                    $productoEncontrado['precio'],
                    $productoEncontrado['stock'],
                    $proveedor // Pasar la instancia de Proveedor directamente
                );
    
                return $producto;
            }
    
            return null; // Producto no encontrado
        } catch (PDOException $e) {
            throw new Exception("Error al buscar producto: " . $e->getMessage());
        }
    }

    // Modificar un producto en la base de datos
    public static function modificarProducto(Producto $producto, $proveedor): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();

            // Obtenemos los valores del producto
            $codigo = $producto->getCodigo();
            $descripcion = $producto->getDescripcion();
            $precio = $producto->getPrecio();
            $stock = $producto->getStock();

            // Preparamos la consulta SQL
            $sql = "UPDATE producto SET descripcion = ?, precio = ?, stock = ? WHERE codigo = ? AND codigo_prov = ?";

            $sentencia = $conexion->prepare($sql);

            $sentencia->bindParam(1, $descripcion, PDO::PARAM_STR);
            $sentencia->bindParam(2, $precio, PDO::PARAM_STR);
            $sentencia->bindParam(3, $stock, PDO::PARAM_INT);
            $sentencia->bindParam(4, $codigo, PDO::PARAM_STR);
            $sentencia->bindParam(5, $proveedor, PDO::PARAM_STR);


            // Ejecutamos la consulta y devolvemos el resultado
            return $sentencia->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al modificar producto: " . $e->getMessage());
        }
    }

    public static function borrarProducto(Producto $producto, $proveedor): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Obtenemos el código del producto
            $codigo = $producto->getCodigo();
    
            // Preparamos la consulta SQL
            $sql = "DELETE FROM producto WHERE codigo = :codigo AND codigo_prov = :codigo_prov";
    
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(':codigo', $codigo, PDO::PARAM_STR);
            $sentencia->bindParam(':codigo_prov', $proveedor, PDO::PARAM_STR);
    
            // Ejecutamos la consulta y devolvemos el resultado
            $resultado = $sentencia->execute();
    
            // Cerramos la conexión
            $conexion = null;
    
            return $resultado;
        } catch (PDOException $e) {
            // Manejo de errores (puedes personalizar el manejo según tus necesidades)
            throw new Exception("Error al borrar producto: " . $e->getMessage());
        }
    }
    

    // Mostrar una lista de productos por debajo de un stock específico
    public static function listarProductosBajoStock($proveedor, $stockPedido): array {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Preparamos la consulta SQL
            $sql = "SELECT * FROM producto WHERE codigo_prov = :codigo_prov AND stock <= :stock_pedido";
    
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(['codigo_prov' => $proveedor, 'stock_pedido' => $stockPedido]);
    
            $productos = array();
    
            while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                // Crear un objeto Producto y agregarlo al array
                $producto = new Producto(
                    $fila['codigo'],
                    $fila['descripcion'],
                    $fila['precio'],
                    $fila['stock'],
                    $proveedor // Pasar la instancia de Proveedor directamente
                );
    
                $productos[] = $producto;
            }
    
            return $productos;
        } catch (PDOException $e) {
            throw new Exception("Error al listar productos bajo stock: " . $e->getMessage());
        }
    }

    public static function getProductosPorProveedor($proveedor): array {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Preparamos la consulta SQL
            $sql = "SELECT * FROM producto WHERE codigo_prov = :codigo_prov";
    
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(':codigo_prov', $proveedor);
            $sentencia->execute();
    
            $productos = array();
    
            while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                // Crear un objeto Producto y agregarlo al array
                $producto = new Producto(
                    $fila['codigo'],
                    $fila['descripcion'],
                    $fila['precio'],
                    $fila['stock'],
                    $proveedor // Pasar el código del proveedor directamente
                );
    
                $productos[] = $producto;
            }
    
            return $productos;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener productos por proveedor: " . $e->getMessage());
        }
    }    
}   

?>
