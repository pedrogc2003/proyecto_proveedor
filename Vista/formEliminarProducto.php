<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Producto</title>
    <script>
        function confirmarEliminacion() {
            // Preguntar al usuario si está seguro de eliminar el producto
            var confirmacion = confirm("¿Estás seguro de eliminar este producto?");
            // Devolver true o false según la confirmación del usuario
            return confirmacion;
        }
    </script>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
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
    <h2>Borrar Producto</h2>
    <!-- Agregar el evento onsubmit para llamar a la función de confirmación -->
    <form action="../Controlador/Controla_eliminarproducto.php" method="post" onsubmit="return confirmarEliminacion()">
        <label for="codigoProducto">Código del Producto:</label>
        <input type="text" id="codigoProducto" name="codigoProducto" required>
        <br>
        <input type="submit" value="Borrar Producto">
    </form>

    <div id="content">
        <?php include '../Controlador/Controla_Mostrar.php'; ?>
    </div>
</body>
</html>
