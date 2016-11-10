<div id="container">
	<div id="left_container">
	<div id="top_container">
	<p> se déplacer </p>
	<?php echo $this->Form->create(); ?>
	<?php 
	#define largeur (x) & longeur (y) of the arena:
	$x= 15;
	$y= 10;
	if (isset($this->request->params['pass'][0])){
		$valuex = $this->request->params['pass'][0];
	}else{
		$valuex = "";
	}
	if (isset($this->request->params['pass'][1])){
		$valuey = $this->request->params['pass'][1];
	}else{
		$valuey = "";
	}
	echo $this->Form->input('position x', [
		'type' => 'number',
		'min' => 1,
		'max' => $x,
		'value' => $valuey
	]);
	echo $this->Form->input('position y', [
		'type' => 'number',
		'min' => 1,
		'max' => $y,
		'value' => $valuex
	]);
	echo $this->Form->submit();
	echo $this->Form->end(); 
	?>
	</div>
	<div id="bottom_container">
	div2
	</div>
	</div>
	<div id="right_container">
	<?php
	#define largeur (x) & longeur (y) of the arena:
	$x= 15;
	$y= 10;
	$nombre_de_ligne = 1;
	$nombre_de_colonne = 1;
	while ($nombre_de_colonne <= $y) {
		echo '<div class="gameblock_container">';	
		while ($nombre_de_ligne <= $x)
		{
    	echo '<div class="gameblock ';
    	echo $nombre_de_colonne;
    	echo ' ';
    	echo $nombre_de_ligne;
    	echo ' " onclick="test(';
    	echo $nombre_de_colonne;
    	echo ',';
    	echo $nombre_de_ligne;
    	echo ')"></div>';
		    $nombre_de_ligne++;
		}
		echo '</div>';
		$nombre_de_ligne = 1;
		$nombre_de_colonne++;
	}
	?>
	</div>
</div>