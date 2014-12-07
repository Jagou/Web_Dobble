<?php

App::uses('AppControler', 'Controller');

class StacksController extends AppController {
    
    public $helpers = array('Html','Form');
    
    
     public function index() {
        $this->set('stacks', $this->Game->find('all'));
    }
    
    public function add($game_id = null, $card_id =null, $numOrdre =null){
        if(!$game_id){
            throw new NotFoundException(__('Invalid Game_id'));
        }
        if(!$card_id){
            throw new NotFoundException(__('Invalid Card_id'));
        }
        if(!$numOrder){
            throw new NotFoundException(__('Invalid NumOrder'));
        }
        $this->Stack->create();
        $this->request->data['game_id']=$game_id;
        $this->request->data['card_id']=$card_id;
        $this->request->data['numOrder']=$numOrder;
        $this->Stack->save($this->request->data);
    }
    

}

