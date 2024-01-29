<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesión / Registro</title>
    <script>
        function redireccionar() {
            var seleccion = document.getElementById("opcion").value;

            if (seleccion === "iniciarSesion") {
                // Redirigir a la página de inicio de sesión
                window.location.href = "iniciar_sesion.php";
            } else if (seleccion === "registrarse") {
                // Redirigir a la página de registro
                window.location.href = "formAgregarUsuario.php";
            }
        }
    </script>
    <style>
        <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #fce4ec; /* Color de fondo rosa claro */
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        item-alaign
    }

    h2 {
        color: #e91e63; /* Color de texto rosa */
        text-align: center;
    }

    form {
        max-width: 400px;
        margin: 20px;
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
        color: #e91e63; /* Color de texto rosa */
    }

    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #e91e63; /* Borde rosa */
        border-radius: 4px;
        box-sizing: border-box;
        background-color: #fff; /* Fondo blanco */
    }

    button {
        background-color: #e91e63; /* Rosa */
        color: white;
        padding: 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.4s;
    }

    button:hover {
        background-color: #c2185b; /* Rosa más oscuro al pasar el ratón */
    }
</style>

    </style>
</head>
<body>
<?php session_start(); ?>
    <h2>Selecciona una opción</h2>

    <form>
        <label for="opcion">Elige una opción:</label>
        <select id="opcion" name="opcion">
            <option value="iniciarSesion">Iniciar Sesión</option>
            <option value="registrarse">Registrarse</option>
        </select>

        <br>

        <button type="button" onclick="redireccionar()">Continuar</button>
    </form>

</body>
</html>
