<?php
Class BL_Tableau
{

	function AffichageTableau($Entete, $Contenu, $pageCourante, $maxLignesAffichees)
	{
		$Tableau='<table class="AffichResult">';
		$Tableau.='<tr>';
		for ($j=1; $j<=count($Entete); $j++)
		{
			$Tableau.='<th>';
			$Tableau.=$Entete[$j];
			$Tableau.='</th>';
		}
		$Tableau.='</tr>';
		for ($i=($pageCourante-1)*$maxLignesAffichees; $i < $maxLignesAffichees*$pageCourante; $i++)
		{
			$Tableau.='<tr>';
			for ($l=1; $l<=count($Entete); $l++)
			{
				$Tableau.='<td>';
				$Tableau.=$Contenu[$i][$Entete[$l]];
				$Tableau.='</td>';
			}
			$Tableau.='</tr>';
		}
		$Tableau.='</table>';
		return $Tableau;
	}
}
?>