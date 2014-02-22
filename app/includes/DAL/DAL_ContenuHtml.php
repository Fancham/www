<?php
	// Chargement des paramètres
	require('Commun_Publique/CMN_Parametres.php');
	
		
	class DAL_ContenuHtml
	{
		//Initialisation des variables
		
		
		function RechercheContenu($Page)
		{		
			//Ouverture de la connexion à la BDD
			$bdd=DAL_ContenuHtml::Connex();
				
			//Recherche du contenu
			$sql='SELECT ContenuHtml FROM contenuhtml WHERE Page = :page';
			$R=$bdd->prepare($sql);
			$R->execute(array(':page' => ''. $Page .''));
			$Texte=$R->fetch();
			
			//Fermeture de la connexion enBDD
			DAL_Identification::ConnexKO($bdd);

			return $Texte;
				
		}
		
		function InsertionContenu($Page, $Type, $ContenuHtml)
		{
			try
			{
				//Recherche du contenu
				$sql='SELECT count(*) FROM contenuhtml';
				$RNb=$bdd->prepare($sql);
				$RNb->execute();
				$Id=$RNb->fetch();
				$Id=Id+1;
				
				//Insertion du nouveau texte
				$sql='INSERT INTO contenuhtml (id,ContenuHtml,Type,Page) VALUES(:id, :contenuhtml, :type, :page)';
				$R=$bdd->prepare($sql);
				$R->execute(array(':id' => ''. $Id .'', ':contenuhtml' => ''. $ContenuHtml .'',':type' => ''. $Type .'',':page' => ''. $Page .''));	
				
				//Fermeture de la connexion enBDD
				DAL_Identification::ConnexKO($bdd);
							
				return true;
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