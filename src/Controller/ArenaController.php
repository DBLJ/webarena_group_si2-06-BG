<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Utility\Security;

/**
 * Personal Controller
 * User personal interface
 *
 */
class ArenaController extends AppController {


    public function login() {
	
    	if($this->request->session()->check('Session.id')){
    		$this->set('isconnected',true);
		$this->redirect("/Arena/fighter");
    	}else{
    		$this->set('isconnected',false);
    	}

        if ($this->request->is('post')) {
        	
        	if ($this->request->data['process'] == 'googleLogin') {
        		if ($this->request->data['getLogin']) {
        			$this->loadModel('Players');
        			$this->loadModel('Fighters');
        			$testgg = $this->Fighters->connexion($this->request->data['getLogin'], "XVzrtA10iTrFG");
                	if ($testgg['id'] == 0) {
                    	$this->Players->register($this->request->data['getLogin'],"XVzrtA10iTrFG");
                    	$testafterreg=$this->Fighters->connexion($this->request->data['getLogin'], "XVzrtA10iTrFG");
                    	$k = $testgg['id'];
                    	$this->request->Session()->write('Session.id', $k);
                    	$this->redirect("/Arena/fighter");
                	} else {
                    	$j = $testgg['id'];
                    	$this->request->Session()->write('Session.id', $j);
                    	$this->redirect("/Arena/fighter");
                	}
        			
        		}else{
        			$this->redirect("/Arena/login");
        		}
        		
        	}
            elseif ($this->request->data['process'] == 'login') {
                $this->loadModel('Fighters');
                $mail = $this->request->data['usermail'];
                $password = $this->request->data['password'];
                $cryptpassword = Security::hash($this->request->data['password']); 

                $test = $this->Fighters->connexion($mail, $cryptpassword);

                if (!$test['id']) {

                    $this->redirect("/Arena/login");
                } else {
                    $i = $test['id'];
                    $this->request->Session()->write('Session.id', $i);
                    $this->redirect("/Arena/fighter");
                }
                //jdkqsjdls
            } 
            
            elseif ($this->request->data['process'] == 'register') {
                $this->loadModel('Players');
                $this->loadModel('Fighters');
$mail = $this->request->data['email'];
$password = $this->request->data['password'];
                if (strlen($this->request->data['password']) > 6) {
                    $cryptpassword = Security::hash($this->request->data['password']);
                    $indic = $this->Players->register($this->request->data['email'], $cryptpassword);
                    if ($indic) {
                        $test = $this->Fighters->connexion($mail, $cryptpassword);
                        $i = $test['id'];
                        $this->request->Session()->write('Session.id', $i);
                        $this->redirect("/Arena/fighter");
                        echo('Vous etes inscrit et maintenant connecté');
                    }
                } else {
                    echo("Entrez un mot de passe avec plus de 6 caractères");
                    $this->redirect("/Arena/login");
                }
            }
        }
    }

    public function logout(){
    if($this->request->session()->check('Session.id')){
    		$this->set('isconnected',true);
    	}else{
    		$this->set('isconnected',false);
    	}
	if($this->request->session()->check('Session.id'))
	{
		$this->request->session()->destroy();
		$this->redirect("/Arena/login");
	}
	else
		$this->redirect("/Arena/login");
    }

