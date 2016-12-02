
<div id="guild_create">
<h1 class="form_title">Create Guild</h1>
<?php echo $this->form->create('guild', array(
	'id'=>'CreateGuildForm',
	'url'=>array(
		'controller'=>'Arena',
		'action'=>'guild'
		     )
		));
?>
<?php echo $this->form->input('process', ['type'=>'hidden','value'=>'createGuild']); ?>
<div id="guildCreate">
<?php echo $this->form->input('guildName', array('label'=>"Name ",'size'=>30));?>
<?php echo $this->form->submit('Créer'); ?>
</div>
<?php echo $this->form->end(); ?>
</div>

<div  id="guild_join">
<h1 class="form_title">Join Guild</h1>

<?php
if($guilds != 'undef')
{
	$length = count($guilds);
	for($i=0; $i<$length;$i++)
	{
		echo $this->form->create('joinGuild', array(
	'id'=>'JoinGuildForm',
	'url'=>array(
		'controller'=>'Arena',
		'action'=>'guild'
		     )
		));
	        echo $this->form->input('process', ['type'=>'hidden','value'=>$guilds[$i]['id']]); 
		echo '<div class="guild">';
		echo "{$guilds[$i]['name']} {$this->form->submit('Join')}";
		echo '</div>';
		echo $this->form->end(); 
	}
}

else
{
	echo 'There is no existing guild.';
}
?>
</div>
