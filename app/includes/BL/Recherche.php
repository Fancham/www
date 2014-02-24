<?php
Class BL_Recherche
{
	// Menu Liste Genre dans la page de sélection des BD
	function AffichageListeGenreBD()
	{

		$ListeBD=ListeGenreBD();
		return $ListeBD;
	}

	// Menu Liste Type dans la page de sélection des BD
	function AffichageListeTypeBD()
	{
		$ListeBD=ListeTypeBD();
		return $ListeBD;
	}

	// Menu Liste Lecteur dans la page de sélection des BD
	function AffichageListeLecteurBD()
	{
		$ListeBD=ListeLecteurBD();
		return $ListeBD;
	}

	function ListeBDRechercheToutNbTot()
	{
		$Resultat=ListeBDRechercheTout();
		return $Resultat;
	}

	function ListeBDRechercheNbTot($genre)
	{

		$Resultat=ListeBDRecherche($genre);
		return $Resultat;
	}

	function ListeBDRechercheToutLimiteDAL()
	{
		$debut=$_SESSION['debutBD'];
		$limite=$_SESSION['limiteBD'];

		$Resultat=ListeBDRechercheToutLimite($debut,$limite);
		return $Resultat;
	}

	function ListeBDRechercheLimiteDAL()
	{
		$debut=$_SESSION['debutBD'];
		$limite=$_SESSION['limiteBD'];

		$Resultat=ListeBDRechercheLimite($genre,$debut,$limite);
		return $Resultat;
	}
}
?>