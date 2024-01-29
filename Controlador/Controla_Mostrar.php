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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }
    </style>

<?php
include_once '../Modelo/ProductoBD.php';
include_once '../Modelo/ProveedorBD.php';

try {
    // Verificar si el proveedor ha iniciado sesión
    if (isset($_SESSION['usuario'])) {
        $codigoProveedor = $_SESSION['usuario'];
        // Obtener la lista de productos del proveedor
        $productos = ProductoBD::getProductosPorProveedor($codigoProveedor);

        // Mostrar la lista de productos en tabla
        mostrarProductosEnTabla($productos);
    } else {
        mostrarMensaje("Proveedor no autenticado.");
    }
} catch (Exception $e) {
    mostrarMensaje("Error: " . $e->getMessage());
}

// Función para mostrar la lista de productos en tabla
function mostrarProductosEnTabla($productos) {
    if (!empty($productos)) {
        echo "<table border='1'>";
        echo "<tr><th>Código</th><th>Descripción</th><th>Precio</th><th>Stock</th></tr>";
        foreach ($productos as $producto) {
            echo "<tr>";
            echo "<td>" . $producto->getCodigo() . "</td>";
            echo "<td>" . $producto->getDescripcion() . "</td>";
            echo "<td>" . $producto->getPrecio() . "</td>";
            echo "<td>" . $producto->getStock() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        mostrarMensaje("El proveedor no tiene productos registrados.");
    }
}

// Función para mostrar mensajes
function mostrarMensaje($mensaje) {
    echo $mensaje;
}
?>
