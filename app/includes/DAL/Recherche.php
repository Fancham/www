<?php

// Chargement des param�tres
Atomik::needed('CMN/Parametres');

Class DAL_Recherche
{
	// Menu Liste Genre dans la page de sélection des BD
	function ListeGenreBD()
	{
		try
		{
			$bdd=Recherche::Connex();
			$sql='SELECT DISTINCT Genre FROM Livres';
			$R=$bdd->query($sql);

			Recherche::ConnexKO($bdd);
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
			$bdd=Recherche::Connex();
			$sql='SELECT DISTINCT Type FROM Livres';
			$R=$bdd->query($sql);

			Recherche::ConnexKO($bdd);
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
			$bdd=Recherche::Connex();
			$sql='SELECT DISTINCT Lecteur FROM Livres';
			$R=$bdd->query($sql);

			Recherche::ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	function ListeBDRecherche($genre)
	{
		try
		{
			$bdd=Recherche::Connex();
			$sql='SELECT count( 1 ) AS count FROM Livres WHERE genre = :genre';
			$R=$bdd->prepare($sql);
			$R->execute(array(':genre' => ''. $genre .''));
			Recherche::ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}
	function ListeBDRechercheTout()
	{
		try
		{
			$bdd=Recherche::Connex();
			$sql='SELECT count( 1 ) AS count FROM Livres';
			$R=$bdd->query($sql);
			Recherche::ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Recherche toutes les références BD avec comme critère de recherche Genre='Tous'
	function ListeBDRechercheToutLimite($debut,$limite)
	{
		try
		{
			$debut=intval($debut);
			$limite=intval($limite);
			$bdd=Recherche::Connex();
			$sql='SELECT * FROM Livres LIMIT :debut, :limite';
			$R=$bdd->prepare($sql);
			$R->bindParam(':debut', $debut, PDO::PARAM_INT);
			$R->bindParam(':limite', $limite, PDO::PARAM_INT);
			$R->execute();
			Recherche::ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Recherche toutes les références BD avec comme critère de recherche Genre='Tous' et Lecteur est renseigné
	function ListeBDRechercheLimite($genre,$type,$lecteur,$debut,$limite)
	{
		try
		{
			$debut=intval($debut);
			$limite=intval($limite);
			$genre='%'. $genre .'%';
			$type='%'. $type .'%';
			$lecteur='%'. $lecteur .'%';
			$bdd=Recherche::Connex();
			$sql='SELECT * FROM Livres WHERE lecteur like :lecteur OR type like :type OR genre like :genre LIMIT :debut, :limite';
			$R=$bdd->prepare($sql);
			$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
			$R->bindParam(':type', $type, PDO::PARAM_STR);
			$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			$R->bindParam(':debut', $debut, PDO::PARAM_INT);
			$R->bindParam(':limite', $limite, PDO::PARAM_INT);
			$R->execute();
			Recherche::ConnexKO($bdd);
			return $R;
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