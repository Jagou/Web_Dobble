<h1>Joueur</h1>
<?php echo $this->Html->link(
    'Ajouter un joueur',
    array('controller' => 'users', 'action' => 'add')
); ?>
<table>
    <tr>
        <th>Nom</th>
        <th>Nombre de Cartes</th>
        <th> jouant dans la partie</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['name']; ?></td>
        <td>
            <?php echo $user['User']['nbCards']; ?>
        </td>
        <td><?php echo $user['User']['game_id']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>