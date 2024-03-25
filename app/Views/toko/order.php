<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['order_sn'] ?></td>
                <td><?= $order['order_status'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>