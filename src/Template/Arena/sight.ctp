<div id="container">
	<div id="left_container">
	<div id="top_container">
	<p> se déplacer </p>
	<!--<?php // echo $this->Form->create(); ?>
	<?php 
	/*#define largeur (x) & longeur (y) of the arena:
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
	echo $this->Form->end(); */ // this part is for handling auto-click to fill, in case we have time to go back on the way we move & attack
	?> -->
	<form name="deplacement_droite" action="sight" method="post" accept-charset="utf-8">

		<ul>
                        
				<input type="hidden" name="process" value="move_x">
			
			<li>
				<label for="dep_x">Deplacement vers la droite </label>
				<input type="submit" value="Go">
			</li>
		</ul>
</form>

<form name="deplacement_gauche" action="sight" method="post" accept-charset="utf-8">

		<ul>
                        
				<input type="hidden" name="process" value="move_x1">
			
			<li>
				<label for="dep_x">Deplacement vers la gauche </label>
				<input type="submit" value="Go">
			</li>
		</ul>
</form>

<form name="deplacement_haut" action="sight" method="post" accept-charset="utf-8">

		<ul>
                        
				<input type="hidden" name="process" value="move_y">
			
			<li>
				<label for="dep_x">Deplacement vers le haut </label>
				<input type="submit" value="Go">
			</li>
		</ul>
</form>

<form name="deplacement_bas" action="sight" method="post" accept-charset="utf-8">

		<ul>
                        
				<input type="hidden" name="process" value="move_y1">
			
			<li>
				<label for="dep_x">Deplacement vers le bas </label>
				<input type="submit" value="Go">
			</li>
		</ul>
</form>
	</div>
	<div id="bottom_container">
	<?php 
		echo($perso[0]);
	?>
	</div>
	</div>
	<div id="right_container">
	<?php
	#define largeur (x) & longeur (y) of the arena:
	$x= 14;
	$y= 9;
	$nombre_de_ligne = 0;
	$nombre_de_colonne = 0;
	while ($nombre_de_colonne <= $y) {
		echo '<div class="gameblock_container">';	
		while ($nombre_de_ligne <= $x)
		{
		//objet divers // ecrit en dure mais a inserez dans surroundigs dans la bdd pour gerer les collisions
		if ($nombre_de_ligne==4 and $nombre_de_colonne==1) {
			echo '<div class="gameblock" id="gb';
    		echo $nombre_de_colonne;
    		echo '';
    		echo $nombre_de_ligne;
    		echo '" onclick="test(';
    		echo $nombre_de_colonne;
    		echo ',';
    		echo $nombre_de_ligne;
    		echo ')" style="background-color:red;"></div>';
		    $nombre_de_ligne++;
		}
		elseif ($nombre_de_ligne==2 and $nombre_de_colonne==2) {
			echo '<div class="gameblock" id="gb';
    		echo $nombre_de_colonne;
    		echo '';
    		echo $nombre_de_ligne;
    		echo '" onclick="test(';
    		echo $nombre_de_colonne;
    		echo ',';
    		echo $nombre_de_ligne;
    		echo ')" style="background-color:red;"></div>';
		    $nombre_de_ligne++;
		}
		//perso 0
		elseif ($perso[0]['coordinate_x']==$nombre_de_ligne and $perso[0]['coordinate_y']==$nombre_de_colonne) {
			echo '<div class="gameblock" id="gb';
    		echo $nombre_de_colonne;
    		echo '';
    		echo $nombre_de_ligne;
    		echo '" onclick="test(';
    		echo $nombre_de_colonne;
    		echo ',';
    		echo $nombre_de_ligne;
    		echo ')" style="background-color:green;"></div>';
		    $nombre_de_ligne++;
		}else{
    	echo '<div class="gameblock" id="gb';
    	echo $nombre_de_colonne;
    	echo '';
    	echo $nombre_de_ligne;
    	echo '" onclick="test(';
    	echo $nombre_de_colonne;
    	echo ',';
    	echo $nombre_de_ligne;
    	echo ')" style="background-color:grey;"></div>';
		    $nombre_de_ligne++;
		}}
		echo '</div>';
		$nombre_de_ligne = 0;
		$nombre_de_colonne++;
	}
	?>
	</div>
</div>
