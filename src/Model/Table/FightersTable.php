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
    public function addEvent_attack($time,$action,$x_pos,$y_pos){
        $Event= \Cake\ORM\TableRegistry::get('Events');
        $newEvent = $Event->newEntity();
        $newEvent->name = $action;
        $newEvent->date = $time;
        $newEvent->coordinate_x = $x_pos;
        $newEvent->coordinate_y = $y_pos;
        $Event->save($newEvent);
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
    
    public function getMessages($fighterId_source, $fighterId_destination){
	$messages= \Cake\ORM\TableRegistry::get('Messages');
	/*$info= $messages->find('all', array('conditions'=>array('fighter_id_from ='=>$fighterId_source, 'fighter_id ='=>$fighterId_destination)))->toArray();*/
	$info= $messages->find('all')
		->select(['message'])
		->where(['fighter_id_from ='=>$fighterId_source, 'fighter_id'=>$fighterId_destination])
		->orWhere(['fighter_id_from ='=>$fighterId_destination, 'fighter_id'=>$fighterId_source])
		->toArray();
	return ($info);
	
    }	
    
    public function setMessage($time, $title, $message, $fighter_id_from, $fighter_id){
	$messages = \Cake\ORM\TableRegistry::get('Messages');
	$newMessage = $messages->newEntity();
	$newMessage->date = $time;
	$newMessage->title = $title;
	$newMessage->message = $message;
	$newMessage->fighter_id_from = $fighter_id_from;
	$newMessage->fighter_id = $fighter_id;
	$messages->save($newMessage);
    }

    public function setGuildId($id, $fighterId){
	$query = $this->query();
	$query->update()
		->set(['guild_id'=>$id])
		->where(['id'=>$fighterId])
		->execute();
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
    public function lifeRecover($id,$health_max){
        $query = $this->query();
    $query->update()
    ->set(['current_health' => $health_max])
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
		$newFighter->skill_sight = 2;
		$newFighter->skill_strength = 1;
		$newFighter->skill_health = 3;
		$newFighter->current_health = $newFighter->skill_health;
		$newFighter->guild_id = NULL;
		$this->save($newFighter);
		
	}
        
        public function levelupdate($xp,$level,$id){
            $query = $this->query();
            $query->update()->set(['xp' => ($xp-4)])->where(['player_id' => $id])->execute();
            $query->update()->set(['level' => ($level+1)])->where(['player_id' => $id])->execute();
        }
        
        public function sightupdate($xp,$sight,$id){
            $query = $this->query();
            $query->update()->set(['xp' => ($xp-4)])->where(['player_id' => $id])->execute();
            $query->update()->set(['skill_sight' => ($sight+1)])->where(['player_id' => $id])->execute();
        }
        
        public function strenghtupdate($xp,$strenght,$id){
            $query = $this->query();
            $query->update()->set(['xp' => ($xp-4)])->where(['player_id' => $id])->execute();
            $query->update()->set(['skill_strength' => ($strenght+1)])->where(['player_id' => $id])->execute();
        }
       
        
        public function healthupdate($xp,$health,$id){
            $query = $this->query();
            $query->update()->set(['xp' => ($xp-4)])->where(['player_id' => $id])->execute();
            $query->update()->set(['skill_health' => ($health+3)])->where(['player_id' => $id])->execute();
        }
        
        public function currenthealthupdate($xp,$currenthealth,$id){
            $query = $this->query();
            $query->update()->set(['xp' => ($xp-4)])->where(['player_id' => $id])->execute();
            $query->update()->set(['current_health' => ($currenthealth+1)])->where(['player_id' => $id])->execute();
        }
}
