<?php

include_once 'Proveedor.php';

class ProveedorBD {
    
    // Insertar Proveedor
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
            $sentencia->bindParam(2, $hashedPwd, PDO::PARAM_STR);
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
    public static function proveedorExiste($codigo): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();

            $sql = "SELECT COUNT(*) FROM proveedor WHERE codigo = :codigo";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(['codigo' => $codigo]);

            return $sentencia->fetchColumn() > 0;
        } catch (PDOException $e) {
            // Manejo de errores (puedes personalizar el manejo según tus necesidades)
            throw new Exception("Error al verificar existencia del proveedor: " . $e->getMessage());
        }
    }

    // Mirar si el proveedor está en la base de datos para poder entrar al programa
    public static function autenticar($codigo, $pwd): ?Proveedor {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
            
            $sql = "SELECT * FROM proveedor WHERE codigo = :codigo";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(['codigo' => $codigo]);
            $proveedorEncontrado = $sentencia->fetch();
    
            // Verificar si se encontró un proveedor
            if ($proveedorEncontrado && password_verify($pwd, $proveedorEncontrado['pwd'])) {
                // Devolver un objeto Proveedor
                return new Proveedor($proveedorEncontrado['codigo'], $proveedorEncontrado['pwd'], $proveedorEncontrado['correo'], $proveedorEncontrado['nombre']);
            }
    
            return null; // Proveedor no encontrado o contraseña incorrecta
        } catch (PDOException $e) {
            throw new PDOException("Error al autenticar proveedor: " . $e->getMessage());
        }
    }

    // Actualizar información del proveedor
    public static function update(Proveedor $proveedor): bool {
        try {
            // Establecemos la conexión con la base de datos
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
    
            // Verificar si el proveedor existe antes de intentar actualizar
            if (!self::proveedorExiste($proveedor->getCodigo())) {
                // Proveedor no encontrado, no se puede actualizar
                return false;
            }
    
            // Obtenemos los valores del proveedor
            $codigo = $proveedor->getCodigo();
            $pwd = $proveedor->getPwd();
            $correo = $proveedor->getCorreo();
            $nombre = $proveedor->getNombre();
    
            // Hash de la nueva contraseña si se proporciona
            if ($pwd !== null) {
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            }
    
            // Preparamos la consulta SQL
            $sql = "UPDATE proveedor SET correo = ?, nombre = ?";
            $parametros = [$correo, $nombre];
    
            // Agregamos la actualización de la contraseña si se proporciona
            if (isset($hashedPwd)) {
                $sql .= ", pwd = ?";
                $parametros[] = $hashedPwd;
            }
    
            $sql .= " WHERE codigo = ?";
            $parametros[] = $codigo;
    
            $sentencia = $conexion->prepare($sql);
    
            // Bind de parámetros
            foreach ($parametros as $i => $parametro) {
                $sentencia->bindValue($i + 1, $parametro, (is_int($parametro) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
    
            // Ejecutamos la consulta y devolvemos el resultado
            return $sentencia->execute();
        } catch (PDOException $e) {
            // Manejo de errores (puedes personalizar el manejo según tus necesidades)
            throw new PDOException("Error al actualizar proveedor: " . $e->getMessage());
        }
    }
}

?>
