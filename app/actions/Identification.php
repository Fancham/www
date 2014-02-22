<?php
	
	Atomik::needed('DAL/Identification');
	Atomik::needed('BL/Identification');

$this->log('an error has occured!', LOG_ERR);
	$DAL_Identification=new DAL_Identification();
	$BL_Identification=new BL_Identification();
	
	
	//V�rification que les variables POST login et password sont bien valoris�es
	if (isset($_POST['login']) and isset($_POST['password']))
	{
		//Protection contre les injections SQL
		$pseudo=htmlspecialchars($_POST['login']);
		
		$mot_de_passe=$_POST['password'];

		//V�rification que le visiteur est bien enregistr� en base
		$verifIdentification=$DAL_Identification->Identification($pseudo, $mot_de_passe);
		
		if ($verifIdentification == 'FD' || $verifIdentification == 'FO' || $verifIdentification == 'AO' || $verifIdentification == 'AD')
		{
			//Valorisation des variables de session si le visiteur est bien identifi�
			$BL_Identification->identification($pseudo, $mot_de_passe, $verifIdentification);
			Atomik::url('En_Travaux');
		}
		else if ($verifIdentification == 'NOK')
		{	
			//R�cup�ration du message d'erreur
			$verifIdentification=$BL_Identification->identification($pseudo, $mot_de_passe, $verifIdentification);
			
			//Mise en m�moire du message d'erreur pour affichage sur la page du site
			$status=$verifIdentification["message"];
		}
		else
		{
			//R�cup�ration du message d'erreur
			$verifIdentification=$BL_Identification->identification($pseudo, $mot_de_passe, $verifIdentification);
			
			//Mise en m�moire du message d'erreur pour affichage sur la page du site
			$status=$verifIdentification["message"];
			Atomik::setView('Inscription');
		}
		
	}
?>