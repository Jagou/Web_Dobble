<?php $this->start('user_view');
echo '<h1>' .h($user['User']['name'] .'</h1>'); 

echo '<p> nombre de cartes :'.$user['User']['nbCards'].'</p>'; 
    $this->end();
?>
