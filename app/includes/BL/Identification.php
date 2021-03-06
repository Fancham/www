<?php

Class BL_Identification
{
		function Inscription_site($nom,$prenom,$pseudo,$motDePasse,$confMotDePasse,$mail,$repVerifMail)
		{
			//Comparaison entre le mot de passe et la confirmation du mot de passe
			$repVerifMotDePasse=BL_Identification::verif_MotDePasse($motDePasse,$confMotDePasse);
			
			//Si au moins un des champs d'inscription est null, retour en erreur
			if ($nom==null || $prenom==null || $pseudo==null || $motDePasse==null || $confMotDePasse==null || $mail==null)
			{
				$retourInscription=array("statut" => 900,"message" => "<div class=\"reponse_ko\"> Veuillez entrer des informations valides s'il vous plait.</div>");
				return $retourInscription;
			}
			else 
			{
				if ($repVerifMotDePasse==true)
				{
					if ($repVerifMail==true)
					{
						//Inscription possible
						$retourInscription=array("statut" => 1,"message" => "");
						return $retourInscription;
					}
					else
					{
						//Mail incorrect
						$retourInscription=array("statut" => 901,"message" => "<div class=\"reponse_ko\"> Votre mail n'est pas valide. Veuillez entrer un mail valide. </div>");
						return $retourInscription;
					}
				}
				else
				{
					//Diff�rence entre le mot de passe et la confirmation de mot de passe
					$retourInscription=array("statut" => 902,"message" => "<div class=\"reponse_ko\"> Vos mots de passe ne sont pas identiques. Veuillez rentrez des mots de passe identiques. </div>");
					return $retourInscription;
				}
			}
		}	
		
		function verif_MotDePasse($motDePasse,$confMotDePasse)
		{
			if ($motDePasse==$confMotDePasse)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		
		function ActivationIdentification($pseudo,$NomPrenom,$mot_de_passe,$verifIdentification)
		{
			//S�curisation contre les injections sql
			$login=$pseudo;
			
			//Mise en m�moire session du Login
			$_SESSION['login']=$login;
			
			//Hachage du mot de passe
			$password=$mot_de_passe;
		
			if ($verifIdentification=='FD')
			{
				$_SESSION['NomPrenom']=array($NomPrenom,'FD');
				$retourIdentification=array("statut" => 1,"message" =>"");
				return $retourIdentification;
			}
			else if ($verifIdentification=='FO')
			{
				$_SESSION['NomPrenom']=array($NomPrenom,'FO');
				$retourIdentification=array("statut" => 2,"message" =>"");
				return $retourIdentification;
			}
			else if ($verifIdentification=='AO')
			{
				$_SESSION['NomPrenom']=array($NomPrenom,'AO');
				$retourIdentification=array("statut" => 3,"message" =>"");
				return $retourIdentification;
			}
			else if ($verifIdentification=='AD')
			{
				$_SESSION['NomPrenom']=array($NomPrenom,'AD');
				$retourIdentification=array("statut" => 4,"message" =>"");
				return $retourIdentification;
			}
			else if ($verifIdentification=='NOK')
			{
				$retourIdentification=array("statut" => 905,"message" =>"<div class=\"reponse_nok\"> Vous �tes d�j� enregistr� mais votre compte n'est pas encore actif. Merci d'attendre son activation par l'administrateur. </div>");
				return $retourIdentification;
			}
			else
			{
				$retourIdentification=array("statut" => 905,"message" => "<div class=\"reponse_ko\"> Vous n'�tes pas enregistr�. Pour vous inscrire sur le site, veuillez remplir les diff�rents champs ci-dessus. </div>");
				return $retourIdentification;
			}
		}
		
		function hachage($password)
		{
			$password_Hach=sha1($password);
			
			return $password_Hach;
		}
	}
?>