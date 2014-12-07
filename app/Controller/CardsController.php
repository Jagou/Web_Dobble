<?php

App::uses('AppControler', 'Controller');

class CardsController extends AppController {
    
    public $helpers = array('Html','Form');
    
    
     public function index() {
        $this->set('cards', $this->Card->find('all'));
    }
    
    public function view_json(){
        $this->set('tas',$this->Card->find('all'));
    }
    
    public function create(){
        function cards() {
            function c($i, $j) {
                return $i + 7*$j + 9;  
            }
            $A = array();
            $B = array();
            $C = array();
            for ($i=0; $i<8; $i++) {
                $A[0][] = 1 + $i;
            }
            for ($i=0; $i<7; $i++) {
                $B[$i][] = 1;
                for ($j=0; $j<7; $j++) {
                    $B[$i][] = c($i, $j);
                }
            }
            for ($i=0; $i<7; $i++) {
                for ($j=0; $j<7; $j++) {
                    $C[$i+7*$j][] = $i+2; 
                    for ($k=0; $k<7; $k++) {
                       $C[$i+7*$j][] = c($k, ($k*$i+$j)%7);
                    }
                }
            }
            return array_merge($A, $B, $C);
        }
        $tab = cards();
        foreach($tab as $carte):
            $this->Card->create();
            $this->request->data['symbol0'] = $carte[0];
            $this->request->data['symbol1'] = $carte[1];
            $this->request->data['symbol2'] = $carte[2];
            $this->request->data['symbol3'] = $carte[3];
            $this->request->data['symbol4'] = $carte[4];
            $this->request->data['symbol5'] = $carte[5];
            $this->request->data['symbol6'] = $carte[6];
            $this->request->data['symbol7'] = $carte[7];
            $this->Card->save($this->request->data);
        endforeach;
        return $this->redirect(array('action' => 'index'));
    }
    
   

}

