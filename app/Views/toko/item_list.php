<!-- app/Views/shopee_view.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee Items</title>
</head>

<body>
    <h1>Shopee Items</h1>
    <ul>
    <?php if (isset($items['response']['item'])) : ?>
            <?php foreach ($items['response']['item'] as $item) : ?>
                <li>
                    <strong>Item ID:</strong> <?php echo $item['item_id']; ?><br>
                    <strong>Item Status:</strong> <?php echo $item['item_status']; ?><br>
                    <strong>Update Time:</strong> <?php echo $item['update_time']; ?><br>
                    <!-- Tambahkan atribut lainnya sesuai kebutuhan -->
                    <hr>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li>No items found</li>
        <?php endif; ?>
    </ul>
</body>

</html>