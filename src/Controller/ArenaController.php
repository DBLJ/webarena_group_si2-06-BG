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
        }
    }

    public function fighter() {
        if ($this->request->session()->check('Session.id')) {
            $this->loadModel('Fighters');
            $info = $this->Fighters->infoRecover($this->request->session()->read('Session.id'));
            $nb_perso = 0;
            foreach ($info as $value) {
                $nb_perso++;
                
            }
            $this->set('perso',$info);
            $this->set('nb_perso',$nb_perso);
        } else {
            $this->redirect("/Arena/login");
        }
    }

    public function sight() {
        
    }

    public function diary() {
        
    }

}
