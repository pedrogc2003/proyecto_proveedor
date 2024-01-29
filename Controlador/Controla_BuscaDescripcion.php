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

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
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

try {
    // Obtener el proveedor desde la sesión
    $proveedor = $_SESSION['usuario'];

    // Verificar si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener la descripción desde el formulario
        $descripcion = strtoupper($_POST['descripcion']);

        // Buscar el producto por descripción
        $productoEncontrado = ProductoBD::buscarProductoPorDescripcion($proveedor, $descripcion);

        if ($productoEncontrado) {

            echo "<table border='1'>";
            echo "<tr><th>Código</th><th>Descripción</th><th>Precio</th><th>Stock</th></tr>";
            echo "<tr>";
            echo "<td>" . $productoEncontrado->getCodigo() . "</td>";
            echo "<td>" . $productoEncontrado->getDescripcion() . "</td>";
            echo "<td>" . $productoEncontrado->getPrecio() . "</td>";
            echo "<td>" . $productoEncontrado->getStock() . "</td>";
            echo "</tr>";
            echo "</table>";
        } else {
            echo "<p>No se encontró ningún producto con la descripción proporcionada.</p>";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
