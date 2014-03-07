<?php

// Chargement des paramètres
Atomik::needed('CMN/ConnexionBDD');

Class DAL_Collection_Films
{
	// Menu Liste Genre dans la page de sélection des films
	function ListeGenreFilms()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Genre FROM Films';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Lecteur dans la page de sélection des films
	function ListeLecteurFilms()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Lecteur FROM Films';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	function ListeFilmsRechercheConditionne($genre,$lecteur)
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			if ($genre=='Tout')
			{
				$sql='SELECT * FROM Films ORDER BY Genre, Titre';
				$R=$bdd->prepare($sql);
			}
			else 
			{
				$genre='%'. $genre .'%';
				$type='%'. $type .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT * FROM Films WHERE lecteur like :lecteur OR genre like :genre ORDER BY Genre, Titre';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
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