<?php
	
	Atomik::needed('DAL/Identification');
	Atomik::needed('BL/Identification');

	$DAL_Identification=new DAL_Identification();
	$BL_Identification=new BL_Identification();
	
	
	//V�rification que les variables POST login et password sont bien valoris�es
	if (isset($_POST['login']) and isset($_POST['password']))
	{
		//Log
		$this->log('D�but de l identification de ' . $_POST['login'], LOG_INFO);
		
		//Protection contre les injections SQL
		$pseudo=htmlspecialchars($_POST['login']);
		
		$mot_de_passe=htmlspecialchars($_POST['password']);
		
		//Hachage du mot de passe
		$motDePasseHach=$BL_Identification->hachage($mot_de_passe);
		
		//Log
		$this->log('V�rification que '. $pseudo .' est bien enregistr� en base', LOG_DEBUG);

		//V�rification que le visiteur est bien enregistr� en base
		$verifIdentification=$DAL_Identification->Identification($pseudo, $motDePasseHach);
		
		$NomPrenom=$DAL_Identification->RecupNomPrenom($pseudo);
		
		if ($verifIdentification == 'FD' || $verifIdentification == 'FO' || $verifIdentification == 'AO' || $verifIdentification == 'AD')
		{	
			//Log
			$this->log('Valorisation des variables de session', LOG_DEBUG);
			
			//Valorisation des variables de session si le visiteur est bien identifi�
			$BL_Identification->ActivationIdentification($pseudo, $NomPrenom, $motDePasseHach, $verifIdentification);
			Atomik::setView('En_Travaux');
		}
		else if ($verifIdentification == 'NOK')
		{	
			//Log
			$this->log('L identification de'. $pseudo .'a �chou�' , LOG_DEBUG);
			
			//R�cup�ration du message d'erreur
			$RetourActivationIdentification=$BL_Identification->ActivationIdentification($pseudo, $NomPrenom, $motDePasseHach, $verifIdentification);
			
			//Mise en m�moire du message d'erreur pour affichage sur la page du site
			$status=$RetourActivationIdentification["message"];
		}
		else
		{
			//log
			$this->log('Echec de l identification du visiteur' , LOG_DEBUG);
			
			//R�cup�ration du message d'erreur
			$RetourActivationIdentification=$BL_Identification->ActivationIdentification($pseudo, $NomPrenom, $motDePasseHach, $verifIdentification);
			
			//Mise en m�moire du message d'erreur pour affichage sur la page du site
			$status=$RetourActivationIdentification["message"];
			Atomik::setView('Inscription');
		}
		
		//Log
		$this->log('Fin de l identification de ' . $_POST['login'], LOG_INFO);
	}
?>