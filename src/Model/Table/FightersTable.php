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
    
    
    public function moveFighter($coordonnee,$identifiant_move){
        if($identifiant_move == 1){
        $query = $this->query();
$query->update()
    ->set(['coordinate_x' => ($coordonnee+1)])
    ->execute();
        }
        
        if($identifiant_move == 2){
        $query = $this->query();
$query->update()
    ->set(['coordinate_x' => ($coordonnee-1)])
    ->execute();
        }
        
        if($identifiant_move == 3){
        $query = $this->query();
$query->update()
    ->set(['coordinate_y' => ($coordonnee+1)])
    ->execute();
        }
        
        if($identifiant_move == 4){
        $query = $this->query();
$query->update()
    ->set(['coordinate_y' => ($coordonnee-1)])
    ->execute();
        }
    }

}
