<?php 

	//destruction des variables de session
	unset($_SESSION['NomPrenom']);
	
	//destuction de la session
	session_destroy();
	
	$status="<div class=\"reponse\">Vous êtes désormais déconnecté.</div>";

	//Retour à la page d identification
	Atomik::setView('Identification');
?>