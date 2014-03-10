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
			$sql='SELECT DISTINCT genres.Genre FROM Films INNER JOIN Genres ON Films.genre=Genres.Id';
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
			$sql='SELECT DISTINCT lecteurs.Lecteur FROM Films INNER JOIN Lecteurs ON Films.Lecteur=Lecteurs.Id ';
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
				$sql='SELECT genres.Genre, lecteurs.Lecteur, Nombre, Support, Titre FROM Films INNER JOIN Genres ON Films.genre=Genres.Id INNER JOIN Lecteurs ON Films.Lecteur=Lecteurs.Id ORDER BY genres.Genre, Titre';
				$R=$bdd->prepare($sql);
			}
			else 
			{
				$genre='%'. $genre .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT genres.Genre, lecteurs.Lecteur, Nombre, Support, Titre FROM Films INNER JOIN Genres ON Films.genre=Genres.Id INNER JOIN Lecteurs ON Films.Lecteur=Lecteurs.Id WHERE lecteurs.lecteur like :lecteur OR genres.genre like :genre ORDER BY genres.Genre, Titre';
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