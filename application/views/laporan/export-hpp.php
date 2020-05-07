<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
    </div>

    <?php if( $this->session->flashdata('pesan') ) : ?>
        <div class="row">
            <div class="col-6">
                <?= $this->session->flashdata('pesan');?>
                </div>
        </div>
    <?php endif; ?>

    <table class="cus-font" style="max-width: 70%" border=1>
        <tr>
            <th>No</th>
            <th colspan=4>Keterangan</th>
            <th></th>
        </tr>
        <tr>
            <td></td>
            <td colspan=3>PEMBELIAN DAN BIAYA</td>
            <td></td>
            <td></td>
        </tr>

        <!-- bahan baku i -->
            <tr>
                <td></td>
                <td><b>i</b></td>
                <td colspan=2><b>Bahan Baku</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Persediaan Awal</td>
                <td><?= rupiah($bahan_baku_awal)?></td>
                <td></td>
            </tr>
            <?php 
                $total_pembelian = 0;
                foreach ($pembelian_bahan_baku as $pembelian) :
                    $total_pembelian += $pembelian['total'];
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Pembelian Bahan Baku</td>
                    <td><?= rupiah($pembelian['total'])?></td>
                    <td></td>
                </tr>
            <?php endforeach;?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Return Pembelian</td>
                <td>Rp. 0</td>
                <td> +</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Persediaan Akhir</td>
                <td><?= rupiah($bahan_baku_akhir)?></td>
                <td> -</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total Bahan Baku</b></td>
                <td></td>
                <td><b><?= rupiah($total_pembelian + $bahan_baku_awal - $bahan_baku_akhir)?></b></td>
            </tr>
        <!-- bahan baku i -->
        
        
        <!-- bahan pembantu ii -->
            <tr>
                <td></td>
                <td><b>ii</b></td>
                <td colspan=2><b>Bahan Pembantu</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Persediaan Awal</td>
                <td><?= rupiah($bahan_pembantu_awal)?></td>
                <td></td>
            </tr>
            <?php 
                $total_pembelian_pembantu = 0;
                foreach ($pembelian_bahan_pembantu as $pembelian) :
                    $total_pembelian_pembantu += $pembelian['total'];
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Pembelian Bahan Pembantu</td>
                    <td><?= rupiah($pembelian['total'])?></td>
                    <td></td>
                </tr>
            <?php endforeach;?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Return Pembelian</td>
                <td>Rp. 0</td>
                <td> +</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Persediaan Akhir</td>
                <td><?= rupiah($bahan_pembantu_akhir)?></td>
                <td> -</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total Bahan Baku</b></td>
                <td></td>
                <td><b><?= rupiah($total_pembelian_pembantu + $bahan_pembantu_awal - $bahan_pembantu_akhir)?></b></td>
            </tr>
        <!-- bahan pembantu ii -->

        <!-- tenaga kerja iii -->
            <tr></tr>
            <tr>
                <td></td>
                <td><b>iii</b></td>
                <td colspan=2><b>TENAGA KERJA</b></td>
                <td></td>
                <td></td>
            </tr>
            <?php 
                $total_kerja = 0;
                foreach ($biaya_kerja as $kerja) :
                $total_kerja += $kerja['nominal'];
                ?>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Biaya <?= $kerja['jenis']?></td>
                    <td><?= rupiah($kerja['nominal'])?></td>
                    <td></td>
                </tr>
            <?php endforeach;?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total Biaya Tenaga Kerja</b></td>
                <td></td>
                <td><b><?= rupiah($total_kerja)?></b></td>
            </tr>
            <tr></tr>
        <!-- tenaga kerja iii -->

        <!-- overhead iv -->
            <tr>
                <td></td>
                <td><b>iv</b></td>
                <td colspan=2><b>Biaya Overhead</b></td>
                <td></td>
                <td></td>
            </tr>
            <?php 
                $total_overhead = 0;
                foreach ($biaya_overhead as $overhead) :
                    $total_overhead += $overhead['nominal'];
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Biaya <?= $overhead['jenis']?></td>
                    <td><?= rupiah($overhead['nominal'])?></td>
                    <td></td>
                </tr>
            <?php endforeach;?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total Biaya Overhead</b></td>
                <td></td>
                <td><b><?= rupiah($total_overhead)?></b></td>
            </tr>
        <!-- overhead iv -->

        <!-- jumlah biaya produksi -->
            <tr>
                <td></td>
                <td colspan=3><b>JUMLAH BIAYA PRODUKSI (i+ii+iii+iv)</b></td>
                <td></td>
                <td><b><?= rupiah($total_pembelian + $bahan_baku_awal - $bahan_baku_akhir + $total_pembelian_pembantu + $bahan_pembantu_awal - $bahan_pembantu_akhir + $total_kerja + $total_overhead)?></b></td>
            </tr>
        <!-- jumlah biaya produksi -->
        
        <!-- barang dalam proses v -->
            <tr>
                <td></td>
                <td><b>v</b></td>
                <td colspan=2><b>BARANG DALAM PROSES</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Barang Dalam Proses Awal</td>
                <td><?= rupiah(0)?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Jumlah Biaya Produksi</td>
                <td><?= rupiah($total_pembelian + $bahan_baku_awal - $bahan_baku_akhir + $total_pembelian_pembantu + $bahan_pembantu_awal - $bahan_pembantu_akhir + $total_kerja + $total_overhead)?></td>
                <td>+</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?= rupiah($total_pembelian + $bahan_baku_awal - $bahan_baku_akhir + $total_pembelian_pembantu + $bahan_pembantu_awal - $bahan_pembantu_akhir + $total_kerja + $total_overhead)?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Barang Dalam Proses Akhir</td>
                <td><?= rupiah(0)?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Barang Jadi Setelah Proses</b></td>
                <td></td>
                <td><b><?= rupiah($total_pembelian + $bahan_baku_awal - $bahan_baku_akhir + $total_pembelian_pembantu + $bahan_pembantu_awal - $bahan_pembantu_akhir + $total_kerja + $total_overhead)?></b></td>
            </tr>
            <tr></tr>
        <!-- barang dalam proses v -->
        
        <!-- barang dalam proses vi -->
            <tr>
                <td></td>
                <td><b>vi</b></td>
                <td colspan=2><b>BARANG JADI</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Persediaan Barang Jadi Awal</td>
                <td><?= rupiah(0)?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Barang Jadi Setelah Proses</td>
                <td><?= rupiah($total_pembelian + $bahan_baku_awal - $bahan_baku_akhir + $total_pembelian_pembantu + $bahan_pembantu_awal - $bahan_pembantu_akhir + $total_kerja + $total_overhead)?></td>
                <td>+</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total Persediaan Barang Jadi</td>
                <td><?= rupiah($total_pembelian + $bahan_baku_awal - $bahan_baku_akhir + $total_pembelian_pembantu + $bahan_pembantu_awal - $bahan_pembantu_akhir + $total_kerja + $total_overhead)?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Persediaan Barang Jadi Akhir</td>
                <td><?= rupiah(0)?></td>
                <td>-</td>
            </tr>
            <tr></tr>
        <!-- barang dalam proses vi -->

        <!-- hpp -->
            <tr>
                <td></td>
                <td colspan=3><b>Harga Pokok Produksi</b></td>
                <td></td>
                <td><b><?= rupiah($total_pembelian + $bahan_baku_awal - $bahan_baku_akhir + $total_pembelian_pembantu + $bahan_pembantu_awal - $bahan_pembantu_akhir + $total_kerja + $total_overhead)?></b></td>
            </tr>
            <tr></tr>
        <!-- hpp -->


    </table>

</div>

<script>
    $("#laporan").addClass("active");
</script>