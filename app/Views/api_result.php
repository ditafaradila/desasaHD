<!-- orders_view.php -->

<h2>Daftar Pesanan</h2>

<?php foreach ($orders as $order): ?>
    <div style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
        <p><strong>Order ID:</strong> <?= $order['order_id']; ?></p>
        <p><strong>User ID:</strong> <?= $order['user_id']; ?></p>
        <p><strong>Status:</strong> <?= $order['status']; ?></p>
        <p><strong>Total Price:</strong> $<?= $order['total_price']; ?></p>

        <h4>Items:</h4>
        <ul>
            <?php foreach ($order['items'] as $item): ?>
                <li>
                    <strong>Product ID:</strong> <?= $item['product_id']; ?>,
                    <strong>Quantity:</strong> <?= $item['quantity']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>
