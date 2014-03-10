<?php

// Chargement des paramètres
Atomik::needed('CMN/ConnexionBDD');

Class DAL_Collection_Series
{
	// Menu Liste Genre dans la page de sélection des Series
	function ListeGenreSeries()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT genres.Genre FROM Series INNER JOIN Genres ON Series.genre=Genres.Id';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Lecteur dans la page de sélection des Series
	function ListeLecteurSeries()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT lecteurs.Lecteur FROM Series INNER JOIN Lecteurs ON Series.Lecteur=Lecteurs.Id';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	function ListeSeriesRechercheConditionne($genre,$lecteur)
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			if ($genre=='Tout')
			{
				$sql='SELECT Titre, Saison, genres.Genre, lecteurs.Lecteur, Support, Nombre FROM Series INNER JOIN Genres ON Series.genre=Genres.Id INNER JOIN Lecteurs ON Series.Lecteur=Lecteurs.Id ORDER BY genres.Genre, Titre, Saison';
				$R=$bdd->prepare($sql);
			}
			else 
			{
				$genre='%'. $genre .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT Titre, Saison, genres.Genre, lecteurs.Lecteur, Support, Nombre FROM Series INNER JOIN Genres ON Series.genre=Genres.Id INNER JOIN Lecteurs ON Series.Lecteur=Lecteurs.Id WHERE lecteurs.lecteur like :lecteur OR genres.genre like :genre ORDER BY genres.Genre, Titre, Saison';
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