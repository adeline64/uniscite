<?php
$_SESSION = array(); // REVIEW: on ouvre la session
session_destroy(); // REVIEW: on d�truit toute la session
header('Location: index.php'); // REVIEW: redirection
?>