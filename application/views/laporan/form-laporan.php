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

    <div class="row">
        <div class="col-12 col-md-6">
            <form action="<?= base_url()?>laporan/cetak_laporan" method="post">
                <div class="form-group">
                    <label for="laporan">Jenis Laporan</label>
                    <select name="laporan" id="laporan" class="form-control form-control-sm">
                        <option value="">Pilih Laporan</option>
                        <option value="Laporan Penjualan Keseluruhan">Laporan Penjualan Keseluruhan</option>
                        <option value="Laporan Penjualan Transfer">Laporan Penjualan Transfer</option>
                        <option value="Laporan Penjualan Sales">Laporan Penjualan Sales</option>
                        <option value="Laporan Penjualan Agen">Laporan Penjualan Agen</option>
                        <option value="Laporan Penjualan Barang">Laporan Penjualan Barang</option>
                        <option value="Laporan Pembelian Barang">Laporan Pembelian Barang</option>
                        <option value="Laporan Pembelian Barang Transfer">Laporan Pembelian Barang Transfer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control form-control-sm">
                        <option value="">Pilih Bulan</option>
                        <?php foreach ($month as $i => $month) :?>
                            <option value="<?= $i?>"><?= $month?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control form-control-sm">
                        <option value="">Pilih Tahun</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end">
                    <input type="submit" value="Cetak Laporan" class="btn btn-sm btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#laporan").addClass("active");
</script>