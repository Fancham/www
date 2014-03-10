<?php

// Chargement des paramètres
Atomik::needed('CMN/ConnexionBDD');

Class DAL_Collection_JV
{
	// Menu Liste Genre dans la page de sélection des JV
	function ListeGenreJV()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT genres.Genre FROM JeuxVideos JV INNER JOIN Genres ON JV.genre=Genres.Id';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Type dans la page de sélection des JV
	function ListeConsoleJV()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Console FROM JeuxVideos';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Lecteur dans la page de sélection des JV
	function ListeJoueurJV()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT lecteurs.Lecteur AS Joueur FROM JeuxVideos JV INNER JOIN Lecteurs ON JV.Joueur=Lecteurs.Id';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	function ListeJVRechercheConditionne($genre,$console,$joueur)
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			if ($genre=='Tout')
			{
				$sql='SELECT Titre, Console, lecteurs.Lecteur AS Joueur, Nombre, genres.Genre FROM JeuxVideos JV INNER JOIN Genres ON JV.genre=Genres.Id INNER JOIN Lecteurs ON JV.Joueur=Lecteurs.Id ORDER BY Console, Titre';
				$R=$bdd->prepare($sql);
			}
			else 
			{
				$genre='%'. $genre .'%';
				$console='%'. $console .'%';
				$lecteur='%'. $joueur .'%';
				$sql='SELECT Titre, Console, lecteurs.Lecteur AS Joueur, Nombre, genres.Genre FROM JeuxVideos JV INNER JOIN Genres ON JV.genre=Genres.Id INNER JOIN Lecteurs ON JV.Joueur=Lecteurs.Id WHERE lecteurs.lecteur like :lecteur OR console like :console OR genres.genre like :genre ORDER BY Console, Titre';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':console', $console, PDO::PARAM_STR);
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