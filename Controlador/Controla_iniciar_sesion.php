<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
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

        .error {
            color: #f44336;
            margin-top: 10px;
        }
    </style>

<?php
include_once '../Modelo/ProveedorBD.php';

// Iniciar la sesión
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try {
        // Verificar la autenticación del usuario
        $proveedor = ProveedorBD::autenticar($usuario,$password);

        if ($proveedor) {
            // Iniciar sesión y almacenar el objeto completo del proveedor
            $_SESSION['usuario'] = $proveedor->getCodigo();
            // Redireccionar a la página de Mostrar todo
            header("Location: ../Vista/formMostrarTodo.php");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            echo "Autenticación fallida. Verifica tus credenciales.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