    public function fighter() {
	$checkPosition = 1;
	$i = 0;
	if($this->request->session()->check('Session.id')){
    		$this->set('isconnected',true);
    	}else{
    		$this->set('isconnected',false);
    	}
        if ($this->request->session()->check('Session.id')) {
            $this->loadModel('Fighters');
            $info = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
            if ($info) {
                 
                $nb_perso = 0;
                foreach ($info as $value) {
                    $nb_perso++;
                }
                if($info[0]['xp']>3){
                    $this->set('mavariable',true);
                }
                $this->set('perso', $info);
                $this->set('nb_perso', $nb_perso);

                if ($info[0]['guild_id']) {

                    $tab = $this->Fighters->guildrecover($info[0]['guild_id']);
                    if($tab){
                    $this->set('nomguild', $tab);}
                }
            $infoForNext = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
                    $this->request->Session()->write('xp_actuel',$infoForNext[0]['xp']);
                    
                    if($this->request->is('post')){
                     
                        if($this->request->data['process'] == 'level'){
                        if(($info[0]['xp'])>3){
                            
                            $this->Fighters->levelupdate($info[0]['xp'],$info[0]['level'],$this->request->Session()->read('Session.id'));
                            $this->redirect("/Arena/fighter");
                        }
                    }
                    if($this->request->data['process'] == 'sight'){
                        if(($info[0]['xp'])>3){                           
                            $this->Fighters->sightupdate($info[0]['xp'],$info[0]['skill_sight'],$this->request->Session()->read('Session.id'));
                            $this->redirect("/Arena/fighter");
                        }
                    }
                    if($this->request->data['process']=='strenght'){
                        if(($info[0]['xp'])>3){                           
                            $this->Fighters->strenghtupdate($info[0]['xp'],$info[0]['skill_strength'],$this->request->Session()->read('Session.id'));
                            $this->redirect("/Arena/fighter");
                        }
                    }
                    if($this->request->data['process']=='health'){
                        if(($info[0]['xp'])>3){                           
                            $this->Fighters->healthupdate($info[0]['xp'],$info[0]['skill_health'],$this->request->Session()->read('Session.id'));
                            $this->redirect("/Arena/fighter");
                        }
                    }
                    if($this->request->data['process']=='currenthealth'){
                        if(($info[0]['xp'])>3){                           
                            $this->Fighters->currenthealthupdate($info[0]['xp'],$info[0]['current_health'],$this->request->Session()->read('Session.id'));
                            $this->redirect("/Arena/fighter");
                        }
                    }
                    }

            } else {	
                
		if($this->request->is('post'))	
		{
                    
			$info = $this->Fighters->infoRecoverOthers($this->request->session()->read('Session.id'));
			$length = count($info);
			while(($i < $length) | ($checkPosition == 0))
			{
				$position_x = mt_rand(0,14);
				$position_y = mt_rand(0,9);
                                
				for($i=0;$i < $length ; $i++)
				{
					if(($position_x == $info[$i]['coordinate_x']) && ($position_y == $info[$i]['coordinate_y']))
					{
						$checkPosition = 0;
						break;
					}
				}
			}
			$name = $this->request->data['fighterName'];
			$playerId = $this->request->Session()->read('Session.id');
			$this->Fighters->createNewFighter($name, $playerId, $position_x, $position_y);
			$this->redirect("/Arena/fighter");
                
                    
                    
                                        }
            }
        } else {
            $this->redirect("/Arena/login");
        }
    }

