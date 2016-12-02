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
	/*echo $x_attack;
	echo $y_attack;*/
	for ($i=0; $i < count($playerList); $i++) { 
	echo '<form name="playerForm" action="sight" method="post" accept-charset="utf-8">' ;
	echo '<ul>' ;
	echo '<input type="hidden" name="process" value="choosePlayer">' ;
	echo '<li>' ;
	echo '<input name="playerName" type="submit" value="' ;
	echo $playerList[$i]['email'] ;
	echo '">' ;
	echo '</li>' ;
	echo '</ul>' ;
	echo '</form>' ;
	}
	?>
	
	<!--
		<ul>
				<input type="hidden" name="process" value="choosePlayer">
			
			<li>
				<input name="playerName" type="submit" value="admin@test.com">
			</li>
		</ul>
		</form>-->
	<?php 
		
	?>
	</div>
	</div>

	<div id="chat_container">
		<div id="discussion">
		<?php
		if($messages == 'undef'){
		echo '<p> choisir un joueur</p>';
		}else{
			$length = count($messages);
		for($i=$length-1; $i>=0; $i--)
		{
			echo '<p>'.$messages[$i]['message'].'</p>';
		}
		}
		?>
		</div>

		<div id="input_field">
			<form name="chat_form" action="sight" method="post" accept-charset="utf-8">
			
			<input type="hidden" name="process" value="send">
			<input type="text" name="title" size="20" placeholder="Titre">
			<textarea name="message" rows=2 cols=30 placeholder="Entrez votre message ici"></textarea>
			<input type="submit" value="envoyer">
			
			</form>
		</div>
	</div>

	<div id="right_container">
	<?php
	#define largeur (x) & longeur (y) of the arena:
	$x= 14;
	$y= 9;
	$nombre_de_ligne = 0;
	$nombre_de_colonne = 0;

	if ($choosenPlayer) {
	if ($ennemy){
	while ($nombre_de_colonne <= $y) {
		echo '<div class="gameblock_container">';	
		while ($nombre_de_ligne <= $x)
		{
		//perso 0

		if ($perso[0]['coordinate_x']==$nombre_de_ligne and $perso[0]['coordinate_y']==$nombre_de_colonne) {
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
		}
		elseif (($ennemy[0]['coordinate_x']==$nombre_de_ligne and $ennemy[0]['coordinate_y']==$nombre_de_colonne and abs($nombre_de_ligne-$perso[0]['coordinate_x'])+abs($nombre_de_colonne-$perso[0]['coordinate_y'])<=$perso[0]['skill_sight'])){
			echo '<div class="gameblock" id="gb';
    		echo $nombre_de_colonne;
    		echo '';
    		echo $nombre_de_ligne;
    		echo '" onclick="test(';
    		echo $nombre_de_colonne;
    		echo ',';
    		echo $nombre_de_ligne;
    		echo ')" style="background-color:yellow;"></div>';
		    $nombre_de_ligne++;
		}
		elseif (abs($nombre_de_ligne-$perso[0]['coordinate_x'])+abs($nombre_de_colonne-$perso[0]['coordinate_y'])<=$perso[0]['skill_sight']) {
			echo '<div class="gameblock" id="gb';
    	echo $nombre_de_colonne;
    	echo '';
    	echo $nombre_de_ligne;
    	echo '" onclick="test(';
    	echo $nombre_de_colonne;
    	echo ',';
    	echo $nombre_de_ligne;
    	echo ')" style="background-color:darkgrey;"></div>';
		    $nombre_de_ligne++;
		}
		else{
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
	}else{
		echo "ce joueur n'a pas de combattants, selectionnez-en un autre :)";
	}
}else{
	echo "veuillez selectionner un joueur";
}
	?>
	</div>
</div>
