<?php

// Chargement des param�tres
Atomik::needed('CMN/ConnexionBDD');

Class DAL_Collection_BD
{
	// Menu Liste Genre dans la page de s�lection des BD
	function ListeGenreBD()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Genre FROM Livres WHERE Type NOT LIKE \'Livre\'';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Type dans la page de s�lection des BD
	function ListeTypeBD()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Type FROM Livres WHERE Type NOT LIKE \'Livre\'';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Lecteur dans la page de s�lection des BD
	function ListeLecteurBD()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Lecteur FROM Livres WHERE Type NOT LIKE \'Livre\'';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);

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
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			if ($genre=='Tout')
			{
				$sql='SELECT * FROM Livres WHERE Type NOT LIKE \'Livre\' ORDER BY Nom, \'Volumes achet�s\'';
				$R=$bdd->prepare($sql);
			}
			else 
			{
				$genre='%'. $genre .'%';
				$type='%'. $type .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT * FROM Livres WHERE lecteur like :lecteur OR type like :type OR genre like :genre WHERE Type NOT LIKE \'Livre\' ORDER BY Nom, \'Volumes achet�s\'';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':type', $type, PDO::PARAM_STR);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			$R->execute();
			return $R;
			$ConnexionBDD->ConnexKO($bdd);
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}
}
?>