<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>
<h3><?= "Periode " . $title?></h3>
<?php if($barang):?>
    <h3>Penjualan Barang</h3>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Total</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                foreach ($barang as $data) :
                ?>
                <tr>
                    <td><center><?= ++$no?></center></td>
                    <td><?= $data['nama_barang']?></td>
                    <td><center><?= $data['total']?></center></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>


<?php if($parfum):?>
    <h3>Penjualan Parfum</h3>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Nama Parfum</th>
            <th>Total</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                foreach ($parfum as $data) :
                ?>
                <tr>
                    <td><center><?= ++$no?></center></td>
                    <td><?= $data['nama_parfum']?></td>
                    <td><center><?= $data['total']?></center></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>

<?php if($tambahan):?>
    <h3>Penjualan Bahan Tambahan</h3>
    <table class="table table-sm" border=1 style="border-collapse: collapse">
        <tr>
            <th>No</th>
            <th>Nama Bahan</th>
            <th>Total</th>
        </tr>
        <tbody>
            <?php 
                $no = 0;
                foreach ($tambahan as $data) :
                ?>
                <tr>
                    <td><center><?= ++$no?></center></td>
                    <td><?= $data['nama_bahan']?></td>
                    <td><center><?= $data['total']?></center></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>
