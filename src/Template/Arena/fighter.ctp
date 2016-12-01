<?php $this->assign('title', 'titredepage');
?>
<?php echo $this->Html->script('fighter'); ?>
<?php 
if($nb_perso !=0){
    ?>
<script>showdiv1();</script>
<?php } ?>


<div id="div1" class="hidden">
<?php 
echo ("Votre personnage :");
echo '<br>';
if($nb_perso != 0)
{
	for($i=0;$i<$nb_perso;$i++){
        	echo ($perso[$i]['name']);
        	echo(" au niveau");
        	echo($perso [$i]['level']);
        	echo '<br>';
		}
        
    
}
echo($nomguild[0]['name']);
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
<?php }
else{
    ?>
    <script>showdiv2();</script>
    <?php
}
?>