<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<h1><?= $title?></h1>
<table border=1>
    <th>No</th>
    <th>Tgl</th>
    <th>Keterangan</th>
    <th>Nominal</th>
    <th>Metode</th>
    <th>Rekening</th>
    <tbody>
        <?php 
            $total = 0;
            $no = 0;
            foreach ($pengeluaran as $pengeluaran) :
                $total += $pengeluaran['nominal'];
            ?>
            <tr>
                <td><?= ++$no?></td>
                <td><?= $pengeluaran['tgl_pengeluaran']?></td>
                <td><?= $pengeluaran['keterangan']?></td>
                <td><?= rupiah($pengeluaran['nominal'])?></td>
                <td><?= $pengeluaran['metode']?></td>
                <td><?= $pengeluaran['rekening']?></td>
            </tr>
        <?php endforeach;?>
        <tr>
            <td colspan=3>Total</td>
            <td><?= rupiah($total)?></td>
        </tr>
    </tbody>
</table>