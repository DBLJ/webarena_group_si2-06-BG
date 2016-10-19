<?php
namespace App\Controller;
use App\Controller\AppController;
/**
* Personal Controller
* User personal interface
*
*/
class ArenaController  extends AppController
{
public function index()
{
}

public function login()
{
}

public function fighter()
{
$this->set('mypseudo', "Julien_Falconnet");
$this->set('mylevel', 2);
$this->set('mygroup', "assassin");
}

public function sight()
{

}

public function diary()
{

}
}