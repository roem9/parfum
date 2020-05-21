<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<h3><?= $title?></h3>
<?php if($data):?>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Tanggal</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Transaksi</th>
            <th rowspan="2">Total</th>
            <th rowspan="2">Diskon</th>
            <th colspan="2">Detail Penjualan</th>
        </tr>
        <tr>
            <th>Barang</th>
            <th>QTY</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                $to = 0;
                $diskon = 0;
                foreach ($data as $i => $data) :
                    $total[$i] = 0;
                    $row = COUNT($data['detail']['parfum']) + COUNT($data['detail']['barang']) + COUNT($data['detail']['tambahan']);
                    
                    foreach ($data['detail']['barang'] as $j => $barang){
                        $total[$i] += $barang['harga'] * $barang['qty'];
                    }
                    
                    foreach ($data['detail']['parfum'] as $j => $parfum){
                        $total[$i] += $parfum['harga'] * $parfum['qty'];
                    }
                    
                    foreach ($data['detail']['tambahan'] as $j => $tambahan){
                        $total[$i] += $tambahan['harga'] * $tambahan['qty'];
                    }

                    $to += $total[$i];
                    $diskon += $data['diskon'];
                ?>
                <tr>
                    <td rowspan="<?= $row?>"><?= ++$no?></td>
                    <td rowspan="<?= $row?>"><?= $data['tgl_penjualan']?></td>
                    <td rowspan="<?= $row?>"><?= $data['nama']?></td>
                    <td rowspan="<?= $row?>"><?= $data['metode']?></td>
                    <td rowspan="<?= $row?>"><?= rupiah($total[$i])?></td>
                    <td rowspan="<?= $row?>"><?= rupiah($data['diskon'])?></td>
                    <?php foreach ($data['detail']['parfum'] as $j => $parfum) :?>
                        <?php 
                            if($j == 0):?>
                                <td><?= $parfum['nama_parfum']?></td>
                                <td><?= $parfum['qty']?> </td>
                            </tr>
                        <?php else :?>
                            <tr>
                                <td><?= $parfum['nama_parfum']?></td>
                                <td><?= $parfum['qty']?> </td>
                            </tr>
                        <?php endif;?>
                        <!-- </tr> -->
                    <?php endforeach;?>

                    <?php foreach ($data['detail']['barang'] as $j => $barang) :?>
                        <?php 
                            if($j == 0):?>
                                <td><?= $barang['nama_barang']?></td>
                                <td><?= $barang['qty']?> </td>
                            </tr>
                        <?php else :?>
                            <tr>
                                <td><?= $barang['nama_barang']?></td>
                                <td><?= $barang['qty']?> </td>
                            </tr>
                        <?php endif;?>
                        <!-- </tr> -->
                    <?php endforeach;?>
                    
                    <?php foreach ($data['detail']['tambahan'] as $j => $tambahan) :?>
                        <?php 
                            if($j == 0):?>
                                <td><?= $tambahan['nama_bahan']?></td>
                                <td><?= $tambahan['qty']?> </td>
                            </tr>
                        <?php else :?>
                            <tr>
                                <td><?= $tambahan['nama_bahan']?></td>
                                <td><?= $tambahan['qty']?> </td>
                            <!-- </tr> -->
                        <?php endif;?>
                        <!-- </tr> -->
                    <?php endforeach;?>
                </tr>
            <?php 
                // exit();
                endforeach;?>
            <tr style="background-color: yellow">
                <td colspan="4">Total</td>
                <td><?= rupiah($to)?></td>
                <td><?= rupiah($diskon)?></td>
                <td colspan=2><?= rupiah($to - $diskon)?></td>
            </tr>
        </tbody>
    </table>
    <br><br>
<?php endif;?>

<?php if($shopee):?>
    <h3>Pemasukan Shopee</h3>
    <table border=1>
        <th>No</th>
        <th>Tgl</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th>Nominal</th>
        <th>Metode</th>
        <th>Rekening</th>
        <tbody>
            <?php 
                $total = 0;
                $no = 0;
                foreach ($shopee as $shopee) :
                    $total += $shopee['nominal'];
                ?>
                <tr>
                    <td><?= ++$no?></td>
                    <td><?= $shopee['tgl_pemasukan']?></td>
                    <td><?= $shopee['nama']?></td>
                    <td><?= $shopee['keterangan']?></td>
                    <td><?= rupiah($shopee['nominal'])?></td>
                    <td><?= $shopee['metode']?></td>
                    <td><?= $shopee['rekening']?></td>
                </tr>
            <?php endforeach;?>
            <tr style="background-color: yellow">
                <td colspan=4>Total</td>
                <td><?= rupiah($total)?></td>
            </tr>
        </tbody>
    </table>
    <br><br>
<?php endif;?>

<?php if($agen):?>
    <h3>Pemasukan Agen</h3>
    <table border=1>
        <th>No</th>
        <th>Tgl</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th>Nominal</th>
        <th>Metode</th>
        <th>Rekening</th>
        <tbody>
            <?php 
                $total = 0;
                $no = 0;
                foreach ($agen as $agen) :
                    $total += $agen['nominal'];
                ?>
                <tr>
                    <td><?= ++$no?></td>
                    <td><?= $agen['tgl_pemasukan']?></td>
                    <td><?= $agen['nama']?></td>
                    <td><?= $agen['keterangan']?></td>
                    <td><?= rupiah($agen['nominal'])?></td>
                    <td><?= $shopee['metode']?></td>
                    <td><?= $shopee['rekening']?></td>
                </tr>
            <?php endforeach;?>
            <tr style="background-color: yellow">
                <td colspan=4>Total</td>
                <td><?= rupiah($total)?></td>
            </tr>
        </tbody>
    </table>
<?php endif;?>
