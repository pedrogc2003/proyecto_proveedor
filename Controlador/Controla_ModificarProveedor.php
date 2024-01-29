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
            display: flex;
            justify-content: space-around;
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

        h2 {
            color: #333;
            text-align: center;
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
            background-color: #007bff;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.4s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

<div id="menu">
        <form action="../Vista/formInsertarProducto.php" method="get">
            <button type="submit">Insertar Producto</button>
        </form>
        <form action="../Vista/formEliminarProducto.php" method="get">
            <button type="submit">Eliminar Producto</button>
        </form>
        <form action="../Vista/formMostrarTodo.php" method="get">
            <button type="submit">Mostrar Productos</button>
        </form>
        <form action="../Vista/formListarBajoStock.php" method="get">
            <button type="submit">Mostrar Stock</button>
        </form>
        <form action="../Vista/formBuscarDescrp.php" method="get">
            <button type="submit">Buscar Descripcion</button>
        </form>
        <form action="../Vista/formActualizarProducto.php" method="get">
            <button type="submit">Actualizar Productos</button>
        </form>
        <form action="../Vista/formActualizarProveedor.php" method="get">
            <button type="submit">Actualizar Proveedor</button>
        </form>
        <form action="../Controlador/Controla_CerrarSesion.php" method="get">
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
    <br>

<?php
include_once '../Modelo/Proveedor.php'; // Asegúrate de tener la ruta correcta
include_once '../Modelo/ProveedorBD.php'; // Asegúrate de tener la ruta correcta

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera los datos del formulario
    $codigoProveedor = $_SESSION['usuario'];
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    // Crea una instancia de Proveedor con los datos del formulario
    $proveedor = new Proveedor($codigoProveedor, $contrasena, $correo, $nombre);

    try {
        // Intenta actualizar el proveedor en la base de datos
        if (ProveedorBD::update($proveedor)) {
            echo "Proveedor actualizado correctamente.";
        } else {
            echo "Error al actualizar el proveedor. El proveedor no existe.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
