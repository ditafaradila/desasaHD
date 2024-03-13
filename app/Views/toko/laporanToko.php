<head>
    <style>
        p,
        span,
        table {
            font-size: 12px
        }

        table {
            width: 100%;
            border: 1px solid #dee2e6;
        }

        table#tb-item tr th,
        table#tb-item tr td {
            border: 1px solid #000
        }
    </style>
</head>

<p style="font-size:18pt; text-align: center">Laporan Transaksi Toko</p>

<table id="tb-item" cellpading="4">
    <thead>
        <tr style="background-color:#a9a9a9; text-align:center;">
            <th style="height: 20px"><strong>No</strong></th>
            <th style="height: 20px"><strong>Nama Produk</strong></th>
            <th style="height: 20px"><strong>Metode Bayar</strong></th>
            <th style="height: 20px"><strong>Harga Awak</strong></th>
            <th style="height: 20px"><strong>Diskon</strong></th>
            <th style="height: 20px"><strong>Harga Akhir</strong></th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($transaksi as $transaksi) :
        ?>
            <tr>
                <td style="height: 20px;text-align:center">
                    <?= $no++ ?>
                </td>
                <td td style="height: 20px;">
                    <?= $transaksi['nama_produk'] ?>
                </td>
                <td td style="height: 20px;text-align:center">
                    <?= $transaksi['metode_bayar'] ?>
                </td>
                <td td style="height: 20px;text-align:center">
                    <?= $transaksi['harga_produk'] ?>
                </td>
                <td td style="height: 20px;text-align:center">
                    <?= $transaksi['diskon'] ?>
                </td>
                <td td style="height: 20px;text-align:center">
                    <?= $transaksi['nominal'] ?>
                </td>
            </tr>
        <?php
        endforeach
        ?>
    </tbody>
</table>
</div>
</div>