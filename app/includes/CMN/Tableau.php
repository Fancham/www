<?php
Class CMN_Tableau
{

	function AffichageTableau($Entete, $Contenu, $pageCourante, $maxLignesAffichees)
	{
		$Tableau='<table class="AffichResult">';
		$Tableau.='<tr>';
		//Construction de l'ent�te du tableau
		for ($j=1; $j<=count($Entete); $j++)
		{
			$Tableau.='<th>';
			$Tableau.=$Entete[$j];
			$Tableau.='</th>';
		}
		$Tableau.='</tr>';
		//Boucle sur le nombre de lignes a afficher dans le tableau
		for ($i=($pageCourante-1)*$maxLignesAffichees; $i < $maxLignesAffichees*$pageCourante; $i++)
		{
			$Tableau.='<tr>';
			//Boucle sur le nombre de champs a afficher dans une ligne du tableau
			for ($l=1; $l<=count($Entete); $l++)
			{
				$Tableau.='<td>';
				//J'affiche les champs dont le nom correspond � l'intitul� de l'ent�te
				$Tableau.=$Contenu[$i][$Entete[$l]];
				$Tableau.='</td>';
			}
			$Tableau.='</tr>';
		}
		$Tableau.='</table>';
		
		//Retourne le tableau a afficher
		return $Tableau;
	}
}
?>