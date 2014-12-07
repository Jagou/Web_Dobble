<?php

App::uses('AppControler', 'Controller');

class GamesController extends AppController {
    
    public $helpers = array('Html','Form');
    public $uses=array('Game');
    
     public function index() {
        $this->set('posts', $this->Game->find('all'));
    }
    
    public function get_indx($id = null){
        if(!$id){
            throw new NotFoundException(__('index invalide'));
        }
        $this->set('index',$this->Game->find('all',array('conditions'=>array('Game.id'=>$id))));
    }
    
    public function add(){
        if($this->request->is('post')){
            $this->Game->create();
            if($this->Game->save($this->request->data)){
                $this->Session->setFlash(__('La partie a été enregistrée'));
                return $this->redirect(array('action' => 'index'));
            }else{
                 $this->Session->setFlash(__('La partie n\'a pas été enregistrée. Merci de réessayer.'));
            }
        }
    }
    
    public function view($id = null){
        if(!$id){
            throw new NotFoundException(__('Invalid Game'));
        }
        $game = $this->Game->findById($id);
        if(!$game){
            throw new NotFoundException(__('Invalid Game'));
            
        }
        $this->set('post', $game);
        
    }

}
