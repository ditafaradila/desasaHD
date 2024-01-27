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

<p style="font-size:18pt; text-align: center">Laporan Keuangan</p>

<table id="tb-item" cellpading="4">
    <thead>
        <tr style="background-color:#a9a9a9; text-align:center;">
            <th style="height: 20px"><strong>No</strong></th>
            <th style="height: 20px"><strong>Keterangan</strong></th>
            <th style="height: 20px"><strong>Tanggal</strong></th>
            <th style="height: 20px"><strong>Debit</strong></th>
            <th style="height: 20px"><strong>Kredit</strong></th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($keuangan as $keuangan) :
        ?>
            <tr>
                <td style="height: 20px;text-align:center">
                    <?= $no++ ?>
                </td>
                <td td style="height: 20px;">
                    <?= $keuangan['keterangan'] ?>
                </td>
                <td td style="height: 20px;text-align:center">
                    <?= $keuangan['tanggal'] ?>
                </td>
                <td td style="height: 20px;text-align:center">
                    <?= $keuangan['debit'] ?>
                </td>
                <td td style="height: 20px;text-align:center">
                    <?= $keuangan['kredit'] ?>
                </td>
            </tr>
        <?php
        endforeach
        ?>
        <tr style="border:1px solid #000; text-align:center;">
            <td colspan="3" style="height: 20px"><strong>Total</strong></td>
            <td colspan="2" style="height: 20px;text-align:center"><strong>Rp <?php echo number_format((float)$totalUang) ?></strong></td>
        </tr>
    </tbody>
</table>
</div>
</div>