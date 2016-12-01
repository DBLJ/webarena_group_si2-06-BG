<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Personal Controller
 * User personal interface
 *
 */
class ArenaController extends AppController {


    public function login() {

    	

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

                $test = $this->Fighters->connexion($mail, $password);
                if ($test['id'] == 0) {
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
                    $indic = $this->Players->register($this->request->data['email'], $this->request->data['password']);
                    if ($indic) {
                        $test = $this->Fighters->connexion($mail, $password);
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

    public function fighter() {
	$checkPosition = 1;
	$i = 0;
        if ($this->request->session()->check('Session.id')) {
            $this->loadModel('Fighters');
            $info = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
            if ($info) {
                $nb_perso = 0;
                foreach ($info as $value) {
                    $nb_perso++;
                }
                $this->set('perso', $info);
                $this->set('nb_perso', $nb_perso);

                if ($info[0]['guild_id']) {

                    $tab = $this->Fighters->guildrecover($info[0]['guild_id']);
                    $this->set('nomguild', $tab);
                }
            $infoForNext = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
                    $this->request->Session()->write('xp_actuel',$infoForNext[0]['xp']);


            } else {	
                echo('<p>Créez votre perso</p>');
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
    	  			$this->Fighters->exp_atck($info[0]['player_id'],$info[0]['xp']);
    	  			$this->Fighters->attack($info2[0]['current_health'],$info[0]['skill_strength'],$info2[0]['player_id']);
    	  			if ($info2[0]['current_health']-1 <= 0) {
    	  				$this->Fighters->exp_atck_dead($info[0]['player_id'],$info[0]['xp'],$info2[0]['level']);
    	  				$dead=$this->Fighters->get($info2[0]['id']);
    	  				$this->Fighters->delete($dead);
    	  			}



    	  	}else{
    	  			echo "vous ratez votre attaque";
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
        
    }

    public function index() {
        
    }



}
