<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;

class GuildsTable extends Table
{

	public function getGuilds(){
		$guilds = \Cake\ORM\TableRegistry::get('Guilds');
		$info = $guilds->find('all')->toArray();
		return $info;
	}

	public function existsGuildSameName($name){
		$guilds = \Cake\ORM\TableRegistry::get('Guilds');
		$info= $guilds->find('all', array('conditions'=>array('name ='=>$name)))->toArray();
		if($info)
			return true;
		
		else
			return false;
	}

	public function setGuild($name){
		$guild = $this->newEntity();
		$guild->name = $name;
		$this->save($guild);
		return $guild->id;
	}





}
