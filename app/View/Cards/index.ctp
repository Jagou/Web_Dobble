<h1>Cartes</h1>

<table>

    <?php foreach ($cards as $card): ?>
    <tr>
        <td><?php echo $card['Card']['id']; ?></td>
        <td>
            <?php echo $card['Card']['symbol0']; ?>
        </td>
        <td><?php echo $card['Card']['symbol1']; ?></td>
        <td><?php echo $card['Card']['symbol2']; ?></td>
        <td><?php echo $card['Card']['symbol3']; ?></td>
        <td><?php echo $card['Card']['symbol4']; ?></td>
        <td><?php echo $card['Card']['symbol5']; ?></td>
        <td><?php echo $card['Card']['symbol6']; ?></td>
        <td><?php echo $card['Card']['symbol7']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($cards); ?>
</table>