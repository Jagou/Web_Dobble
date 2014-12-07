<h1>Parties</h1>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre de Joueurs</th>
        <th> index de la carte sur la pioche</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Game']['id']; ?></td>
        <td>
            <?php echo $post['Game']['nbPlayers']; ?>
        </td>
        <td><?php echo $post['Game']['indx']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>