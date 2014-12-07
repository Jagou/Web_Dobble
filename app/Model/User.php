<?php

App::uses('AppModel', 'Model');

class User extends AppModel {
   public $validate = array(
       'name' => 'alphaNumeric',
       
   );
    

}