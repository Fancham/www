<?php 
	//destuction des variables de session
	session_destroy();
	
	$status="<div class=\"reponse\">Vous �tes d�sormais d�connect�.</div>";

	//Retour � la page d identification
	Atomik::setView('Identification');
?>