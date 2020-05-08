<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<h1>Seluruh Penjualan</h1>
<table class="table table-sm" border=1 style="border-collapse: collapse">
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Tanggal</th>
        <th rowspan="2">Nama</th>
        <th rowspan="2">Transaksi</th>
        <th rowspan="2">Total</th>
        <th colspan="2">Detail Penjualan</th>
    </tr>
    <tr>
        <th>Barang</th>
        <th>QTY</th>
    </tr>
    <tbody>
        <?php 
            $no = 0;
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
            ?>
            <tr>
                <td rowspan="<?= $row?>"><?= ++$no?></td>
                <td rowspan="<?= $row?>"><?= $data['tgl_penjualan']?></td>
                <td rowspan="<?= $row?>"><?= $data['nama']?></td>
                <td rowspan="<?= $row?>"><?= $data['metode']?></td>
                <td rowspan="<?= $row?>"><?= rupiah($total[$i])?></td>
                <?php foreach ($data['detail']['parfum'] as $j => $parfum) :?>
                    <?php 
                        $total[$i] += $parfum['harga'] * $parfum['qty'];
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
                        $total[$i] += $barang['harga'] * $barang['qty'];
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
                        $total[$i] += $tambahan['harga'] * $tambahan['qty'];
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
    </tbody>
</table>
