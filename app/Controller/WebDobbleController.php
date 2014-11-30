<?php

App::uses('AppControler', 'Controller');

class WebDobbleController extends AppController {
    public $components = array('Session'); //servira pour la suite
    
    public function index() {
		//cette action est vide pour l'instant.
    }
    
    public function pioche() {
        $tas=$this->Pioche->Pioche();
    }
}
?>
