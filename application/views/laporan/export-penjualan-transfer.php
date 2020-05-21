<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>

<h3><?= "Periode " . $title?></h3>

<?php if($bca):?>
    <h3>Transfer BCA</h3>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Transaksi</th>
            <th>Total</th>
            <th>Diskon</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                $diskon_bca = 0;
                foreach ($bca as $i => $data) :
                    $bca[$i] = 0;
                    $diskon_bca += $data['diskon'];

                    foreach ($data['detail']['barang'] as $j => $barang){
                        $bca[$i] += $barang['harga'] * $barang['qty'];
                    }
                    
                    foreach ($data['detail']['parfum'] as $j => $parfum){
                        $bca[$i] += $parfum['harga'] * $parfum['qty'];
                    }
                    
                    foreach ($data['detail']['tambahan'] as $j => $tambahan){
                        $bca[$i] += $tambahan['harga'] * $tambahan['qty'];
                    }
                ?>
                <tr>
                    <td><?= ++$no?></td>
                    <td><?= $data['tgl_penjualan']?></td>
                    <td><?= $data['nama']?></td>
                    <td><?= $data['metode']?></td>
                    <td><?= rupiah($bca[$i])?></td>
                    <td><?= rupiah($data['diskon'])?></td>
                </tr>
            <?php 
                // exit();
                endforeach;?>
                <tr style="background-color: yellow">
                    <td colspan="4">Total</td>
                    <?php 
                        $to = 0;
                        foreach ($bca as $bca) {
                            $to += $bca;
                        }
                    ?>
                    <td><?= rupiah($to)?></td>
                    <td><?= rupiah($diskon_bca)?></td>
                    <td><?= rupiah($to - $diskon_bca)?></td>
                </tr>
        </tbody>
    </table>
<?php endif;?>


<?php if($bri):?>
    <h3>Transfer BRI</h3>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Transaksi</th>
            <th>Total</th>
            <th>Diskon</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                $diskon_bri = 0;
                foreach ($bri as $i => $data) :
                    $bri[$i] = 0;
                    $diskon_bri += $data['diskon'];

                    foreach ($data['detail']['barang'] as $j => $barang){
                        $bri[$i] += $barang['harga'] * $barang['qty'];
                    }
                    
                    foreach ($data['detail']['parfum'] as $j => $parfum){
                        $bri[$i] += $parfum['harga'] * $parfum['qty'];
                    }
                    
                    foreach ($data['detail']['tambahan'] as $j => $tambahan){
                        $bri[$i] += $tambahan['harga'] * $tambahan['qty'];
                    }
                ?>
                <tr>
                    <td><?= ++$no?></td>
                    <td><?= $data['tgl_penjualan']?></td>
                    <td><?= $data['nama']?></td>
                    <td><?= $data['metode']?></td>
                    <td><?= rupiah($bri[$i])?></td>
                    <td><?= rupiah($data['diskon'])?></td>
                </tr>
            <?php 
                // exit();
                endforeach;?>
                <tr style="background-color: yellow">
                    <td colspan="4">Total</td>
                    <?php 
                        $to = 0;
                        foreach ($bri as $bri) {
                            $to += $bri;
                        }
                    ?>
                    <td><?= rupiah($to)?></td>
                    <td><?= rupiah($diskon_bri)?></td>
                    <td><?= rupiah($to - $diskon_bri)?></td>
                </tr>
        </tbody>
    </table>
<?php endif;?>


<?php if($mandiri):?>
    <h3>Transfer Mandiri</h3>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Transaksi</th>
            <th>Total</th>
            <th>Diskon</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                $diskon_mandiri = 0;
                foreach ($mandiri as $i => $data) :
                    $mandiri[$i] = 0;
                    $diskon_mandiri += $data['diskon'];

                    foreach ($data['detail']['barang'] as $j => $barang){
                        $mandiri[$i] += $barang['harga'] * $barang['qty'];
                    }
                    
                    foreach ($data['detail']['parfum'] as $j => $parfum){
                        $mandiri[$i] += $parfum['harga'] * $parfum['qty'];
                    }
                    
                    foreach ($data['detail']['tambahan'] as $j => $tambahan){
                        $mandiri[$i] += $tambahan['harga'] * $tambahan['qty'];
                    }
                ?>
                <tr>
                    <td><?= ++$no?></td>
                    <td><?= $data['tgl_penjualan']?></td>
                    <td><?= $data['nama']?></td>
                    <td><?= $data['metode']?></td>
                    <td><?= rupiah($mandiri[$i])?></td>
                    <td><?= rupiah($data['diskon'])?></td>
                </tr>
            <?php 
                // exit();
                endforeach;?>
                <tr style="background-color: yellow">
                    <td colspan="4">Total</td>
                    <?php 
                        $to = 0;
                        foreach ($mandiri as $mandiri) {
                            $to += $mandiri;
                        }
                    ?>
                    <td><?= rupiah($to)?></td>
                    <td><?= rupiah($diskon_mandiri)?></td>
                    <td><?= rupiah($to - $diskon_mandiri)?></td>
                </tr>
        </tbody>
    </table>
<?php endif;?>
