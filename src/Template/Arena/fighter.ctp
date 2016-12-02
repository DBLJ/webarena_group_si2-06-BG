<?php $this->assign('title', 'titredepage');
?>
<?php echo $this->Html->script('fighter'); ?>
<?php //echo $this->Html->image('gladiator.jpg', ['alt' => 'CakePHP']); ?>

<div id="div1" class="hidden">
<?php 
echo ("Votre personnage");
echo '<br>';
if($nb_perso != 0)
{
	
        	echo ($perso[0]['name']);
                
                ?>
    </br>
    <?php
        	echo("Niveau : ");
                echo($perso [0]['level']);
                ?>
    </br>
    <div id="form1" class="hidden">               
    </div>
    
    <?php
                echo('Visée : ');
                echo($perso[0]['skill_sight']);
                ?>
    </br>
        <?php
                echo('Santé actuelle : ');
                echo($perso[0]['current_health']);
                ?>
    </br>    
                <form name="upgrade_skill_sight" action="fighter" method="post" accept-charset="utf-8">
                    <?php if(isset($mavariable)){?>
				<input type="hidden" name="process" value="sight">
                                <label>Ameliorez votre visée </label>
                                <input  type="submit" value="Upgrade">	
                                <?php }?>
                </form>
    
    <?php
                echo("Force : ");
                echo($perso[0]['skill_strength']);
                ?>
    </br>
                <form name="upgrade_skill_strenght" action="fighter" method="post" accept-charset="utf-8">
                    <?php if(isset($mavariable)){?>
                            <label>Augmentez votre force </label>
				<input type="hidden" name="process" value="strenght">
				<input type="submit" value="Upgrade">
                                <?php }?>
                </form>
    
    <?php
                echo("Santé : ");
                echo($perso[0]['skill_health']);
                ?>
    </br>
                <form name="upgrade_skill_health" action="fighter" method="post" accept-charset="utf-8">
                    <?php if(isset($mavariable)){?>
                            <label>Augmentez votre santé </label>
				<input type="hidden" name="process" value="health">
                                
				<input type="submit" value="Upgrade">
                                <?php }?>
                </form>

    </br>
    
    <?php
		
        
    
}
if(isset($nomguild[0]['name'])){
echo($nomguild[0]['name']);}
?>
</div>

<div id="div2" class="hidden">
    <h3>Créez votre combattant</h3>
<?php echo $this->form->create('fighter', array(
	'id'=>'CreateFighterForm',
	'url'=>array(
		'controller'=>'Arena',
		'action'=>'fighter'
		     )
		));
?>

<?php echo $this->form->input('fighterName', array('label'=>"Fighter : ",'size'=>15));?>
<?php echo $this->form->submit('Submit'); ?>
<?php echo $this->form->end(); ?>
</div>
<?php 
if(isset($nb_perso)){
if($nb_perso !=0){
    ?>
<script>showdiv1();</script>
<?php
}}
else{
    ?>
    <script>showdiv2();</script>
    <?php
}
?>