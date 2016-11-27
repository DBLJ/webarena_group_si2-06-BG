<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;

class FightersTable extends Table
{
    public function connexion($email,$motdepasse){

         $fighters= \Cake\ORM\TableRegistry::get('Players');
         if($id_player=$fighters->find('all')
                ->select(['id'])
                ->where(['email =' => $email,'password =' =>$motdepasse])
                ->toArray()){
             
             return $id_player[0];
         }
         
         else{
             return(0);
         }     
    }
    
    public function infoRecover($id){
        $fighters= \Cake\ORM\TableRegistry::get('Fighters');
        $info=$fighters->find('all', array('conditions'=>array('player_id ='=>$id)))->toArray();
        return($info);
    }
    
    public function guildrecover($idguild){
        $guild= \Cake\ORM\TableRegistry::get('Guilds');
        $info=$guild->find('all', array('conditions'=>array('id ='=>$idguild)))->toArray();
        return($info);
    }
    
    
    public function moveFighter($coordonnee,$identifiant_move, $sessionId){
	
        if($identifiant_move == 1){
        $query = $this->query();
$query->update()
    ->set(['coordinate_x' => ($coordonnee+1)])
    ->where(['player_id' => $sessionId])
    ->execute();
        }
        
        if($identifiant_move == 2){
        $query = $this->query();
$query->update()
    ->set(['coordinate_x' => ($coordonnee-1)])
    ->where(['player_id' => $sessionId])
    ->execute();
        }
        
        if($identifiant_move == 3){
        $query = $this->query();
$query->update()
    ->set(['coordinate_y' => ($coordonnee+1)])
    ->where(['player_id' => $sessionId])
    ->execute();
        }
        
        if($identifiant_move == 4){
        $query = $this->query();
$query->update()
    ->set(['coordinate_y' => ($coordonnee-1)])
    ->where(['player_id' => $sessionId])
    ->execute();
        }
    }
	public function createNewFighter($name, $playerId)
	{
		$newFighter = $this->newEntity();
		
		$newFighter->name = $name;
		pr($newFighter->name);
		$newFighter->player_id = $playerId;
		$newFighter->coordinate_x = 0;
		$newFighter->coordinate_y = 0;
		$newFighter->level = 1;
		$newFighter->xp = 0;
		$newFighter->skill_sight = mt_rand(1,10);
		$newFighter->skill_strength = mt_rand(1,10);
		$newFighter->skill_health = mt_rand(1,10);
		$newFighter->current_health = $newFighter->skill_health;
		$newFighter->guild_id = NULL;
		$this->save($newFighter);
		
	}
    public function createSurround(){
        $surround= \Cake\ORM\TableRegistry::get('surroundings');
        $surround->deleteAll(array('1 = 1')); //purge db in case
        $newSurround = $surround->newEntity();
        $newSurround->type="arbre";
        $newSurround->coordinate_x =2;
        $newSurround->coordinate_y=2;
        $surround->save($newSurround);
    }
}
