<div id="container">
	<div id="left_container">
	<div id="top_container">div1</div>
	<div id="bottom_container">div2</div>
	</div>
	<div id="right_container">
	<?php
	$nombre_de_ligne = 1;
	$nombre_de_colonne = 1;
	while ($nombre_de_colonne <= 11) {
		echo '<div class="gameblock_container 1">';	
		while ($nombre_de_ligne < 16)
		{
    	echo '<div class="gameblock"></div>';
		    $nombre_de_ligne++;
		}
		echo '</div>';
		$nombre_de_ligne = 1;
		$nombre_de_colonne++;
	}
	echo "$this->request->params(1)"
	?>
	</div>
</div>