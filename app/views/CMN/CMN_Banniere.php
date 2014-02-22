<div id="Banniere">
	</div>
	<div id="en_tete">
		<h1>Fancham</h1>
	</div>
	<div id="accueil2">
			<img src="<?php echo $this->asset('assets/images/Frise.png') ?>" border="0"/>
	</div>
	<div id="accueil1">
			<form id="Accueil" action="<? echo $PathFull_C_PP; ?>" method="post">
				<input type="hidden" name="C_Demande" value="IHM"/>
				<input type="hidden" name="PageDemande" value="Acceuil"/>
			</form>
			<a href='#' onclick='document.getElementById("Accueil").submit()'><img src="<?php echo $this->asset('assets/images/Accueil.png') ?>"  onMouseOver="this.src='<?php echo $this->asset('assets/images/Accueil2.png') ?>'" onMouseOut="this.src='<?php echo $this->asset('assets/images/Accueil.png') ?>'" alt="Accueil" border="0"/> </a>
	</div>
	<div id="navi1">
			<form id="Arriere" action="<? echo $PathFull_C_PP; ?>" method="post">
				<input type="hidden" name="C_Demande" value="IHM"/>
				<input type="hidden" name="PageDemande" value="Arriere"/>
			</form>
			<a href='#' onclick='document.getElementById("Arriere").submit()'><img src="<?php echo $this->asset('assets/images/Arriere.png') ?>"  onMouseOver="this.src='<?php echo $this->asset('assets/images/Arriere2.png') ?>'" onMouseOut="this.src='<?php echo $this->asset('assets/images/Arriere.png') ?>'" alt="Page précédente" border="0"/> </a>
	</div>
	<div id="navi2">
			<form id="Deconnexion" action="<? echo $PathFull_C_PP; ?>" method="post">
				<input type="hidden" name="C_Demande" value="IHM"/>
				<input type="hidden" name="PageDemande" value="Deconnexion"/>
			</form>
			<a href='#' onclick='document.getElementById("Deconnexion").submit()'><img src="<?php echo $this->asset('assets/images/Avant.png') ?>" onMouseOver="this.src='<?php echo $this->asset('assets/images/Avant2.png') ?>'" onMouseOut="this.src='<?php echo $this->asset('assets/images/Avant.png') ?>'" alt="Page suivante" border="0"/> </a>
	</div>