<div id="container">
	<div id="left_container">
	<div id="top_container">div1</div>
	<div id="bottom_container">div2</div>
	</div>
	<div id="right_container">
	<?php
	#define largeur (x) & longeur (y) of the arena:
	$x= 16;
	$y= 10;
	$nombre_de_ligne = 0;
	$nombre_de_colonne = 0;
	while ($nombre_de_colonne <= $y) {
		echo '<div class="gameblock_container">';	
		while ($nombre_de_ligne < $x)
		{
    	echo '<div class="gameblock ';
    	echo $nombre_de_colonne;
    	echo ' ';
    	echo $nombre_de_ligne;
    	echo ' "></div>';
		    $nombre_de_ligne++;
		}
		echo '</div>';
		$nombre_de_ligne = 0;
		$nombre_de_colonne++;
	}
	echo $this->request->params['pass'][0];
	?>
	</div>
</div>