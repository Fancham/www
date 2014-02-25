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

	function ListeBDRecherche($genre)
	{
		try
		{
			$bdd=DAL_Recherche::Connex();
			$sql='SELECT count( 1 ) AS count FROM Livres WHERE genre = :genre';
			$R=$bdd->prepare($sql);
			$R->execute(array(':genre' => ''. $genre .''));
			DAL_Recherche::ConnexKO($bdd);

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
			$bdd=DAL_Recherche::Connex();
			$sql='SELECT count( 1 ) AS count FROM Livres';
			$R=$bdd->query($sql);
			DAL_Recherche::ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Recherche toutes les références BD avec comme critère de recherche Genre='Tous'
	function ListeBDRechercheToutLimite()
	{
		try
		{
			$bdd=DAL_Recherche::Connex();
			$sql='SELECT * FROM Livres LIMIT :debut, :limite';
			$R=$bdd->prepare($sql);
			$R->execute();
			DAL_Recherche::ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Recherche toutes les r�f�rences BD avec comme crit�re de recherche Genre='Tous' et Lecteur est renseign�
	function ListeBDRechercheConditionne($genre,$type,$lecteur)
	{
		try
		{
			$genre='%'. $genre .'%';
			$type='%'. $type .'%';
			$lecteur='%'. $lecteur .'%';
			$bdd=DAL_Recherche::Connex();
			$sql='SELECT * FROM Livres WHERE lecteur like :lecteur OR type like :type OR genre like :genre';
			$R=$bdd->prepare($sql);
			$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
			$R->bindParam(':type', $type, PDO::PARAM_STR);
			$R->bindParam(':genre', $genre, PDO::PARAM_STR);
			$R->execute();
			DAL_Recherche::ConnexKO($bdd);
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