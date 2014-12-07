<?php

App::uses('AppControler', 'Controller');

class UsersController extends AppController {
    
    public $helpers = array('Html','Form');
    public $uses=array('User','Game');
    
    
     public function index() {
        $this->set('users', $this->User->find('all'));
    }
    
    public function add(){
         
        if($this->request->is('post')){
            $this->User->create();
            $id = 1;
            while(true){
                $game = $this->Game->findById($id);
                if(!$game){
                    $this->Game->create();
                    $this->request->data['User']['game_id']=$id;
                    $data = array('id' => $id, 'nbPlayers' => 4);
                    $this->Game->save($data);
                    break;
                }
                $game2 = $this->User->find('count', array('conditions'=>array('User.game_id'=>$id)));
                if($game2 >= 4){
                    $this->Game->create();
                    $id = $id+1;
                    $this->request->data['User']['game_id']=$id;
                    $data = array('id' => $id, 'nbPlayers' => 4);
                     $this->Game->save($data);
                    break;
                }
                if($game2 <4){
                    $this->request->data['User']['game_id']=$id;
                    break;
                }
            }
            
           
            if($this->User->save($this->request->data)){
                $truc = $this->User->find('all', array('conditions'=>array('User.name'=>$this->request->data['User']['name'])));
                return $this->redirect(array('action' => 'jeu/'.$id.'/'.$truc[0]['User']['id']));
            }else{
                 $this->Session->setFlash(__('L\'user n\'a pas été sauvegardé. Merci de réessayer.'));
            }
        }
    }
    
    public function view($id = null){
        if(!$id){
            throw new NotFoundException(__('Invalid User'));
        }
        $user = $this->User->findById($id);
        if(!$user){
            throw new NotFoundException(__('Invalid User'));
            
        }
        $this->set('user', $user);
        
    }
    
    public function jeu($id = null, $name = null){
        if(!$id){
            throw new NotFoundException(__('Partie invalide'));
        }
            $this->set('users',$this->User->find('all', array('conditions' =>array('User.game_id'=>$id))));
        
    }
    
    public function set_nb_card($id_joueur = null){
        if(!$id_joueur){
            throw new NotFoundException(__('joueur invalide'));
        }
        $user = $this->User->findById($id_joueur);
        $user['User']['nbCards']++;
        $this->User->id=$id_joueur;
        $this->User->saveField('nbCards', $user['User']['nbCards']);
    }

}