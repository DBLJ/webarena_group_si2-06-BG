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
            if ($this->request->data['process'] == 'login') {
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
            
            else {
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
            } else {	
                echo('<p>Créez votre perso</p>');
		if($this->request->is('post'))	
		{
			$name = $this->request->data['fighterName'];
			$playerId = $this->request->Session()->read('Session.id');
			$this->Fighters->createNewFighter($name, $playerId);
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
            // todo : only admin player can execute this function_exists(function_name)
            $this->loadModel('surroundings');
            $this->Fighters->createSurround();

        if ($this->request->is('post')) {

            $this->loadModel('Fighters');
            $info = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
	    	$sessionId = $this->request->session()->read('Session.id');

            if ($info) {

            if ($this->request->data['process'] == "move_x") {
                if ($info[0]['coordinate_x'] < 14) {
                    $this->Fighters->moveFighter($info[0]['coordinate_x'],1,$sessionId);
            		$this->redirect("/Arena/sight");

                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement";
                }
            }

            if ($this->request->data['process'] == "move_x1") {
                if ($info[0]['coordinate_x'] > 0) {
                    $this->Fighters->moveFighter($info[0]['coordinate_x'],2,$sessionId);
            		$this->redirect("/Arena/sight");
                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement";
                }
            }

            if ($this->request->data['process'] == "move_y1") {
                if ($info[0]['coordinate_y'] < 9) {
                    $this->Fighters->moveFighter($info[0]['coordinate_y'],3,$sessionId);
            		$this->redirect("/Arena/sight");

                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement";
                }
            }

            if ($this->request->data['process'] == "move_y") {
                if ($info[0]['coordinate_y'] > 0) {
                    $this->Fighters->moveFighter($info[0]['coordinate_y'],4,$sessionId);
            		$this->redirect("/Arena/sight");

                }else{
                	echo "Error: vous ne pouvez pas faire ce mouvement";
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
            } else {
            $this->redirect("/Arena/fighter");
        	}
        	}
        	} else {
            $this->redirect("/Arena/login");
        	}
        
    }

    public function diary() {
        
    }

    public function index() {
        
    }



}