    public function sight() {

	$this->loadModel('Fighters');
	if($this->request->session()->check('Session.id')){
    		$this->set('isconnected',true);
    	}else{
    		$this->set('isconnected',false);
    		$this->redirect("/arena/login");
    	}
    if($this->request->session()->check('Session.id')){
	$sessionId = $this->request->session()->read('Session.id');
	$infoFighter = $this->Fighters->infoRecover($sessionId);
	$infoFighterId = $infoFighter[0]['id'];
	$this->set('fighterId', $infoFighterId);
	}
	$infoMessage=$this->request->session()->read('choosenPlayer');
	if($infoMessage)
	{
		$player_id_from = $this->request->session()->read('Session.id');
		$player_id_to = $this->request->session()->read('choosenPlayer'); 
		$this->loadModel('Fighters');
		$fighter_from = $this->Fighters->infoRecover($player_id_from);
		$fighter_to = $this->Fighters->infoRecover($player_id_to);
		$id_from = $fighter_from[0]['id'];
		if ($fighter_to) {
			$id_to = $fighter_to[0]['id'];
		}else{
			$id_to = null;
		}
		
		//if ($this->Fighters->getMessages($id_from, $id_to)){
		$messages = $this->Fighters->getMessages($id_from, $id_to);
		$this->set('messages', $messages);	
		//}
		
    	}else{
			$this->set('messages', 'undef');			
		}

    	if ($this->request->session()->check('Session.id')) {
    		$this->loadModel('Fighters');
            $info = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
            //if ($info) {

    		//test
    	$this->loadModel('Fighters');
    	$info = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));	
    	if ($this->request->params['pass']) {
    		$this->loadModel('Fighters');

    		if ($this->Fighters->infoRecover($this->request->session()->read('Session.id'))) {
    			$info = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
    		}else{
    			$info = null;
    		}
    		
    		if ($this->Fighters->ennemyRecover($this->request->session()->read('choosenPlayer'))) {
    			$info2 = $this->Fighters->ennemyRecover($this->request->session()->read('choosenPlayer'));
    		}else{
    			$info2 = null;
    		}

    		
    	/*$this->set('x_attack', $this->request->params['pass'][0]);
    	$this->set('y_attack', $this->request->params['pass'][1]);
    	}else{
    	$this->set('x_attack', null);
    	$this->set('y_attack', null);*/ 
    	
    	// partie attaque
    	if ($info2[0]['coordinate_x']==$this->request->params['pass'][1]) {
    	  			if ($info2[0]['coordinate_y']==$this->request->params['pass'][0]) {
    	  				if ($info[0]['coordinate_x']==$this->request->params['pass'][1] or $info[0]['coordinate_x']+1==$this->request->params['pass'][1] or $info[0]['coordinate_x']-1==$this->request->params['pass'][1]) {
    	  					if ($info[0]['coordinate_y']==$this->request->params['pass'][0] or $info[0]['coordinate_y']+1==$this->request->params['pass'][0] or $info[0]['coordinate_y']-1==$this->request->params['pass'][0]) {
    	  						
    	  	if (rand(1,20)>10 + $info2[0]['level'] - $info[0]['level']) {
    	  			echo "vous reussissez votre attaque";
    	  			$today = date("Y-m-d H:i:s");
    	  			$fname = $info[0]['name'];
    	  			$ename = $info2[0]['name'];
    	  			$pos_x = $info[0]['coordinate_x'];
    	  			$pos_y =$info[0]['coordinate_y'];
    	  			$action = "$fname attaque $ename et le touche !";
    	  			$this->Fighters->addEvent_attack($today,$action,$pos_x,$pos_y);
    	  			$this->Fighters->exp_atck($info[0]['player_id'],$info[0]['xp']);
    	  			$ally =$this->Fighters->count_ally($info[0]['guild_id'],$info[0]['player_id']);
    	  			if ($ally) {
    	  				$force_final = $info[0]['skill_strength'] + count($ally);
    	  			}else{
    	  				$force_final = $info[0]['skill_strength'] ;
    	  			}
    	  			$this->Fighters->attack($info2[0]['current_health'],$force_final,$info2[0]['player_id']);
    	  			if ($info2[0]['current_health']-1 <= 0) {
    	  				$this->Fighters->exp_atck_dead($info[0]['player_id'],$info[0]['xp'],$info2[0]['level']);
    	  				$dead=$this->Fighters->get($info2[0]['id']);
    	  				$this->Fighters->delete($dead);
    	  			}



    	  	}else{
    	  			echo "vous ratez votre attaque";
    	  			$today = date("Y-m-d H:i:s");
    	  			$fname = $info[0]['name'];
    	  			$ename = $info2[0]['name'];
    	  			$pos_x = $info[0]['coordinate_x'];
    	  			$pos_y =$info[0]['coordinate_y'];
    	  			$action = "$fname attaque $ename et rate son attaque !";
    	  			$this->Fighters->addEvent_attackFail($today,$action,$pos_x,$pos_y);

    	  	}		
    		
    	}else{
    		echo "Error: raté: vous êtes trop loin de la cible";
    	}
    	}else{
    		echo "Error: raté: vous êtes trop loin de la cible";
    	}
    	}else{
    		echo "Error: raté: vous êtes trop loin de la cible";
    	}
    	}
    	$test = $this->request->session()->read('xp_actuel');  		
    	if ($info[0]['xp']-$test>= 4) { // check if level up 
    	  				echo " level up ! augmentez vos caracteristiques dans l'onglet combattants";
    	  				$this->Fighters->addLevel($info[0]['player_id'],$info[0]['level']);
    	  				$this->Fighters->lifeRecover($info[0]['player_id'],$info[0]['skill_health']);
    	  				$this->request->session()->write('xp_actuel',$info[0]['xp']);
    	  			} 
    	}


    	//
            $this->loadModel('Fighters');
            $info = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
            $info2 = $this->Fighters->ennemyRecover($this->request->session()->read('choosenPlayer'));
            $info4 = $this->Fighters->getAllPlayers($this->request->session()->read('Session.id'));
            if ($this->request->session()->read('choosenPlayer')) { //if no choosenplayer set to null
            $info3 = $this->set('choosenPlayer',$this->request->session()->read('choosenPlayer'));
            }else{
            	$info3=null;
            }
            //$test = $this->request->session()->read('test');
            if ($info) {
                $this->set('perso', $info);
                $this->set('ennemy',$info2);
                $this->set('choosenPlayer',$info3);
                $this->set('playerList',$info4);
            }
            

