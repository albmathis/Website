<?php
    session_start(); // Inicia una sesión PHP para el usuario actual.

    session_unset(); // Elimina todas las variables de sesión actualmente registradas.

    session_destroy(); // Destruye la sesión actualmente activa.
    
    header('Location: /mathis_albert_website'); // Redirige al usuario a la página principal del sitio web ubicada en /mathis_albert_website.
?>
