<?php

use AppModel;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class Pioche extends AppModel {
    
    public $primaryKey = 'id';
    public $images;
    
    public function Pioche() {
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
    
}

