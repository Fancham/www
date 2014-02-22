<?php
	
	Atomik::needed('DAL/Identification');
	Atomik::needed('BL/Identification');
	Atomik::needed('BL/EmissionReceptio');
	
	$Mail=new BL_EmissionReception();
	$DAL_Identification=new DAL_Identification();
	$BL_Identification=new BL_Identification();


	//V�rification que les variables POST d'inscription sont bien valoris�es
	if (isset($_POST['ActionDemande']) and isset($_POST['Nom']) and isset($_POST['Prenom']) and isset($_POST['Pseudo']) and isset($_POST['Mot_de_passe']) and isset($_POST['Conf_Mot_de_passe']) and isset($_POST['mail']))
	{	
		echo 'tata';
		//Protection contre les injections SQL
		$nom=htmlspecialchars($_POST['Nom']);
		$prenom=htmlspecialchars($_POST['Prenom']);
		$pseudo=htmlspecialchars($_POST['Pseudo']);
		$mail=htmlspecialchars($_POST['mail']);
				
		$motDePasse=$_POST['Mot_de_passe'];
		$confMotDePasse=$_POST['Conf_Mot_de_passe'];

		
		$repVerifMail=$Mail->verif_Mail($mail);
		
		//V�rification que les valeurs du formulaire d'inscription sont correctement renseign�es
		$verifInscription=$BL_Identification->Inscription_site($nom, $prenom, $pseudo, $motDePasse, $confMotDePasse, $mail, $repVerifMail);

		//Hachage du mot de passe
		$motDePasseHach=$BL_Identification->hachage($motDePasse);
		
		if ($verifInscription["statut"]==1)
		{
			//Enregistrement du visiteur dans la BDD
			$retourInscriptionBDD=$DAL_Identification->Inscription($nom, $prenom, $pseudo, $motDePasseHach, $mail);
			echo 'titi';
			if($retourInscriptionBDD)
			{
				//Envoi d'un mail � l'administrateur du site
				$sujet = "Demande d'inscription au site Fancham par ". $prenom ." ". $nom ." !";
				$message_txt = "Une nouvelle demande d'inscription � �t� r�alis�e sur le site Fancham.fr par ". $prenom ." ". $nom ."";
				$message_html = "<html><head></head><body>Bonjour,<br /><br /> Une nouvelle demande d'inscription � �t� r�alis�e sur le site Fancham.fr par ". $prenom ." ". $nom .". </body></html>";
				$destinataire = "francois_deschamps@mailhaven.com";
				$Mail->envoi_mail($destinataire, $message_txt, $message_html, $sujet);
			}
			else
			{
				//L'inscription du visiteur en BDD � �chou�
				$status=$retourInscriptionBDD["message"];
			}
			
		}
		else 
		{
			echo 'toto';
			//Les donn�es renseign�es dans le formulaire sont incorrectes
			$status=$verifInscription["message"];
		}
	}
?>