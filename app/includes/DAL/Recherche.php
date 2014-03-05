<?php

// Chargement des paramètres
Atomik::needed('CMN/Parametres');

Class DAL_Recherche
{
	// Menu Liste Genre dans la page de sélection des BD
	function ListeGenreBD()
	{
		try
		{
			$bdd=DAL_Recherche::Connex();
			$sql='SELECT DISTINCT Genre FROM Livres';
			$R=$bdd->query($sql);

			DAL_Recherche::ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Type dans la page de sélection des BD
	function ListeTypeBD()
	{
		try
		{
			$bdd=DAL_Recherche::Connex();
			$sql='SELECT DISTINCT Type FROM Livres';
			$R=$bdd->query($sql);

			DAL_Recherche::ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Lecteur dans la page de sélection des BD
	function ListeLecteurBD()
	{
		try
		{
			$bdd=DAL_Recherche::Connex();
			$sql='SELECT DISTINCT Lecteur FROM Livres';
			$R=$bdd->query($sql);

			DAL_Recherche::ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	function ListeBDRechercheConditionne($genre,$type,$lecteur)
	{
		try
		{
			$bdd=DAL_Recherche::Connex();
			if ($genre=='Tout')
			{
				$sql='SELECT * FROM Livres ORDER BY Nom, \'Volumes achetés\'';
				$R=$bdd->prepare($sql);
			}
			else 
			{
				$genre='%'. $genre .'%';
				$type='%'. $type .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT * FROM Livres WHERE lecteur like :lecteur OR type like :type OR genre like :genre ORDER BY Nom, \'Volumes achetés\'';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':type', $type, PDO::PARAM_STR);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			$R->execute();
			return $R;
			DAL_Recherche::ConnexKO($bdd);
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	function Connex()
	{
		try
		{
			$bdd = new PDO($_SESSION['BDD_Adresse'],$_SESSION['BDD_Login'],$_SESSION['BDD_Mot_de_Passe']);

			return $bdd;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	function ConnexKO($bdd)
	{
		$bdd=null;
	}
}
?>