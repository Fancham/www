<?php
if (!isset($_SESSION['NomPrenom']) or empty($_SESSION['NomPrenom']))
{
	$status="<div class=\"reponse_cnx_ko\"> L'accès à cette page vous est interdit pour l'instant. </div>";
	Atomik::setView('Identification');
	exit;
}

Atomik::needed('DAL/Recherche');
Atomik::needed('BL/Recherche');
Atomik::needed('BL/Pagination');

$DAL_Recherche=new DAL_Recherche();
$BL_Identification=new BL_Identification();
$BL_Recherche=new BL_Recherche();

if (isset($_POST['ListeGenreBD']) or isset($_POST['ListeType']) or isset($_POST['ListeLecteur']))
{
	// Un résultat etait deja en session => suppression
    if(isset($_SESSION['resultat'])) {
        unset($_SESSION['resultat']);
    }
	if (!empty($_POST['ListeGenreBD']))
	{
		$genre=$_POST['ListeGenreBD'];
	}
	if (!empty($_POST['ListeType']))
	{
		$type=$_POST['ListeType'];
	}
	if (!empty($_POST['ListeLecteur']))
	{
		$lecteur=$_POST['ListeLecteur'];
	}
	$Resultat=$DAL_Recherche->ListeBDRechercheConditionne($genre,$type,$lecteur);
	
	// Récupération du résultat de la requête
    $Affichage=$Resultat->fetchAll();
    // Stocke en session la liste récupérée
    // /!\ Ne pas mettre en session $Resultat car l'objet est non serialisable
    $_SESSION['resultat']=$Affichage;
}	else {
    // Le resultat est il dans la session ?
    if(isset($_SESSION['resultat'])) {
        // Oui on le recupere
        $Affichage=$_SESSION['resultat'];
    } else {
        // Non initialise une valeur par defaut
        $Affichage=array();
    }
}

$ReponseBD=$DAL_Recherche->ListeGenreBD();
$ReponseLecteur=$DAL_Recherche->ListeLecteurBD();
$ReponseType=$DAL_Recherche->ListeTypeBD();

$pageCourante=getPageCourante('page');
// $contentForLayout = Atomik::render('Collection_BD', Array('Resultat'=>$Resultat, 
                                                          // 'pageCourante'=>$pageCourante, 
                                                          // 'ReponseBD'=>$ReponseBD,
                                                          // 'ReponseLecteur'=>$ReponseLecteur,
                                                          // 'ReponseType'=>$ReponseType
                                                          // )
                                                          // );

?>