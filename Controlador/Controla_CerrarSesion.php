<?php
session_start();

// Cerrar la sesión
session_destroy();

// Redirigir al index u otra página después de cerrar sesión
header("Location: ../Vista/index.php");
exit();
?>
