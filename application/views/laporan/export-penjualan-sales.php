<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<h3><?= $title?></h3>

<?php foreach ($data as $i => $data) :?>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <?php if($agen_sales == "Agen"):?>
                <th colspan="7"><?= $data['nama_agen']?></th>
            <?php else:?>
                <th colspan="7"><?= $data['nama_sales']?></th>
            <?php endif;?>
        </tr>
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
                $to = 0;
                $to_qty = 0;
                foreach ($data['penjualan'] as $k => $data) :
                    $qty = 0;
                    $total[$k] = 0;
                    $row = COUNT($data['detail']['parfum']) + COUNT($data['detail']['barang']) + COUNT($data['detail']['tambahan']);
                    
                    foreach ($data['detail']['barang'] as $j => $barang){
                        $total[$k] += $barang['harga'] * $barang['qty'];
                    }
                    
                    foreach ($data['detail']['parfum'] as $j => $parfum){
                        $total[$k] += $parfum['harga'] * $parfum['qty'];
                        $qty = $parfum['qty'];
                    }
                    
                    foreach ($data['detail']['tambahan'] as $j => $tambahan){
                        $total[$k] += $tambahan['harga'] * $tambahan['qty'];
                    }
                    $to += $total[$k];
                    $to_qty += $qty;
                ?>
                <tr>
                    <td rowspan="<?= $row?>"><?= ++$no?></td>
                    <td rowspan="<?= $row?>"><?= $data['tgl_penjualan']?></td>
                    <td rowspan="<?= $row?>"><?= $data['nama']?></td>
                    <td rowspan="<?= $row?>"><?= $data['metode']?></td>
                    <td rowspan="<?= $row?>"><?= rupiah($total[$k])?></td>
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
            <tr>
                <td colspan="4">Total</td>
                <td><?= rupiah($to)?></td>
            </tr>
            <?php if($agen_sales == "Sales"):?>
                <tr style="background-color: yellow">
                    <td colspan="4">Total Botol</td>
                    <td><?= $to_qty?></td>
                    <td></td>
                    <td colspan="2"><?= rupiah(6500 * $to_qty)?></td>
                </tr>
            <?php endif;?>
        </tbody>
    </table>
    <br>
    <br>
<?php endforeach;?>
