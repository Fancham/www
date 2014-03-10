<?php

// Chargement des paramètres
Atomik::needed('CMN/ConnexionBDD');

Class DAL_Collection_CD
{
	// Menu Liste Type dans la page de sélection des CD
	function ListeArtisteCD()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT Artiste FROM CD';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);
			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	// Menu Liste Lecteur dans la page de sélection des CD
	function ListeLecteurCD()
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			$sql='SELECT DISTINCT lecteurs.Lecteur FROM CD INNER JOIN Lecteurs ON CD.Lecteur=Lecteurs.Id';
			$R=$bdd->query($sql);

			$ConnexionBDD->ConnexKO($bdd);

			return $R;
		}
		catch (Exception $e)
		{
			die('Erreur:' . $e-> getMessage());
		}
	}

	function ListeCDRechercheConditionne($artiste,$lecteur)
	{
		try
		{
			$ConnexionBDD=new CMN_ConnexionBDD();
			
			$bdd=$ConnexionBDD->Connex();
			if ($artiste=='Tout')
			{
				$sql='SELECT Artiste, lecteurs.Lecteur, Nombre, Titre FROM CD INNER JOIN Lecteurs ON CD.Lecteur=Lecteurs.Id ORDER BY Artiste, Titre';
				$R=$bdd->prepare($sql);
			}
			else 
			{
				$artiste='%'. $artiste .'%';
				$lecteur='%'. $lecteur .'%';
				$sql='SELECT Artiste, lecteurs.Lecteur, Nombre, Titre FROM CD INNER JOIN Lecteurs ON CD.Lecteur=Lecteurs.Id WHERE lecteurs.lecteur like :lecteur OR artiste like :artiste ORDER BY Artiste, Titre';
				$R=$bdd->prepare($sql);
				$R->bindParam(':lecteur', $lecteur, PDO::PARAM_STR);
				$R->bindParam(':artiste', $artiste, PDO::PARAM_STR);
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