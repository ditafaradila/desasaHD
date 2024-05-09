<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        .container {
            padding: 1px; /* Atur padding sesuai kebutuhan */
        }
        body{
            margin:0;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border:none;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .garis {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <p class="garis" align="center"><?= $transaksi['waktu'] ?></p>
        <table>
            <tbody>
                <?php foreach ($produkList as $produk) : ?>
                <tr>
                    <td style="width:50%;"><?= $produk->nama_produk ?></td>
                    <td style="width:5%;" class="garis"><?= $transaksi['jumlah'] ?></td>
                    <td style="width:20%;" class="garis"><?= number_format($produk->harga_produk) ?></td>
                    <td style="width:20%;" class="garis"><?= number_format($transaksi['jumlah'] * $produk->harga_produk) ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td colspan="2" align="right" class="garis"> Harga Jual :</td>
                    <td class="garis"><p><?= number_format($transaksi['jumlah'] * $produk->harga_produk) ?></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="right">Total :</td>
                    <td><p><?= number_format($transaksi['jumlah'] * $produk->harga_produk) ?></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="right">Nominal Bayar :</td>
                    <td><p><?= number_format($transaksi['nominal_bayar']) ?></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="right">Kembali :</td>
                    <td><p><?= number_format($transaksi['kembalian']) ?></p></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
