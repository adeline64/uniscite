<?php

spl_autoload_register(function ($className) {
	$dirClass = 'code/php/class/'.$className.'.class.php';
	if(file_exists($dirClass)){
		require_once $dirClass;
	}else{
		echo 'Fichier '.$dirClass.' Introuvable';
	}
});
