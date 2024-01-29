<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #menu {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
        }

        #menu form {
            display: inline-block;
            margin: 0 10px;
        }

        #menu button {
            background-color: #555;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            transition: background-color 0.4s;
        }

        #menu button:hover {
            background-color: #777;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.4s;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>

<div id="menu">
    <form action="../Vista/iniciar_sesion.php" method="get">
        <button type="submit">Iniciar Sesión</button>
    </form>
</div>
<br>

<?php
// Incluir el modelo de Usuario y la función add
include_once '../Modelo/ProveedorBD.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario y convertir a minúsculas
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        // Verificar que los campos obligatorios no estén vacíos
        if (empty($nombre) || empty($codigo) || empty($password) || empty($email)) {
            echo "Todos los campos son obligatorios.";
            exit;
        }

        // Crear un objeto Usuario
        $nuevoUsuario = new Proveedor($codigo, $password, $email, $nombre);

        // Llamar a la función add
        if (ProveedorBD::add($nuevoUsuario)) {
            echo "El usuario: " . $nombre . " ha sido registrado con la contraseña: " . $password;
        } else {
            echo "Error al agregar el usuario.";
        }
    }
} catch (Exception $e) {
    // Manejo de errores (puedes personalizar el manejo según tus necesidades)
    echo "Error: " . $e->getMessage();
}
?>
