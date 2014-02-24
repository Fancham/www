<?php
if (!isset($_SESSION['NomPrenom']) or empty($_SESSION['NomPrenom']))
{
	$status="<div class=\"reponse_cnx_ko\"> L'accès à cette page vous est interdit pour l'instant. </div>";
	Atomik::setView('Identification');
	exit;
}

Atomik::needed('DAL/Identification');
Atomik::needed('BL/Identification');
Atomik::needed('BL/Recherche');

$DAL_Recherche=new DAL_Recherche();
$BL_Identification=new BL_Identification();
$BL_Recherche=new BL_Recherche();

$limite=22;

if (isset($_POST['ListeGenreBD']) or isset($_POST['ListeType']) or isset($_POST['ListeLecteur']))
{
	if (!empty($_POST['ListeGenreBD']))
	{
		$genre=$_POST['ListeGenreBD'];
	}
	if (!empty($_POST['ListeType']))
	{
		$type=$_POST['ListeType'];
	}
	if (!empty($_POST['ListeLecteur']))
	{
		$lecteur=$_POST['ListeLecteur'];
	}
	$debut=$debutBD;

	if (($genre=='Tout' or empty($genre)) and empty($type) and empty($lecteur))
	{
		$Resultat=$DAL_Recherche->ListeBDRechercheToutLimite($debut,$limite);
	}
	else
	{
		$Resultat=$DAL_Recherche->ListeBDRechercheLimite($genre,$type,$lecteur,$debut,$limite);
	}
}

$ReponseBD=$DAL_Recherche->AffichageListeGenreBD();
$ReponseLecteur=$DAL_Recherche->AffichageListeLecteurBD();
$ReponseType=$DAL_Recherche->AffichageListeTypeBD();

Atomik::setView('Collection_BD');

?>