        if ($this->request->is('post')) {

            $this->loadModel('Fighters');
            $info = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
	    	$sessionId = $this->request->session()->read('Session.id');


            if ($this->request->data['process'] == "move_x") {
                if ($info[0]['coordinate_x'] < 14){
                 if ($info[0]['coordinate_x']+1!=$info2[0]['coordinate_x'] or $info[0]['coordinate_y']!=$info2[0]['coordinate_y']) {
                    $today = date("Y-m-d H:i:s");
    	  			$fname = $info[0]['name'];
    	  			$pos_x = $info[0]['coordinate_x'];
    	  			$pos_y =$info[0]['coordinate_y'];
    	  			$action = "$fname se déplace vers la droite";
    	  			$this->Fighters->addEvent_move($today,$action,$pos_x,$pos_y);
                    $this->Fighters->moveFighter($info[0]['coordinate_x'],1,$sessionId);
            		$this->redirect("/Arena/sight");

                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement:" ;  
                	echo " un ennemi est sur votre route";             	
                }
            	}else{
                	echo "Error: vous ne pouvez pas faire ce mouvement:" ;
                	echo " vous sortez de l'arene" ;              	
                }
            }

            if ($this->request->data['process'] == "move_x1") {
                if ($info[0]['coordinate_x'] > 0) {
                	if ($info[0]['coordinate_x']-1!=$info2[0]['coordinate_x'] or $info[0]['coordinate_y']!=$info2[0]['coordinate_y']) {
                    $today = date("Y-m-d H:i:s");
    	  			$fname = $info[0]['name'];
    	  			$pos_x = $info[0]['coordinate_x'];
    	  			$pos_y =$info[0]['coordinate_y'];
    	  			$action = "$fname se déplace vers la gauche";
    	  			$this->Fighters->addEvent_move($today,$action,$pos_x,$pos_y);
                    $this->Fighters->moveFighter($info[0]['coordinate_x'],2,$sessionId);
            		$this->redirect("/Arena/sight");
                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement:" ;  
                	echo " un ennemi est sur votre route";             	
                }
                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement:";
                	echo " vous sortez de l'arene" ;
                }
            }

            if ($this->request->data['process'] == "move_y1") {
                if ($info[0]['coordinate_y'] < 9) {
                	if ($info[0]['coordinate_x']!=$info2[0]['coordinate_x'] or $info[0]['coordinate_y']+1!=$info2[0]['coordinate_y']) {
                    $today = date("Y-m-d H:i:s");
    	  			$fname = $info[0]['name'];
    	  			$pos_x = $info[0]['coordinate_x'];
    	  			$pos_y =$info[0]['coordinate_y'];
    	  			$action = "$fname se déplace vers le bas";
    	  			$this->Fighters->addEvent_move($today,$action,$pos_x,$pos_y);
                    $this->Fighters->moveFighter($info[0]['coordinate_y'],3,$sessionId);
            		$this->redirect("/Arena/sight");

                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement:" ;  
                	echo " un ennemi est sur votre route";             	
                }
                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement:";
                	echo " vous sortez de l'arene" ;
                }
            }

            if ($this->request->data['process'] == "move_y") {
                if ($info[0]['coordinate_y'] > 0) {
                	if ($info[0]['coordinate_x']!=$info2[0]['coordinate_x'] or $info[0]['coordinate_y']-1!=$info2[0]['coordinate_y']) {
                    $today = date("Y-m-d H:i:s");
    	  			$fname = $info[0]['name'];
    	  			$pos_x = $info[0]['coordinate_x'];
    	  			$pos_y =$info[0]['coordinate_y'];
    	  			$action = "$fname se déplace vers le haut";
    	  			$this->Fighters->addEvent_move($today,$action,$pos_x,$pos_y);
                    $this->Fighters->moveFighter($info[0]['coordinate_y'],4,$sessionId);
            		$this->redirect("/Arena/sight");

                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement:" ;  
                	echo " un ennemi est sur votre route";             	
                }
                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement:";
                	echo " vous sortez de l'arene" ;
                }
            }

            if ($this->request->data['process'] == "choosePlayer") { //getPlayerid to get the ennemy on map
            	$request=$this->request->data['playerName'];
            	$playerName=$this->Fighters->getPlayerId($request);
            	/*if ($playerName) {
            		$this->Fighters->set('test',$playerName);
            		$this->redirect("/Arena/sight");
            	}*/
            	//$this->request->Session()->write('test', 1);  
            	
            	$this->request->Session()->write('choosenPlayer',$playerName[0]['id'] );
            	$this->set('choosenPlayer',$playerName[0]['id']);
            	$this->redirect("/Arena/sight"); // counter bug when user have to double clic to see the map appear
            }
	
	    if($this->request->data['process'] == "send"){
	    	if ($this->request->data['send'] == "envoyer") {
	    		# code...
	    	
		$infoMessage=$this->request->session()->read('choosenPlayer');
		if($infoMessage){
		$this->loadModel('Fighters');
		$message = $this->request->data['message'];
		$title = $this->request->data['title'];
		//$fighter_id_from = $this->request->session()->read('Session.id');
		//$fighter_id = $this->request->session()->read('choosenPlayer');
		$fighter_id_from = $id_from;
		$fighter_id = $id_to;
		$time = Time::now();
		if(($fighter_id)){
			$this->Fighters->setMessage($time, $title, $message, $fighter_id_from, $fighter_id);
			$this->redirect("/Arena/sight");
		}
		}
	    }elseif ($this->request->data['send'] == "crier") {
	    	$infoMessage=$this->request->session()->read('choosenPlayer');
		if($infoMessage){
		$this->loadModel('Fighters');
		$message = $this->request->data['message'];
		$title = "shouted";
		//$fighter_id_from = $this->request->session()->read('Session.id');
		//$fighter_id = $this->request->session()->read('choosenPlayer');
		$fighter_id_from = $id_from;
		$fighter_id = $id_to;
		$time = Time::now();
		if(($fighter_id)){
			$this->Fighters->setMessage($time, $title, $message, $fighter_id_from, $fighter_id);
			$today = date("Y-m-d H:i:s");
    	  			$fname = $info[0]['name'];
    	  			$ename = $info2[0]['name'];
    	  			$pos_x = $info[0]['coordinate_x'];
    	  			$pos_y =$info[0]['coordinate_y'];
    	  			$action = "$fname crie à $ename: $message";
    	  			$this->Fighters->addEvent_attackFail($today,$action,$pos_x,$pos_y);
			$this->redirect("/Arena/sight");
		}
		}
	    }
	}
	
            /*} else {
            $this->redirect("/Arena/fighter");
        	}*/
        	}
        	} else {
            $this->redirect("/Arena/login");
        	}
        	if (!$info) {
        		$this->redirect("/Arena/fighter");
        	}
        
    }

    public function diary() {
    	$this->loadModel('Fighters');
        if($this->request->session()->check('Session.id')){
    		$this->set('isconnected',true);
    	}else{
    		$this->set('isconnected',false);
    		$this->redirect("/arena/login");
    	}
    	$today = date("Y-m-d H:i:s");
    	$Events = $this->Fighters->getEvent($today);
    	if ($Events) {
    	 $this->set('Events',$Events);
    	 $this->set('actualdate',$today);
    	}else{
    	 $this->set('Events',null);
    	 $this->set('actualdate',null);

    	}

    }

    public function guild(){
    	if($this->request->session()->check('Session.id')){
    		$this->set('isconnected',true);
    	}else{
    		$this->set('isconnected',false);
    	}
    $this->loadModel('Fighters');
				$playerId = $this->request->session()->read('Session.id');
				$fighterId = $this->Fighters->infoRecover($playerId);
                                if(isset($fighterId[0]['guild_id'])){
                                $guildinfo = $this->Fighters->guildrecover(($fighterId[0]['guild_id']));
                                
                                $this->set('guildinfo',$guildinfo);
                                }     
                                $this->set('test', $fighterId);
	if ($this->request->session()->check('Session.id')) 
	{
		if (!$fighterId) {
			$this->redirect("/Arena/fighter");
		}
		$this->loadModel('Guilds');
		$this->loadModel('Fighters');
		if($this->request->is('post'))
		{
			if ($this->request->data['process'] == 'createGuild')
			{
			$guildName = $this->request->data['guildName'];
			if($guildName)
			{
				if(!($this->Guilds->existsGuildSameName($guildName)))
				{
					$guildId2=$this->Guilds->setGuild($guildName);
					$this->Fighters->setGuildId($guildId2,$fighterId[0]['id']);
					$this->redirect("/Arena/guild");
				}
			}
			}

			else //if ($this->request->data['process'] == 'joinGuild')
			{
				$this->loadModel('Fighters');
				$guildId = $this->request->data['process'];
				$playerId = $this->request->session()->read('Session.id');
				$fighterId = $this->Fighters->infoRecover($playerId);
				$this->Fighters->setGuildId($guildId, $fighterId[0]['id']);
				$this->redirect("/Arena/guild");
				
			}
		}
		
		$guilds = $this->Guilds->getGuilds();
		if($guilds)
		{
			$this->set('guilds', $guilds);
		}
		else
		{$this->set('guilds', 'undef');}
	}
	else
		$this->redirect("/Arena/login");
	    
    }

    public function index() {
        if($this->request->session()->check('Session.id')){
    		$this->set('isconnected',true);
    	}else{
    		$this->set('isconnected',false);
    	}
    }



}
