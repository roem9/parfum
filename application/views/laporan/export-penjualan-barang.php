<?php 
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>

<?php if($barang):?>
    <h1>Penjualan Barang</h1>
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
                    <td><?= ++$no?></td>
                    <td><?= $data['nama_barang']?></td>
                    <td><?= $data['total']?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>


<?php if($parfum):?>
    <h1>Penjualan Parfum</h1>
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
                    <td><?= ++$no?></td>
                    <td><?= $data['nama_parfum']?></td>
                    <td><?= $data['total']?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>

<?php if($tambahan):?>
    <h1>Penjualan Bahan Tambahan</h1>
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
                    <td><?= ++$no?></td>
                    <td><?= $data['nama_bahan']?></td>
                    <td><?= $data['total']?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>
