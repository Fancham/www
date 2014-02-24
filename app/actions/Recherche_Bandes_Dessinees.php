<?php 
	if (!isset($_SESSION['NomPrenom']) or empty($_SESSION['NomPrenom']))
	{
		$status="<div class=\"reponse_cnx_ko\"> L'accès à cette page vous est interdit pour l'instant. </div>";
		Atomik::setView('Identification');
		exit;
	}
	
	if (isset($_POST['ListeGenreBD']) or isset($_POST['ListeType']) or isset($_POST['ListeLecteur']))
	{
		if (!empty($_POST['ListeGenreBD']))
		{
			$_SESSION['genre']=$_POST['ListeGenreBD'];
			$genre=$_POST['ListeGenreBD'];
		}
		if (!empty($_POST['ListeType']))
		{
			$_SESSION['type']=$_POST['ListeType'];
			$type=$_POST['ListeType'];
		}
		if (!empty($_POST['ListeLecteur']))
		{
			$_SESSION['lecteur']=$_POST['ListeLecteur'];
			$lecteur=$_POST['ListeLecteur'];
		}
		$debut=$_SESSION['debutBD'];
		$limite=$_SESSION['limiteBD'];

		if (($genre=='Tout' or empty($genre)) and empty($type) and empty($lecteur))
		{
			$Resultat=ListeBDRechercheToutLimite($debut,$limite);
		}
		else
		{
			$Resultat=ListeBDRechercheLimite($genre,$type,$lecteur,$debut,$limite);
		}
		$_SESSION['page_demande']='BD';
		include_once($_SESSION['pathRacine'].'index.php');
	}
	
	Atomik::needed('DAL/Identification');
	Atomik::needed('BL/Identification');
	Atomik::needed('BL/Recherche');
	
	$DAL_Identification=new DAL_Identification();
	$BL_Identification=new BL_Identification();
	$BL_Recherche=new BL_Recherche();
?>