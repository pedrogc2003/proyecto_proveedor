<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Producto por Descripción</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        #menu {
            background-color: #4CAF50;
            overflow: hidden;
            text-align: center;
            margin-bottom: 20px;
        }

        #menu form {
            display: inline-block;
            margin: 10px;
        }

        #menu button {
            display: block;
            color: white;
            text-align: center;
            padding: 10px 16px;
            text-decoration: none;
            font-size: 16px;
            border: none;
            cursor: pointer;
            background-color: #45a049;
            transition: background-color 0.4s;
        }

        #menu button:hover {
            background-color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
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
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.4s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
        <form action="../Controlador/Controla_CerrarSesion.php" method="get">
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
    <br>
    <h2>Buscar Producto por Descripción</h2>

    <form action="../Controlador/Controla_BuscaDescripcion.php" method="post">
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required>
        <input type="submit" value="Buscar Producto">
    </form>
</body>
</html>
