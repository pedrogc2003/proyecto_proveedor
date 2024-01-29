<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f8f8; /* Color de fondo alegre */
    margin: 0;
    padding: 0;
}

#menu {
    background-color: #4CAF50; /* Color de fondo para el menú */
    overflow: hidden;
}

#menu form {
    float: left;
}

#menu button {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 16px;
    border: none;
    cursor: pointer;
    background-color: #45a049; /* Color de fondo para los botones */
    transition: background-color 0.4s; /* Transición al pasar el ratón */
}

#menu button:hover {
    background-color: #333; /* Nuevo color al pasar el ratón */
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
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50; /* Color de fondo para el botón de enviar */
    color: white;
    padding: 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.4s; /* Transición al pasar el ratón */
}

input[type="submit"]:hover {
    background-color: #45a049; /* Nuevo color al pasar el ratón */
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
    <h2>Modificar Producto</h2>
    <form action="../Controlador/Controla_ModificarProducto.php" method="post">
        <label for="codigo">Código del Producto:</label>
        <input type="text" id="codigo" name="codigo">
        <br>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required>
        <br>

        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" required>
        <br>

        <label for="stock">Stock:</label>
        <input type="text" id="stock" name="stock" required>
        <br>

        <input type="submit" value="Modificar Producto">
    </form>
    <br>
    <div id="content">
        <?php include '../Controlador/Controla_Mostrar.php'; ?>
    </div>
</body>
</html>
