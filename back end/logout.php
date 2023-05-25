<?php
session_start();
session_destroy();

// Reindirizza alla pagina di login
header("Location: ../front end/login.html");
exit();
?>
