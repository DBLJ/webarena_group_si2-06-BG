
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
if ($test) {
	if ($test[0]['guild_id']) {	
			$i =$test[0]['guild_id']-1;
			echo '<p style="text-align:center;"> Votre guilde :';
                        if(isset($guildinfo[0]['name']));
                        {
                            echo($guildinfo[0]['name']);
                        }
                        if(isset($guilds[$i]['name'])){
                        echo $guilds[$i]['name'];}
			echo '</p>';
			}
		}
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
