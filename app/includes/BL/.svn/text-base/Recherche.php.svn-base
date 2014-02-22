<?php

// Chargement des paramètres
include('Commun_Publique/CMN_Parametres.php'); 

// Menu Liste Genre dans la page de sélection des BD
function AffichageListeGenreBD()
{
	include_once($_SESSION['pathRacine'].$_SESSION['pathDAL'].'index.php');
	
	$ListeBD=ListeGenreBD();
	return $ListeBD;
}

// Menu Liste Type dans la page de sélection des BD
function AffichageListeTypeBD()
{
	include_once($_SESSION['pathRacine'].$_SESSION['pathDAL'].'index.php');
	
	$ListeBD=ListeTypeBD();
	return $ListeBD;
}

// Menu Liste Lecteur dans la page de sélection des BD
function AffichageListeLecteurBD()
{
	include_once($_SESSION['pathRacine'].$_SESSION['pathDAL'].'index.php');
	
	$ListeBD=ListeLecteurBD();
	return $ListeBD;
}

function ListeBDRechercheToutNbTot()
{
	include_once($_SESSION['pathRacine'].$_SESSION['pathDAL'].'index.php');
	$Resultat=ListeBDRechercheTout();
	return $Resultat;
}

function ListeBDRechercheNbTot($genre)
{
	include_once($_SESSION['pathRacine'].$_SESSION['pathDAL'].'index.php');
	$Resultat=ListeBDRecherche($genre);
	return $Resultat;
}

if (isset($_POST['ListeGenreBD']) or isset($_POST['ListeType']) or isset($_POST['ListeLecteur']))
{
	include_once($_SESSION['pathRacine'].$_SESSION['pathDAL'].'index.php');
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

function ListeBDRechercheToutLimiteDAL()
{
	$debut=$_SESSION['debutBD'];
	$limite=$_SESSION['limiteBD'];
	include_once($_SESSION['pathRacine'].$_SESSION['pathDAL'].'index.php');
	$Resultat=ListeBDRechercheToutLimite($debut,$limite);
	return $Resultat;
}

function ListeBDRechercheLimiteDAL()
{
	$debut=$_SESSION['debutBD'];
	$limite=$_SESSION['limiteBD'];
	include_once($_SESSION['pathRacine'].$_SESSION['pathDAL'].'index.php');
	$Resultat=ListeBDRechercheLimite($genre,$debut,$limite);
	return $Resultat;
}
?>