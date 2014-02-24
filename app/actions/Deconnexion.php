<?php 
	//destuction des variables de session
	session_destroy();
	
	$status="<div class=\"reponse\">Vous êtes désormais déconnecté.</div>";

	//Retour à la page d identification
	Atomik::setView('Identification');
?>