<?php
	
	Atomik::needed('DAL/Identification');
	Atomik::needed('BL/Identification');
	Atomik::needed('BL/EmissionReception');
	
	$Mail=new BL_EmissionReception();
	$DAL_Identification=new DAL_Identification();
	$BL_Identification=new BL_Identification();


	//V�rification que les variables POST d'inscription sont bien valoris�es
	if (isset($_POST['Nom']) and isset($_POST['Prenom']) and isset($_POST['Pseudo']) and isset($_POST['Mot_de_passe']) and isset($_POST['Conf_Mot_de_passe']) and isset($_POST['mail']))
	{	
		//Log
		$this->log('D�but de l inscription de '  .$_POST['Nom'] . $_POST['Prenom'], LOG_INFO);
		
		//Protection contre les injections SQL
		$nom=htmlspecialchars($_POST['Nom']);
		$prenom=htmlspecialchars($_POST['Prenom']);
		$pseudo=htmlspecialchars($_POST['Pseudo']);
		$mail=htmlspecialchars($_POST['mail']);
				
		$motDePasse=htmlspecialchars($_POST['Mot_de_passe']);
		$confMotDePasse=htmlspecialchars($_POST['Conf_Mot_de_passe']);
		
		//Hachage des mots de passe
		$motDePasseHach=$BL_Identification->hachage($motDePasse);
		$confMotDePasseHach=$BL_Identification->hachage($confMotDePasse);

		
		$repVerifMail=$Mail->verif_Mail($mail);
		
		//Log
		$this->log('V�rification que les valeurs du formulaire d inscription sont correctement renseign�es', LOG_DEBUG);
		
		//V�rification que les valeurs du formulaire d'inscription sont correctement renseign�es
		$verifInscription=$BL_Identification->Inscription_site($nom, $prenom, $pseudo, $motDePasseHach, $confMotDePasseHach, $mail, $repVerifMail);
		
		//Log
		$this->log('V�rification de l inscription', LOG_DEBUG);
		
		if ($verifInscription["statut"]==1)
		{
			//Log
			$this->log('Enregistrement de ' . $pseudo . 'dans la BDD', LOG_DEBUG);
			
			//Enregistrement du visiteur dans la BDD
			$retourInscriptionBDD=$DAL_Identification->Inscription($nom, $prenom, $pseudo, $motDePasseHach, $mail);

			if($retourInscriptionBDD)
			{
				//Log
				$this->log('Envoi de mail � l administrateur du site', LOG_DEBUG);
			
				//Envoi d'un mail � l'administrateur du site
				$sujet = "Demande d'inscription au site Fancham par ". $prenom ." ". $nom ." !";
				$message_txt = "Une nouvelle demande d'inscription � �t� r�alis�e sur le site Fancham.fr par ". $prenom ." ". $nom ."";
				$message_html = "<html><head></head><body>Bonjour,<br /><br /> Une nouvelle demande d'inscription � �t� r�alis�e sur le site Fancham.fr par ". $prenom ." ". $nom .". </body></html>";
				$destinataire = "francois_deschamps@mailhaven.com";
				$Mail->envoi_mail($destinataire, $message_txt, $message_html, $sujet);
				
				//Retour � la page d'identification
				$status="<div class=\"reponse_ok\"> Votre demande d'inscription a bien �t� prise en compte. Un mail vous sera envoy� lors de la validation de votre compte par l administrateur du site.</div>";
				Atomik::setView('Identification');
				
			}
			else
			{
				//Log
				$this->log('L inscription de' . $pseudo . ' en BDD � �chou�', LOG_DEBUG);
				
				//L'inscription du visiteur en BDD � �chou�
				$status=$retourInscriptionBDD["message"];
			}
			
		}
		else 
		{
			//Log
			$this->log('Les donn�es renseign�es dans le formulaire sont incorrectes', LOG_DEBUG);
				
			//Les donn�es renseign�es dans le formulaire sont incorrectes
			$status=$verifInscription["message"];
		}
		
		//Log
		$this->log('Fin de l inscription de '  .$_POST['Nom'] . $_POST['Prenom'], LOG_INFO);
	}
?>