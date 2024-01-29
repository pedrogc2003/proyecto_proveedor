<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Productos Bajo Stock</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #fce4ec; /* Rosa suave */
        margin: 0;
        padding: 0;
    }

    #menu {
        background-color: #4CAF50; /* Verde */
        color: white;
        text-align: center;
        padding: 10px;
    }

    #menu form {
        display: inline-block;
        margin: 0 10px;
    }

    #menu button {
        background-color: #219653; /* Verde más oscuro */
        color: white;
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        transition: background-color 0.4s;
    }

    #menu button:hover {
        background-color: #4CAF50; /* Verde */
    }

    h2 {
        color: #4CAF50; /* Verde */
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
        color: #4CAF50; /* Verde */
    }

    input {
        width: calc(100% - 20px);
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #4CAF50; /* Verde */
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="number"] {
        width: 100%;
    }

    input[type="submit"] {
        background-color: #ff4081; /* Rosa oscuro */
        color: white;
        padding: 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.4s;
    }

    input[type="submit"]:hover {
        background-color: #ff80ab; /* Rosa más claro */
    }
</style>

</head>
<body>
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
        <form action="Controla_CerrarSesion.php" method="get">
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
    <br>
    <h2>Productos Bajo Stock</h2>

    <form action="../Controlador/Controla_ListarBajoStock.php" method="post">
        <label for="stock_pedido">Stock Deseado:</label>
        <input type="number" id="stock_pedido" name="stock_pedido" required>
        <input type="submit" value="Listar Productos Bajo Stock">
    </form>


</body>
</html>
