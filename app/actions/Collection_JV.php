<?php
if (!isset($_SESSION['NomPrenom']) or empty($_SESSION['NomPrenom']))
{
	$status="<div class=\"reponse_cnx_ko\"> L'acc�s � cette page vous est interdit pour l'instant. </div>";
	Atomik::setView('Identification');
	exit;
}

Atomik::needed('DAL/CollectionJV');
Atomik::needed('BL/Pagination');
Atomik::needed('CMN/Tableau');

$DAL_Collection_JV=new DAL_Collection_JV();
$BL_Tableau=new CMN_Tableau();

if (isset($_POST['ListeGenreJV']) or isset($_POST['ListeConsole']) or isset($_POST['ListeJoueur']))
{
	// Un r�sultat etait deja en session => suppression
	if(isset($_SESSION['resultat'])) {
		unset($_SESSION['resultat']);
	}
	if (!empty($_POST['ListeGenreJV']))
	{
		$genre=$_POST['ListeGenreJV'];
	}
	if (!empty($_POST['ListeConsole']))
	{
		$console=$_POST['ListeConsole'];
	}
	if (!empty($_POST['ListeJoueur']))
	{
		$joueur=$_POST['ListeJoueur'];
	}
	$Resultat=$DAL_Collection_JV->ListeJVRechercheConditionne($genre,$console,$joueur);

	// R�cup�ration du r�sultat de la requ�te
	$Affichage=$Resultat->fetchAll();
	// Stocke en session la liste r�cup�r�e
	// /!\ Ne pas mettre en session $Resultat car l'objet est non serialisable
	$_SESSION['resultat']=$Affichage;
}	
else if (isset($_GET['page']))
{
	// Le resultat est il dans la session ?
	if(isset($_SESSION['resultat']))
	{
		// Oui on le recupere
		//$Affichage=$_SESSION['resultat'];
		$Affichage=$_SESSION['resultat'];
	}
	else
	{
		// Non initialise une valeur par defaut
		$Affichage=array();
	}
}
else
{
	// Non initialise une valeur par defaut
	$Affichage=array();
}

$ReponseJV=$DAL_Collection_JV->ListeGenreJV();
$ReponseJoueur=$DAL_Collection_JV->ListeJoueurJV();
$ReponseConsole=$DAL_Collection_JV->ListeConsoleJV();

$pageCourante=getPageCourante('page');

//$pageCourante = 0;
$maxLignes = 16;

//Si le nombre de lignes retourn�es par la requ�te est inf�rieur au nombre de lignes � afficher
// alors prendre en compte uniquement le nombre de lignes retourn�es par la requ�te

if (count($Affichage) < $maxLignes)
{
	$maxLignesaAffichees = count($Affichage);
}
else if (count($Affichage)/$maxLignes<$pageCourante && $pageCourante<count($Affichage)/$maxLignes+1)
{
	$NbLigneAffichage=count($Affichage);
	$NbLignePassees=(($pageCourante-1)*$maxLignes);
	$maxLignesaAffichees=variant_sub($NbLigneAffichage,$NbLignePassees);
}
else
{
	$maxLignesaAffichees = $maxLignes;
}
$Entete=array(1 => 'Genre',
			  2 => 'Titre',
			  3 => 'Console',
			  4 => 'Joueur' );
			  
$Tableau=$BL_Tableau->AffichageTableau($Entete, $Affichage, $pageCourante, $maxLignes, $maxLignesaAffichees);


?>