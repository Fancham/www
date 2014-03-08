<?php
if (!isset($_SESSION['NomPrenom']) or empty($_SESSION['NomPrenom']))
{
	$status="<div class=\"reponse_cnx_ko\"> L'acc�s � cette page vous est interdit pour l'instant. </div>";
	Atomik::setView('Identification');
	exit;
}

Atomik::needed('DAL/CollectionBDLivres');
Atomik::needed('BL/Pagination');
Atomik::needed('CMN/Tableau');

$DAL_Collection_BD=new DAL_Collection_BDLivres();
$BL_Tableau=new CMN_Tableau();

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

//$pageCourante = 0;
$maxLignes = 22;

//Si le nombre de lignes retourn�es par la requ�te est inf�rieur au nombre de lignes � afficher
// alors prendre en compte uniquement le nombre de lignes retourn�es par la requ�te

if (count($Affichage) < $maxLignes)
{
	$maxLignesAffichees = count($Affichage);
}
else if (count($Affichage)/$maxLignes<$pageCourante && $pageCourante<count($Affichage)/$maxLignes+1)
{
	$maxLignesAffichees = count($Affichage)-(($pageCourante-1)*$maxLignes);
}
else
{
	$maxLignesAffichees = 22;
}
$Entete=array(1 => 'Nom',
			  2 => 'Titre',
			  3 => 'Volume',
			  4 => 'Auteur',
			  5 => 'Editeur',
			  6 => 'Genre',
			  7 => 'Type',
			  8 => 'Lecteur' );
			  
$Tableau=$BL_Tableau->AffichageTableau($Entete, $Affichage, $pageCourante, $maxLignesAffichees);


?>