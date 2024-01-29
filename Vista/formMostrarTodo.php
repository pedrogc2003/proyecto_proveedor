<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos del Proveedor</title>
    <style>
        <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #eaf7f7; /* Color de fondo celeste */
        margin: 0;
        padding: 0;
    }

    #menu {
        background-color: #009688; /* Verde oscuro */
        color: white;
        text-align: center;
        padding: 10px;
    }

    #menu form {
        display: inline-block;
        margin: 0 10px;
    }

    #menu button {
        background-color: #00796b; /* Verde más oscuro */
        color: white;
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        transition: background-color 0.4s;
    }

    #menu button:hover {
        background-color: #004d40; /* Verde más claro */
    }

    #header {
        background-color: #ff9800; /* Naranja */
        text-align: center;
        padding: 20px;
    }

    h1 {
        color: white;
        margin: 0;
    }

    #content {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>

    </style>
</head>
<body>
    <?php session_start(); ?>
    <div id="menu">
        <form action="formInsertarProducto.php" method="get">
            <button type="submit">Insertar Producto</button>
        </form>
        <form action="formEliminarProducto.php" method="get">
            <button type="submit">Eliminar Producto</button>
        </form>
        <form action="formMostrarTodo.php" method="get">
            <button type="submit">Mostrar Productos</button>
        </form>
        <form action="formListarBajoStock.php" method="get">
            <button type="submit">Mostrar Stock</button>
        </form>
        <form action="formBuscarDescrp.php" method="get">
            <button type="submit">Buscar Descripcion</button>
        </form>
        <form action="formActualizarProducto.php" method="get">
            <button type="submit">Actualizar Productos</button>
        </form>
        <form action="formActualizarProveedor.php" method="get">
            <button type="submit">Actualizar Proveedor</button>
        </form>
        <form action="../Controlador/Controla_CerrarSesion.php" method="get">
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
    <br>
<div id="header">
    <h1>Bienvenido Proveedor</h1>
</div>

<div id="content">
    <?php include '../Controlador/Controla_MostrarTodo.php'; ?>
</div>

</body>
</html>
