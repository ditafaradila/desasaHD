<table>
    <thead>
        <tr>
            <th>Item ID</th>
            <th>Item Status</th>
            <th>Update Time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td><?= $item['item_id'] ?></td>
                <td><?= $item['item_status'] ?></td>
                <td><?= $item['update_time'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>Item ID</th>
            <th>Category ID</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Item SKU</th>
            <th>Mata Rupiah</th>
            <th>Harga Original</th>
            <th>Harga Sekarang</th>
            <th>Type Stock</th>
            <th>Stock Sekarang</th>
            <th>Normal Stock</th>
            <th>Foto Produk</th>
            <th>Berat Produk</th>
            <th>Logistic</th>
            <th>Kondisi</th>
            <th>Ukuran</th>
            <th>Status</th>
            <th>Deboost</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items2 as $item2) : ?>
            <tr>
                <td><?= $item2['item_id'] ?></td>
                <td><?= $item2['category_id'] ?></td>
                <td><?= $item2['item_name'] ?></td>
                <td><?= $item2['description'] ?></td>
                <td><?= $item2['item_sku'] ?></td>
                <td><?= $item2['price_info'][0]['currency'] ?></td>
                <td><?= $item2['price_info'][0]['original_price'] ?></td>
                <td><?= $item2['price_info'][0]['current_price'] ?></td>
                <?php if (isset($item2['stock_info'][0])) : ?>
                    <td><?= $item2['stock_info'][0]['stock_type'] ?></td>
                    <td><?= $item2['stock_info'][0]['current_stock'] ?></td>
                    <td><?= $item2['stock_info'][0]['normal_stock'] ?></td>
                <?php else : ?>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                <?php endif; ?>
                <td>
                    <?php foreach ($item2['image']['image_url_list'] as $imageUrl) : ?>
                        <img src="<?= $imageUrl ?>" alt="Product Image"  width="100" height="100"><br>
                    <?php endforeach; ?>
                </td>
                <td><?= $item2['weight'] ?></td>
                <td>
                    <?php foreach ($item2['logistic_info'] as $logistic) : ?>
                        <div>
                            <strong>ID:</strong> <?= $logistic['logistic_id'] ?><br>
                            <strong>Name:</strong> <?= $logistic['logistic_name'] ?><br>
                            <strong>Enabled:</strong> <?= $logistic['enabled'] ? 'Yes' : 'No' ?><br>
                            <strong>Is Free:</strong> <?= $logistic['is_free'] ? 'Yes' : 'No' ?><br>
                        </div>
                        <br>
                    <?php endforeach; ?>
                </td>
                <td><?= $item2['condition'] ?></td>
                <td><?= $item2['size_chart'] ?></td>
                <td><?= $item2['item_status'] ?></td>
                <td><?= $item2['deboost'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>