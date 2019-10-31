<?php
$_SESSION = array(); // REVIEW: on ouvre la session
session_destroy(); // REVIEW: on détruit toute la session
header('Location: index.php'); // REVIEW: redirection
?>