<table>
    <thead>
        <tr>
            <th>Item ID</th>
            <th>Item Status</th>
            <th>Update Time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['item_id'] ?></td>
                <td><?= $item['item_status'] ?></td>
                <td><?= $item['update_time'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>