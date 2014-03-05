<?php
if (!isset($_SESSION['NomPrenom']) or empty($_SESSION['NomPrenom']))
{
	$status="<div class=\"reponse_cnx_ko\"> L'acc�s � cette page vous est interdit pour l'instant. </div>";
	Atomik::setView('Identification');
	exit;
}

Atomik::needed('DAL/CollectionBD');
Atomik::needed('BL/Pagination');

$DAL_Collection_BD=new DAL_Collection_BD();

if (isset($_POST['ListeGenreBD']) or isset($_POST['ListeType']) or isset($_POST['ListeLecteur']))
{
	// Un r�sultat etait deja en session => suppression
    if(isset($_SESSION['resultat'])) {
        unset($_SESSION['resultat']);
    }
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
	$Resultat=$DAL_Collection_BD->ListeBDRechercheConditionne($genre,$type,$lecteur);
	
	// R�cup�ration du r�sultat de la requ�te
    $Affichage=$Resultat->fetchAll();
    // Stocke en session la liste r�cup�r�e
    // /!\ Ne pas mettre en session $Resultat car l'objet est non serialisable
    $_SESSION['resultat']=$Affichage;
}	else {
    // Le resultat est il dans la session ?
    if(isset($_SESSION['resultat'])) {
        // Oui on le recupere
        //$Affichage=$_SESSION['resultat'];
        $Affichage=$_SESSION['resultat'];
    } else {
        // Non initialise une valeur par defaut
        $Affichage=array();
    }
}

$ReponseBD=$DAL_Collection_BD->ListeGenreBD();
$ReponseLecteur=$DAL_Collection_BD->ListeLecteurBD();
$ReponseType=$DAL_Collection_BD->ListeTypeBD();

$pageCourante=getPageCourante('page');

?>