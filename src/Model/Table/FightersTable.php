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

    public function infoRecoverOthers($id){
	$fighters= \Cake\ORM\TableRegistry::get('Fighters');
	$info=$fighters->find('all', array('conditions'=>array('player_id !='=>$id)))->toArray();
        return($info);	
    }
    
    public function getPlayerId($name){
        $players= \Cake\ORM\TableRegistry::get('Players');
        $info=$players->find('all', array('conditions'=>array('email ='=>$name)))->toArray();
        return($info);
    }
    public function getAllPlayers($id){
        $players= \Cake\ORM\TableRegistry::get('Players');
        $info=$players->find('all', array('conditions'=>array('id !='=>$id)))->toArray();
        return($info);
    }
    public function ennemyRecover($id){
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
    public function attack($health,$strength,$ennemyId){
        $query = $this->query();
    $query->update()
    ->set(['current_health' => ($health-$strength)])
    ->where(['player_id' => $ennemyId])
    ->execute();
    }
    public function death(){
        $query = $this->query();
    $query->update()
    ->set(['current_health' => ($health-$strength)])
    ->where(['player_id' => $ennemyId])
    ->execute();
    }
    public function exp_atck($id,$current_xp){
    
        $query = $this->query();
    $query->update()
    ->set(['xp' => ($current_xp+1)])
    ->where(['player_id' => $id])
    ->execute();
    }

    public function exp_atck_dead($id,$current_xp,$level){
        $query = $this->query();
    $query->update()
    ->set(['xp' => ($current_xp+$level+1)])
    ->where(['player_id' => $id])
    ->execute();
    }

    public function addLevel($id,$level){
        $query = $this->query();
    $query->update()
    ->set(['level' => ($level+1)])
    ->where(['player_id' => $id])
    ->execute();
    }
	public function createNewFighter($name, $playerId, $coordinate_x, $coordinate_y)
	{
		$newFighter = $this->newEntity();
		
		$newFighter->name = $name;
		pr($newFighter->name);
		$newFighter->player_id = $playerId;
		$newFighter->coordinate_x = $coordinate_x;
		$newFighter->coordinate_y = $coordinate_y;
		$newFighter->level = 1;
		$newFighter->xp = 0;
		//$newFighter->skill_sight = mt_rand(1,10);
		//$newFighter->skill_strength = mt_rand(1,10);
		//$newFighter->skill_health = mt_rand(1,10);
		$newFighter->skill_sight = 0;
		$newFighter->skill_strength = 1;
		$newFighter->skill_health = 3;
		$newFighter->current_health = $newFighter->skill_health;
		$newFighter->guild_id = NULL;
		$this->save($newFighter);
		
	}
}
