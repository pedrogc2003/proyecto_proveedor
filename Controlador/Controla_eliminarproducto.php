<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        #menu {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
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

        #content {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .success {
            color: #4CAF50;
        }

        .error {
            color: #f44336;
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
include_once '../Modelo/ProductoBD.php';

// Iniciar la sesión
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener el código del producto a borrar
        $codigoProducto = $_POST['codigoProducto'];

        // Obtener el código del proveedor desde la sesión
        $codigoProveedor = $_SESSION['usuario'];

        // Crear un objeto Producto con el código
        $producto = new Producto($codigoProducto, '', 0, 0, '');

        // Llamar a la función borrarProducto
        if (ProductoBD::borrarProducto($producto, $codigoProveedor)) {
            echo "Producto borrado correctamente.";
        } else {
            echo "Error al borrar el producto.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
