<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<h3><?= $title?></h3>
<table class="table table-sm" border=1 style="border-collapse: collapse">
    <tr>
        <td colspan="3">Pendapatan dari penjualan</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Penjualan</td>
        <td></td>
        <td></td>
        <td><?= rupiah($penjualan)?></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Dikurangi</td>
        <td>Retur dan potongan penjualan</td>
        <td>Rp. 0</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Diskon Penjualan</td>
        <td><?= rupiah($diskon)?></td>
        <!-- tambahan -->
        <td><?= rupiah($diskon)?></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Penjualan Bersih</td>
        <td></td>
        <td></td>
        <td></td>
        <td><?= rupiah($penjualan - $diskon)?></td>
    </tr>
    <tr>
        <td colspan="3">Harga Pokok Produksi</td>
        <td></td>
        <td></td>
        <td><?= rupiah($hpp)?></td>
    </tr>
    <tr>
        <td>Laba Kotor</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <!-- pengurangan penjualan bersih - hpp -->
        <td><?= rupiah($penjualan - $diskon - $hpp)?></td>
    </tr>

    <tr>
        <td>Beban Operasi : </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <!-- perulangan -->
    <?php 
        $beban_operasi = 0;
        foreach ($beban as $beban) :
            $beban_operasi += $beban['nominal'];
        
        ?>
        <tr>
            <td></td>
            <td><?= $beban['keterangan']?></td>
            <td><?= rupiah($beban['nominal'])?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php endforeach;?>
    <!-- perulangan -->
    <tr>
        <td></td>
        <td></td>
        <td>Jumlah Beban Operasi</td>
        <td></td>
        <td></td>
        <td><?= rupiah($beban_operasi)?></td>
    </tr>

    <tr>
        <td></td>
        <td colspan="3">Laba Operasi</td>
        <td></td>
        <td><?= rupiah($penjualan - $diskon - $hpp - $beban_operasi)?></td>
    </tr>
    
    <tr>
        <td></td>
        <td colspan="3">Laba Bersih</td>
        <td></td>
        <td><?= rupiah($penjualan - $diskon - $hpp - $beban_operasi)?></td>
    </tr>

</table>