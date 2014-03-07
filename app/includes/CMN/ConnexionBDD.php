<?php
Class CMN_ConnexionBDD
{

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