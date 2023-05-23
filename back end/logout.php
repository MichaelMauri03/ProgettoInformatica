<?php
session_start();
session_destroy();

// Reindirizza alla pagina di login
header("Location: login.php");
exit();
?>
