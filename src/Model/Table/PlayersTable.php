<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;

class PlayersTable extends Table
{
    public function register($mail,$password){
        if($id_player=$this->find('all')
                ->select(['id'])
                ->where(['email =' => $mail])
                ->toArray()){
             
             return (0);
         }
         
         else{
             $newfighter=$this->newEntity();
             $newfighter->email=$mail;
             $newfighter->password=$password;
             $this->save($newfighter);
             return(1);
         }  
    }   
}
