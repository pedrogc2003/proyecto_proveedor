<?php

include 'proveedor.php';

class ProveedorBD {
    
    //Insertar Proveedor
    public static function add(Proveedor $proveedor): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Verificar si el proveedor ya existe
            if (self::proveedorExiste($proveedor->getCodigo())) {
                // Proveedor ya registrado, devolver false
                return false;
            }
    
            // Obtenemos los valores del proveedor
            $codigo = $proveedor->getCodigo();
            $pwd = $proveedor->getPwd();
            $correo = $proveedor->getCorreo();
            $nombre = $proveedor->getNombre();
    
            // Hash de la contraseña
             $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
            // Preparamos la consulta SQL
            $sql = "INSERT INTO proveedor (codigo, pwd, correo, nombre) VALUES (?, ?, ?, ?)";
    
            $sentencia = $conexion->prepare($sql);
    
            $sentencia->bindParam(1, $codigo, PDO::PARAM_STR);
            $sentencia->bindParam(2, $pwd, PDO::PARAM_STR);
            $sentencia->bindParam(3, $correo, PDO::PARAM_STR);
            $sentencia->bindParam(4, $nombre, PDO::PARAM_STR);
    
            // Ejecutamos la consulta y devolvemos el resultado
            return $sentencia->execute();
        } catch (PDOException $e) {
            // Manejo de errores (puedes personalizar el manejo según tus necesidades)
            throw new Exception("Error al agregar proveedor: " . $e->getMessage());
        }
    }
    
    // Función para verificar si un proveedor ya existe
    private static function proveedorExiste($codigo): bool {
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();
    
        $sql = "SELECT COUNT(*) FROM proveedor WHERE codigo = :codigo";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute(['codigo' => $codigo]);
    
        return $sentencia->fetchColumn() > 0;
    }

    //Mirar si el proveedor esta en la base de datos para poder entrar al programa
    public static function autenticar($codigo, $pwd): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
            
            $sql = "SELECT * FROM proveedor WHERE codigo = :codigo";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(['codigo' => $codigo]);
            $proveedorEncontrado = $sentencia->fetch();
    
            // Verificar si se encontró un proveedor
            if ($proveedorEncontrado) {
                // Verificar la contraseña (puedes ajustar esta lógica según tus necesidades)
                return $pwd == $proveedorEncontrado['pwd'];
            }
    
            return false; // Proveedor no encontrado
        } catch (PDOException $e) {
            throw new Exception("Error al autenticar proveedor: " . $e->getMessage());
        }
    }
    
}

?>
