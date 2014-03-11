<?php

// Chargement des paramètres
Atomik::needed('CMN/ConnexionBDD');

Class DAL_Collection_BDLivres
{
	//////////            Recherche de BD             //////////

	// Menu Liste Genre dans la page de sélection des BD
	function ListeGenreBD()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();

			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT genres.Genre FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id WHERE Type NOT LIKE \'Livre\'';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
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

	// Menu Liste Lecteur dans la page de sélection des BD
	function ListeLecteurBD()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();

			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Lecteurs.Lecteur FROM Livres INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type NOT LIKE \'Livre\'';
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
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type NOT LIKE \'Livre\' ORDER BY Auteur, Genre, Nom, Titre, Volume';
				$R=$bdd->prepare($sql);

			}
			else if ($genre!='Vide' && $type!='Vide' && $lecteur!='Vide')
			{
				$genre='%'. $genre .'%';
				$type='%'. $type .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type NOT LIKE \'Livre\' and (lecteurs.lecteur like :lecteur AND type like :type AND genres.genre like :genre) ORDER BY Auteur, Genre, Nom, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':type', $type, PDO::PARAM_STR);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			else if ($genre!='Vide' && $type!='Vide' && $lecteur=='Vide')
			{
				$genre='%'. $genre .'%';
				$type='%'. $type .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type NOT LIKE \'Livre\' and (type like :type AND genres.genre like :genre) ORDER BY Auteur, Genre, Nom, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':type', $type, PDO::PARAM_STR);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			else if ($genre!='Vide' && $type=='Vide' && $lecteur!='Vide')
			{
				$genre='%'. $genre .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type NOT LIKE \'Livre\' and (lecteurs.lecteur like :lecteur AND genres.genre like :genre) ORDER BY Auteur, Genre, Nom, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			else if ($genre=='Vide' && $type!='Vide' && $lecteur!='Vide')
			{
				$type='%'. $type .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type NOT LIKE \'Livre\' and (lecteurs.lecteur like :lecteur AND type like :type) ORDER BY Auteur, Genre, Nom, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':type', $type, PDO::PARAM_STR);
			}
			else if ($genre=='Vide' && $type=='Vide' && $lecteur!='Vide')
			{
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type NOT LIKE \'Livre\' and (lecteurs.lecteur like :lecteur) ORDER BY Auteur, Genre, Nom, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
			}
			else if ($genre=='Vide' && $type!='Vide' && $lecteur=='Vide')
			{
				$type='%'. $type .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type NOT LIKE \'Livre\' and (type like :type) ORDER BY Auteur, Genre, Nom, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':type', $type, PDO::PARAM_STR);
			}
			else if ($genre!='Vide' && $type=='Vide' && $lecteur=='Vide')
			{
				$lecteur='%'. $genre .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type NOT LIKE \'Livre\' and (genres.genre like :genre) ORDER BY Auteur, Genre, Nom, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			else
			{
				$R=array();
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


	//////////            Recherche de Livres             //////////

	// Menu Liste Genre dans la page de sélection des Livres
	function ListeGenreLivres()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();

			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Genres.Genre FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id WHERE Type = \'Livre\'';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Auteur dans la page de sélection des Livres
	function ListeAuteurLivres()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();

			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Auteur FROM Livres WHERE Type = \'Livre\'';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Lecteur dans la page de sélection des Livres
	function ListeLecteurLivres()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();

			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Lecteurs.Lecteur FROM Livres INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type = \'Livre\'';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	function ListeLivresRechercheConditionne($genre,$auteur,$lecteur)
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();

			$bdd=$ConnexionBDD->Connex();
			if ($genre=='Tout')
			{
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type = \'Livre\' ORDER BY Auteur, genres.Genre, Titre, Volume';
				$R=$bdd->prepare($sql);
			}
			else if ($genre!='Vide' && $auteur!='Vide' && $lecteur!='Vide')
			{
				$genre='%'. $genre .'%';
				$auteur='%'. $auteur .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type = \'Livre\' and (lecteurs.lecteur like :lecteur AND auteur like :auteur AND genres.genre like :genre) ORDER BY Auteur, genres.Genre, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':auteur', $auteur, PDO::PARAM_STR);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			else if ($genre!='Vide' && $auteur!='Vide' && $lecteur=='Vide')
			{
				$genre='%'. $genre .'%';
				$auteur='%'. $auteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type = \'Livre\' and (auteur like :auteur AND genres.genre like :genre) ORDER BY Auteur, genres.Genre, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':auteur', $auteur, PDO::PARAM_STR);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			else if ($genre!='Vide' && $auteur=='Vide' && $lecteur!='Vide')
			{
				$genre='%'. $genre .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type = \'Livre\' and (lecteurs.lecteur like :lecteur AND genres.genre like :genre) ORDER BY Auteur, genres.Genre, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			else if ($genre=='Vide' && $auteur!='Vide' && $lecteur!='Vide')
			{
				$auteur='%'. $auteur .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type = \'Livre\' and (lecteurs.lecteur like :lecteur AND auteur like :auteur) ORDER BY Auteur, genres.Genre, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':auteur', $auteur, PDO::PARAM_STR);
			}
			else if ($genre!='Vide' && $auteur=='Vide' && $lecteur=='Vide')
			{
				$genre='%'. $genre .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type = \'Livre\' and (genres.genre like :genre) ORDER BY Auteur, genres.Genre, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			}
			else if ($genre=='Vide' && $auteur!='Vide' && $lecteur=='Vide')
			{
				$auteur='%'. $auteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type = \'Livre\' and (auteur like :auteur) ORDER BY Auteur, genres.Genre, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':auteur', $auteur, PDO::PARAM_STR);
			}
			else if ($genre=='Vide' && $auteur=='Vide' && $lecteur!='Vide')
			{
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT genres.Genre, Nom, Editeur, Auteur, Titre, Volume, Type, lecteurs.Lecteur FROM Livres INNER JOIN Genres ON Livres.genre=Genres.Id INNER JOIN Lecteurs ON Livres.Lecteur=Lecteurs.Id WHERE Type = \'Livre\' and (lecteurs.lecteur like :lecteur) ORDER BY Auteur, genres.Genre, Titre, Volume';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
			}
			else
			{
				$R=array();
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