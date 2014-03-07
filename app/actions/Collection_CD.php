<?php
if (!isset($_SESSION['NomPrenom']) or empty($_SESSION['NomPrenom']))
{
	$status="<div class=\"reponse_cnx_ko\"> L'accès à cette page vous est interdit pour l'instant. </div>";
	Atomik::setView('Identification');
	exit;
}

Atomik::needed('DAL/CollectionCD');
Atomik::needed('BL/Pagination');
Atomik::needed('CMN/Tableau');

$DAL_Collection_CD=new DAL_Collection_CD();
$BL_Tableau=new CMN_Tableau();

if (isset($_POST['ListeArtiste']) or isset($_POST['ListeLecteur']))
{
	// Un résultat etait deja en session => suppression
	if(isset($_SESSION['resultat'])) {
		unset($_SESSION['resultat']);
	}
	if (!empty($_POST['ListeArtiste']))
	{
		$artiste=$_POST['ListeArtiste'];
	}
	if (!empty($_POST['ListeLecteur']))
	{
		$lecteur=$_POST['ListeLecteur'];
	}
	$Resultat=$DAL_Collection_CD->ListeCDRechercheConditionne($artiste,$lecteur);

	// Récupération du résultat de la requête
	$Affichage=$Resultat->fetchAll();
	// Stocke en session la liste récupérée
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

$ReponseLecteur=$DAL_Collection_CD->ListeLecteurCD();
$ReponseArtiste=$DAL_Collection_CD->ListeArtisteCD();

$pageCourante=getPageCourante('page');

//$pageCourante = 0;
$maxLignes = 22;

//Si le nombre de lignes retournées par la requête est inférieur au nombre de lignes à afficher
// alors prendre en compte uniquement le nombre de lignes retournées par la requête

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
$Entete=array(1 => 'Artiste',
			  2 => 'Titre',
			  3 => 'Lecteur' );
			  
$Tableau=$BL_Tableau->AffichageTableau($Entete, $Affichage, $pageCourante, $maxLignesAffichees);


?>