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

        input[type="number"] {
            width: 100%;
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
include_once '../Modelo/ProductoBD.php';

// Iniciar la sesión
session_start();

try {
    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['usuario'])) {
        // Redirigir al inicio de sesión si no está autenticado
        header("Location: ../Vista/iniciar_sesion.php");
        exit();
    }

    // Obtener el proveedor de la sesión
    $proveedor = $_SESSION['usuario'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $codigo = $_POST['codigo'];
        $descripcion = strtoupper($_POST['descripcion']);
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];

        // Crear un objeto Producto
        $nuevoProducto = new Producto($codigo, $descripcion, $precio, $stock, $proveedor);

        // Llamar a la función add
        if (ProductoBD::add($nuevoProducto, $proveedor)) {
            echo "El producto con código " . $codigo . " ha sido registrado.";
        } else {
            echo "Error al agregar el producto.";
        }
    }
} catch (Exception $e) {
    // Manejo de errores (puedes personalizar el manejo según tus necesidades)
    echo "Error: " . $e->getMessage();
}
?>
