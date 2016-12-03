<?php $this->assign('title', 'titredepage');
?>
<?php echo $this->Html->script('fighter'); ?>
<?php //echo $this->Html->image('gladiator.jpg', ['alt' => 'CakePHP']); ?>

<div id="div1" class="hidden">
<?php 
echo '<img src="../webroot/img/gladiator.jpg" alt="avatar" width="100%" height="auto">';
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
                echo('Santé : ');
                echo($perso[0]['current_health']);
                echo '/';
                echo($perso[0]['skill_health']);
                ?>
    </br>
    <div id='first'>
        <?php
                echo('Visée : ');
                echo($perso[0]['skill_sight']);
                ?>
    </br>    
                <form class="marginL" name="upgrade_skill_sight" action="fighter" method="post" accept-charset="utf-8">
                    <?php if(isset($mavariable)){?>
				<input type="hidden" name="process" value="sight">
                                <input  type="submit" value="&#94;">	
                                <?php }?>
                </form>
    </div>
    <div id='scnd'>
    <?php
                echo("Force : ");
                echo($perso[0]['skill_strength']);
                ?>
    </br>
                <form class="marginL" name="upgrade_skill_strenght" action="fighter" method="post" accept-charset="utf-8">
                    <?php if(isset($mavariable)){?>
.				<input type="hidden" name="process" value="strenght">
				<input type="submit" value="&#94;">
                                <?php }?>
                </form>
    </div>
    <div id='third'>
    <?php
                echo("Santé max: ");
                echo($perso[0]['skill_health']);
                ?>
    </br>
                <form class="marginL" name="upgrade_skill_health" action="fighter" method="post" accept-charset="utf-8">
                    <?php if(isset($mavariable)){?>
				<input type="hidden" name="process" value="health">
                                
				<input type="submit" value="&#94;">
                                <?php }?>
                </form>

    </br>
    </div>
    <?php
		
        
    
}
if(isset($nomguild[0]['name'])){
echo "Guilde:";
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