<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para Agregar Usuario</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8; /* Color de fondo */
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333; /* Color del título */
            text-align: center;
        }

        #menu {
            background-color: #4CAF50; /* Color de fondo para el menú */
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
            background-color: #45a049; /* Color de fondo para los botones */
            transition: background-color 0.4s; /* Transición al pasar el ratón */
        }

        #menu button:hover {
            background-color: #333; /* Nuevo color al pasar el ratón */
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff; /* Color de fondo para el formulario */
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333; /* Color del texto del label */
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
    <h2>Formulario para Agregar Usuario</h2>
    <div id="menu">
        <form action="iniciar_sesion.php" method="get">
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <form action="../Controlador/ControlaAgregarUsuario.php" method="post">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <input type="submit" value="Insertar">
    </form>

</body>
</html>
