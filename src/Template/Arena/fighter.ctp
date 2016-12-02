<?php $this->assign('title', 'titredepage');
?>
<?php echo $this->Html->script('fighter'); ?>


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
        	echo(" Vous etes au niveau ");
                echo($perso [0]['level']);
                ?>
    <div id="form1" class="hidden" >
                <form name="upgrade_level" action="fighter" method="post" accept-charset="utf-8">
                    <label>Augmentez votre niveau contre 4 XP -></label>
				<input type="hidden" name="process" value="level">
				<input type="submit" value="Upgrade">	
                </form>
    </div>
    
    <?php
                echo('Votre visée est de ');
                echo($perso[0]['skill_sight']);
                ?>
    <div id="form2" class="hidden">
                <form name="upgrade_skill_sight" action="fighter" method="post" accept-charset="utf-8">
				<input type="hidden" name="process" value="sight">
                                <label>Ameliorez votre visée contre 4 XP -></label>
                                <input  type="submit" value="Upgrade">	
                </form>
    </div>
    <?php
                echo("Votre force est de ");
                echo($perso[0]['skill_strength']);
                ?>
    <div id="form3" class="hidden">
                <form name="upgrade_skill_strenght" action="fighter" method="post" accept-charset="utf-8">
                            <label>Augmentez votre force contre 4 XP -></label>
				<input type="hidden" name="process" value="strenght">
				<input type="submit" value="Upgrade">	
                </form>
    </div>
    
    <?php
                echo("Votre santé est de ");
                echo($perso[0]['skill_health']);
                ?>
    <div id="form4" class="hidden">
                <form name="upgrade_skill_health" action="fighter" method="post" accept-charset="utf-8">
                            <label>Augmentez votre santé contre 4 XP -></label>
				<input type="hidden" name="process" value="health">
				<input type="submit" value="Upgrade">	
                </form>
    </div>
    <?php
                echo('Votre santé actuelle est de ');
                echo($perso[0]['current_health']);
                ?>
    <div id="form5" class="hidden">
                <form name="upgrade_skill_sight" action="fighter" method="post" accept-charset="utf-8">
                            <label>Augmentez votre santé actuelle contre 4 XP -></label>
				<input type="hidden" name="process" value="currenthealth">
				<input type="submit" value="Upgrade">	
                </form>
    </div>
    <?php
		
        
    
}
if(isset($nomguild[0]['name'])){
echo($nomguild[0]['name']);}
?>
</div>

<div id="div2" class="hidden">
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
if($nb_perso !=0){
    ?>
<script>showdiv1();</script>
<?php
if($perso[0]['xp']>3){
    ?>
<script>showform();</script>
<?php
}
}
else{
    ?>
    <script>showdiv2();</script>
    <?php
}
?>