<?php
Class BL_Recherche
{
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
}
?>