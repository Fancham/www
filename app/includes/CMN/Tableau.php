<?php
Class CMN_Tableau
{

	function AffichageTableau($Entete, $Contenu, $pageCourante, $maxLignesAffichees, $maxLignesaAffichees)
	{
		$Tableau='<table>';
		$Tableau.='<tr>';
		//Construction de l'entête du tableau
		for ($j=1; $j<=count($Entete); $j++)
		{
			$Tableau.='<th>';
			$Tableau.=$Entete[$j];
			$Tableau.='</th>';
		}
		$Tableau.='</tr>';
		//Boucle sur le nombre de lignes a afficher dans le tableau
		for ($i=($pageCourante-1)*$maxLignesAffichees; $i < (($pageCourante-1)*$maxLignesAffichees)+$maxLignesaAffichees; $i++)
		{
			$Tableau.='<tr>';
			//Boucle sur le nombre de champs a afficher dans une ligne du tableau
			for ($l=1; $l<=count($Entete); $l++)
			{
				$Tableau.='<td class="TabResult">';
				//J'affiche les champs dont le nom correspond à l'intitulé de l'entête
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