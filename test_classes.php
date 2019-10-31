<?php
try {
	define('_DEBUG_',1);

	//Les fonctions communes
	require_once 'include/functions.php';

	//Autoload charg? AVANT la session pour cr?er les objets stock?s en session
	require_once 'include/autoload.php';

	// On demarre la session
	session_start();


	require_once 'include/DBConnexion.php';

	echo "<hr>";
	echo "<h1>TEST CLASSE Assure</h1>";

	$managerAssure = new ManagerAssure;
	$managerAssure->setDb($db);
	$managerAssure->addAssuranceEmploye(1,2);

} catch (Exception $e) {
	debug($e->getMessage(),true);
}