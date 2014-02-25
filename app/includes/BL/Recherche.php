<?php
Class BL_Recherche
{
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