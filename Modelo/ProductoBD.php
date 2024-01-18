<?php

include 'producto.php';

class ProductoBD {
    
    // Insertar un producto nuevo
    public static function add(Producto $producto): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Verificar si el producto ya existe
            if (self::productoExiste($producto->getCodigo(), $producto->getMiProveedor()->getCodigo())) {
                // Producto ya registrado para este proveedor, devolver false
                return false;
            }
    
            // Obtenemos los valores del producto
            $codigo = $producto->getCodigo();
            $descripcion = $producto->getDescripcion();
            $precio = $producto->getPrecio();
            $stock = $producto->getStock();
            $proveedorCodigo = $producto->getMiProveedor()->getCodigo();
    
            // Preparamos la consulta SQL
            $sql = "INSERT INTO producto (codigo, descripcion, precio, stock, proveedor_codigo) VALUES (?, ?, ?, ?, ?)";
    
            $sentencia = $conexion->prepare($sql);
    
            $sentencia->bindParam(1, $codigo, PDO::PARAM_STR);
            $sentencia->bindParam(2, $descripcion, PDO::PARAM_STR);
            $sentencia->bindParam(3, $precio, PDO::PARAM_STR);
            $sentencia->bindParam(4, $stock, PDO::PARAM_INT);
            $sentencia->bindParam(5, $proveedorCodigo, PDO::PARAM_STR);
    
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
    public static function buscarProductoPorDescripcion(Proveedor $proveedor, $descripcion): ?Producto {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Obtenemos el código del proveedor
            $proveedorCodigo = $proveedor->getCodigo();
    
            // Preparamos la consulta SQL
            $sql = "SELECT * FROM producto WHERE proveedor_codigo = :proveedor_codigo AND descripcion = :descripcion";
    
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(['proveedor_codigo' => $proveedorCodigo, 'descripcion' => $descripcion]);
    
            $productoEncontrado = $sentencia->fetch(PDO::FETCH_ASSOC);
    
            if ($productoEncontrado) {
                // Crear un objeto Producto y devolverlo
                $producto = new Producto();
                $producto->setCodigo($productoEncontrado['codigo']);
                $producto->setDescripcion($productoEncontrado['descripcion']);
                $producto->setPrecio($productoEncontrado['precio']);
                $producto->setStock($productoEncontrado['stock']);
                // Puedes cargar el proveedor desde la base de datos o simplemente asignar el código, según tu implementación
                $proveedor = new Proveedor();
                $proveedor->setCodigo($productoEncontrado['proveedor_codigo']);
                $producto->setMiProveedor($proveedor);
    
                return $producto;
            }
    
            return null; // Producto no encontrado
        } catch (PDOException $e) {
            throw new Exception("Error al buscar producto: " . $e->getMessage());
        }
    }

    // Modificar un producto en la base de datos
    public static function modificarProducto(Producto $producto): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Verificar si el producto pertenece al proveedor
            if ($producto->getMiProveedor()->getCodigo() !== self::getProveedorCodigoByProductoCodigo($producto->getCodigo())) {
                // Producto no pertenece al proveedor, no se puede modificar
                return false;
            }
    
            // Obtenemos los valores del producto
            $codigo = $producto->getCodigo();
            $descripcion = $producto->getDescripcion();
            $precio = $producto->getPrecio();
            $stock = $producto->getStock();
    
            // Preparamos la consulta SQL
            $sql = "UPDATE producto SET descripcion = ?, precio = ?, stock = ? WHERE codigo = ?";
    
            $sentencia = $conexion->prepare($sql);
    
            $sentencia->bindParam(1, $descripcion, PDO::PARAM_STR);
            $sentencia->bindParam(2, $precio, PDO::PARAM_STR);
            $sentencia->bindParam(3, $stock, PDO::PARAM_INT);
            $sentencia->bindParam(4, $codigo, PDO::PARAM_STR);
    
            // Ejecutamos la consulta y devolvemos el resultado
            return $sentencia->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al modificar producto: " . $e->getMessage());
        }
    }

    // Borrar un producto de la base de datos
    public static function borrarProducto(Producto $producto): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Verificar si el producto pertenece al proveedor
            if ($producto->getMiProveedor()->getCodigo() !== self::getProveedorCodigoByProductoCodigo($producto->getCodigo())) {
                // Producto no pertenece al proveedor, no se puede borrar
                return false;
            }
    
            // Obtenemos el código del producto
            $codigo = $producto->getCodigo();
    
            // Preparamos la consulta SQL
            $sql = "DELETE FROM producto WHERE codigo = ?";
    
            $sentencia = $conexion->prepare($sql);
    
            $sentencia->bindParam(1, $codigo, PDO::PARAM_STR);
    
            // Ejecutamos la consulta y devolvemos el resultado
            return $sentencia->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al borrar producto: " . $e->getMessage());
        }
    }

    // Mostrar una lista de productos por debajo de un stock específico
    public static function listarProductosBajoStock(Proveedor $proveedor, $stockPedido): array {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Obtenemos el código del proveedor
            $proveedorCodigo = $proveedor->getCodigo();
    
            // Preparamos la consulta SQL
            $sql = "SELECT * FROM producto WHERE proveedor_codigo = :proveedor_codigo AND stock < :stock_pedido";
    
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(['proveedor_codigo' => $proveedorCodigo, 'stock_pedido' => $stockPedido]);
    
            $productos = array();
    
            while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                $producto = new Producto();
                $producto->setCodigo($fila['codigo']);
                $producto->setDescripcion($fila['descripcion']);
                $producto->setPrecio($fila['precio']);
                $producto->setStock($fila['stock']);
                // Puedes cargar el proveedor desde la base de datos o simplemente asignar el código, según tu implementación
                $proveedor = new Proveedor();
                $proveedor->setCodigo($fila['proveedor_codigo']);
                $producto->setMiProveedor($proveedor);
    
                $productos[] = $producto;
            }
    
            return $productos;
        } catch (PDOException $e) {
            throw new Exception("Error al listar productos bajo stock: " . $e->getMessage());
        }
    }

    // Obtener el código del proveedor al que pertenece un producto
    private static function getProveedorCodigoByProductoCodigo($productoCodigo): ?string {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Preparamos la consulta SQL
            $sql = "SELECT proveedor_codigo FROM producto WHERE codigo = ?";
    
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(1, $productoCodigo, PDO::PARAM_STR);
            $sentencia->execute();
    
            $fila = $sentencia->fetch(PDO::FETCH_ASSOC);
    
            return ($fila) ? $fila['proveedor_codigo'] : null;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el código del proveedor: " . $e->getMessage());
        }
    }

    
}

?>
