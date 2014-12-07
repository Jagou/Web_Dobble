
        
        
        
        <table>
    

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($cards as $card): ?>
    <tr>
        <td> lol </td>
        <td><?php echo $card[0]; ?></td>
        <td>
            <?php echo $card[1]; ?>
        </td>
        <td><?php echo $card[2]; ?></td>
        <td><?php echo $card[3]; ?></td>
        <td><?php echo $card[4]; ?></td>
        <td><?php echo $card[5]; ?></td>
        <td><?php echo $card[6]; ?></td>
        <td><?php echo $card[7]; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($cards); ?>
</table>