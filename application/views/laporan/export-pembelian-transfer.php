<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<h1><?= "Periode " . $title?></h1>
<?php if($bca):?>
    <h1>Transfer BCA</h1>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Transaksi</th>
            <th>Total</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                foreach ($bca as $i => $data) :
                    $bca[$i] = 0;

                    foreach ($data['detail']['barang'] as $j => $barang){
                        $bca[$i] += $barang['harga'];
                    }
                    
                    foreach ($data['detail']['tambahan'] as $j => $tambahan){
                        $bca[$i] += $tambahan['harga'];
                    }
                ?>
                <tr>
                    <td><?= ++$no?></td>
                    <td><?= $data['tgl_pembelian']?></td>
                    <td><?= $data['nama']?></td>
                    <td><?= $data['metode']?></td>
                    <td><?= rupiah($bca[$i])?></td>
                </tr>
            <?php 
                // exit();
                endforeach;?>
                <tr>
                    <td colspan="4">Total</td>
                    <?php 
                        $to = 0;
                        foreach ($bca as $bca) {
                            $to += $bca;
                        }
                    ?>
                    <td><?= rupiah($to)?></td>
                </tr>
        </tbody>
    </table>
<?php endif;?>


<?php if($bri):?>
    <h1>Transfer BRI</h1>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Transaksi</th>
            <th>Total</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                foreach ($bri as $i => $data) :
                    $bri[$i] = 0;

                    foreach ($data['detail']['barang'] as $j => $barang){
                        $bri[$i] += $barang['harga'];
                    }
                    
                    foreach ($data['detail']['tambahan'] as $j => $tambahan){
                        $bri[$i] += $tambahan['harga'];
                    }
                ?>
                <tr>
                    <td><?= ++$no?></td>
                    <td><?= $data['tgl_pembelian']?></td>
                    <td><?= $data['nama']?></td>
                    <td><?= $data['metode']?></td>
                    <td><?= rupiah($bri[$i])?></td>
                </tr>
            <?php 
                // exit();
                endforeach;?>
                <tr>
                    <td colspan="4">Total</td>
                    <?php 
                        $to = 0;
                        foreach ($bri as $bri) {
                            $to += $bri;
                        }
                    ?>
                    <td><?= rupiah($to)?></td>
                </tr>
        </tbody>
    </table>
<?php endif;?>


<?php if($mandiri):?>
    <h1>Transfer Mandiri</h1>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Transaksi</th>
            <th>Total</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                foreach ($mandiri as $i => $data) :
                    $mandiri[$i] = 0;

                    foreach ($data['detail']['barang'] as $j => $barang){
                        $mandiri[$i] += $barang['harga'];
                    }
                    
                    foreach ($data['detail']['tambahan'] as $j => $tambahan){
                        $mandiri[$i] += $tambahan['harga'];
                    }
                ?>
                <tr>
                    <td><?= ++$no?></td>
                    <td><?= $data['tgl_pembelian']?></td>
                    <td><?= $data['nama']?></td>
                    <td><?= $data['metode']?></td>
                    <td><?= rupiah($mandiri[$i])?></td>
                </tr>
            <?php 
                // exit();
                endforeach;?>
                <tr>
                    <td colspan="4">Total</td>
                    <?php 
                        $to = 0;
                        foreach ($mandiri as $mandiri) {
                            $to += $mandiri;
                        }
                    ?>
                    <td><?= rupiah($to)?></td>
                </tr>
        </tbody>
    </table>
<?php endif;?>
