<!-- modal add pembelian -->
    <div class="modal fade" id="modalAddPembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPembelianTitle">Tambah Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalAddPembelian1">Data Pembelian</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalAddPembelian2">Data Bahan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalAddPembelian3">Data Barang</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body cus-font">
                            <form action="<?= base_url()?>produksi/add_pembelian" method="post">
                                <div id="formModalAddPembelian1">
                                    <div class="form-group">
                                        <label for="tgl_pembelian">Tgl Pembelian</label>
                                        <input type="date" name="tgl_pembelian" id="tgl_pembelian" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="metode">Metode Pembayaran</label>
                                        <select name="metode" id="metode" class="form-control form-control-sm">
                                            <option value="">Pilih Metode Pembayaran</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    </div>
                                    <div id="form-transfer"></div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <a href="#" id="btnNextFormModalAddPembelian1" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> data bahan</a>
                                    </div>
                                </div>
                                <div id="formModalAddPembelian2">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menginputkan bahan yang dibeli
                                    </div>
                                    <div class="form-group">
                                        <label for="id_bahan">Bahan 1</label>
                                        <select name="id_bahan[]" class="form-control form-control-sm">
                                            <option value="">Pilih Bahan</option>
                                            <?php foreach ($bahan as $data) :?>
                                                <option value="<?= $data['id_bahan']?>"><?= $data['nama_bahan']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">QTY</label>
                                        <input type="text" name="qty[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" name="harga[]" class="form-control form-control-sm">
                                    </div>
                                    <div id="tambah-bahan"></div>
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalAddPembelian2">hapus bahan</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalAddPembelian2">tambah bahan</a>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <a href="#" class="btn btn-sm btn-success" id="btnBackFormModalAddPembelian2"><i class="fa fa-arrow-left"></i> data pembelian</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btnNextFormModalAddPembelian2"><i class="fa fa-arrow-right"></i> data barang</a>
                                    </div>
                                </div>
                                <div id="formModalAddPembelian3">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menginputkan barang yang dibeli
                                    </div>
                                    <div class="form-group">
                                        <label for="id_barang">Barang 1</label>
                                        <select name="id_barang[]" class="form-control form-control-sm">
                                            <option value="">Pilih Bahan</option>
                                            <?php foreach ($barang as $data) :?>
                                                <option value="<?= $data['id_barang']?>"><?= $data['nama_barang']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">QTY</label>
                                        <input type="text" name="qty_barang[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" name="harga_barang[]" class="form-control form-control-sm">
                                    </div>
                                    <div id="tambah-barang"></div>
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalAddPembelian3">hapus barang</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalAddPembelian3">tambah barang</a>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <a href="#" class="btn btn-sm btn-success" id="btnBackFormModalAddPembelian3"><i class="fa fa-arrow-left"></i> data bahan</a>
                                        <input type="submit" value="Tambah Pembelian" class="btn btn-sm btn-primary" id="btn-add-form">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal add pembelian -->

<!-- modal edit -->
    <div class="modal fade" id="modalEditPembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPembelianTitle">Edit Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPembelian1">Data Pembelian</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPembelian2">Data Bahan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPembelian3">Data Barang</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body cus-font">
                            <form action="<?= base_url()?>produksi/edit_pembelian_by_id" method="post" id="formModalEditPembelian1">
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk mengubah data pembelian
                                </div>
                                <input type="hidden" name="id_pembelian" id="id_pembelian_edit">
                                <div class="form-group">
                                    <label for="tgl_pembelian">Tgl Pembelian</label>
                                    <input type="date" name="tgl_pembelian" id="tgl_pembelian_edit" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama_edit" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="metode">Metode Pembayaran</label>
                                    <select name="metode" id="metode_edit" class="form-control form-control-sm">
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>
                                <div id="form-transfer-edit"></div>
                                <div class="d-flex justify-content-end">
                                    <input type="submit" value="Edit Data" class="btn btn-sm btn-success" id="btn-edit-form">
                                </div>
                            </form>

                            <div id="formModalEditPembelian2">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs">
                                            <li class="nav-item">
                                                <a href="#" class='nav-link' id="btnModalEditPembelian21"><i class="fa fa-trash-alt"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class='nav-link' id="btnModalEditPembelian22"><i class="fa fa-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url()?>produksi/delete_detail_pembelian_by_id" method="post" id="formModalEditPembelian21">
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menghapus data, jika terjadi kesalahan input. pilih item yang ingin dihapus kemudian pillih tombol hapus detail
                                            </div>
                                            <table width="100%" style="border-collapse: collapse">
                                                <tbody id="list-detail"></tbody>
                                            </table>
                                            <div class="d-flex justify-content-end mt-5">
                                                <input type="submit" value="Hapus Detail" class="btn btn-sm btn-danger" id="btn-edit-3">
                                            </div>
                                        </form>
                                        <form action="<?= base_url()?>produksi/add_detail_pembelian_by_id" method="post" id="formModalEditPembelian22">
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menambahkan bahan yang dibeli
                                            </div>
                                            <input type="hidden" name="id_pembelian" id="id_pembelian">
                                            <div class="form-group">
                                                <label for="id_bahan">Bahan 1</label>
                                                <select name="id_bahan[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Bahan</option>
                                                    <?php foreach ($bahan as $data) :?>
                                                        <option value="<?= $data['id_bahan']?>"><?= $data['nama_bahan']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input type="text" name="harga[]" class="form-control form-control-sm" required>
                                            </div>
                                            <div id="tambah-bahan-edit"></div>
                                            <div class="d-flex justify-content-end">
                                                <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalEditPembelian22">hapus bahan</a>
                                                <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalEditPembelian22">tambah bahan</a>
                                            </div>
                                            <div class="d-flex justify-content-end mt-2">
                                                <input type="submit" value="Tambah Detail" class="btn btn-sm btn-primary" id="btn-edit-form-detail">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="formModalEditPembelian3">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs">
                                            <li class="nav-item">
                                                <a href="#" class='nav-link' id="btnModalEditPembelian31"><i class="fa fa-trash-alt"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class='nav-link' id="btnModalEditPembelian32"><i class="fa fa-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url()?>produksi/delete_detail_pembelian_barang_by_id" method="post" id="formModalEditPembelian31">
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menghapus data, jika terjadi kesalahan input. pilih item yang ingin dihapus kemudian pillih tombol hapus detail
                                            </div>
                                            <table width="100%" style="border-collapse: collapse">
                                                <tbody id="list-detail-barang"></tbody>
                                            </table>
                                            <div class="d-flex justify-content-end mt-5">
                                                <input type="submit" value="Hapus Detail" class="btn btn-sm btn-danger" id="btn-edit-3">
                                            </div>
                                        </form>
                                        <form action="<?= base_url()?>produksi/add_detail_pembelian_barang_by_id" method="post" id="formModalEditPembelian32">
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menambahkan barang yang dibeli
                                            </div>
                                            <input type="hidden" name="id_pembelian" id="id_pembelian_barang">
                                            <div class="form-group">
                                                <label for="id_barang">Barang 1</label>
                                                <select name="id_barang[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Barang</option>
                                                    <?php foreach ($barang as $data) :?>
                                                        <option value="<?= $data['id_barang']?>"><?= $data['nama_barang']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty_barang[]" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input type="text" name="harga_barang[]" class="form-control form-control-sm" required>
                                            </div>
                                            <div id="tambah-barang-edit"></div>
                                            <div class="d-flex justify-content-end">
                                                <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalEditPembelian32">hapus barang</a>
                                                <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalEditPembelian32">tambah barang</a>
                                            </div>
                                            <div class="d-flex justify-content-end mt-2">
                                                <input type="submit" value="Tambah Detail" class="btn btn-sm btn-primary" id="btn-edit-form-detail">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal edit -->

<div class="container-fluid">

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

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="max-width:650px">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="#modalAddPembelian" class="modal-add-pembelian nav-link bg-success text-light" data-toggle="modal">tambah pembelian</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th width=12%><center>Tgl</center></th>
                        <th>Nama Lengkap</th>
                        <th width="20%">Total</th>
                        <th width="8%">detail</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($pembelian as $pembelian) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= date('d-m-Y', strtotime($pembelian['tgl_pembelian']))?></td>
                                    <td><?= $pembelian['nama']?></td>
                                    <td><?= rupiah($pembelian['total'])?></td>
                                    <td><a href="#modalEditPembelian" class="badge badge-warning modal-detail-pembelian" data-toggle="modal" data-id="<?= $pembelian['id_pembelian']?>">detail</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#pembelian").addClass("active");
    
    // modal add pembelian
        $("#metode").change(function(){
            let metode = $(this).val();
            if(metode == 'Transfer'){
                $("#form-transfer").append(`
                    <div class="form-group" id="form-trf">
                        <label for="rekening">Rekening</label>
                        <select name="rekening" id="rekening" class="form-control form-control-sm" required>
                            <option value="">Pilih Rekening</option>
                            <option value="BCA">BCA</option>
                            <option value="BRI">BRI</option>
                            <option value="Mandiri">Mandiri</option>
                        </select>
                    </div>
                `);
            } else {
                $("#form-trf").remove();
            }
        })

        $(".modal-add-pembelian").click(function(){
            $("#btnModalAddPembelian1").addClass("active");
            $("#btnModalAddPembelian2").removeClass("active");
            $("#btnModalAddPembelian3").removeClass("active");
            $("#formModalAddPembelian1").show();
            $("#formModalAddPembelian2").hide();
            $("#formModalAddPembelian3").hide();
            
            var a = 1;
            var aa = 1;
        })
        
        // tambah data bahan
            var a = 1;
            var aa = 1;

            var html = <?php echo json_encode($bahan, JSON_PRETTY_PRINT);?>;
            var option = '';
            var rupiah = '';
            for (let i = 0; i < html.length; i++) {
                option += '<option value="' +html[i].id_bahan+ '">' +html[i].nama_bahan+ ' ' +rupiah+ '</option>';
            }

            $("#btnTambahFormModalAddPembelian2").click(function(e){
                e.preventDefault();
                a++;
                aa++;
                $("#tambah-bahan").append(
                                            `<div class="form-group" id="a`+a+`">
                                                <label for="id_bahan">Bahan `+aa+`</label>
                                                <select name="id_bahan[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Bahan</option>`+option+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="aa`+a+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group" id="aaa`+a+`">
                                                <label for="harga">Harga</label>
                                                <input type="text" name="harga[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalAddPembelian2").click(function(e){
                if(a != 1){
                    e.preventDefault();
                    $("#a"+a).remove();
                    $("#aa"+a).remove();
                    $("#aaa"+a).remove();
                    a--;
                    aa--;
                }
            })
        // tambah data bahan
        
        // tambah data barang
            var b = 1;
            var bb = 1;

            var html = <?php echo json_encode($barang, JSON_PRETTY_PRINT);?>;
            var barang = '';
            for (let i = 0; i < html.length; i++) {
                barang += '<option value="' +html[i].id_barang+ '">' +html[i].nama_barang+ '</option>';
            }

            $("#btnTambahFormModalAddPembelian3").click(function(e){
                e.preventDefault();
                b++;
                bb++;
                $("#tambah-barang").append(
                                            `<div class="form-group" id="b`+b+`">
                                                <label for="id_barang">Barang `+bb+`</label>
                                                <select name="id_barang[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Barang</option>`+barang+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="bb`+b+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty_barang[]" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group" id="bbb`+b+`">
                                                <label for="harga">Harga</label>
                                                <input type="text" name="harga_barang[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalAddPembelian3").click(function(e){
                if(b != 1){
                    e.preventDefault();
                    $("#b"+b).remove();
                    $("#bb"+b).remove();
                    $("#bbb"+b).remove();
                    b--;
                    bb--;
                }
            })
        // tambah data barang
        
        
        // modal add
            $("#btnModalAddPembelian1, #btnBackFormModalAddPembelian2").click(function(){
                $("#btnModalAddPembelian1").addClass("active");
                $("#btnModalAddPembelian2").removeClass("active");
                $("#btnModalAddPembelian3").removeClass("active");
                $("#formModalAddPembelian1").show();
                $("#formModalAddPembelian2").hide();
                $("#formModalAddPembelian3").hide();
            })
            
            $("#btnModalAddPembelian2, #btnBackFormModalAddPembelian3, #btnNextFormModalAddPembelian1").click(function(){
                $("#btnModalAddPembelian1").removeClass("active");
                $("#btnModalAddPembelian2").addClass("active");
                $("#btnModalAddPembelian3").removeClass("active");
                $("#formModalAddPembelian1").hide();
                $("#formModalAddPembelian2").show();
                $("#formModalAddPembelian3").hide();
            })
            
            $("#btnModalAddPembelian3, #btnNextFormModalAddPembelian2").click(function(){
                $("#btnModalAddPembelian1").removeClass("active");
                $("#btnModalAddPembelian2").removeClass("active");
                $("#btnModalAddPembelian3").addClass("active");
                $("#formModalAddPembelian1").hide();
                $("#formModalAddPembelian2").hide();
                $("#formModalAddPembelian3").show();
            })
        // modal add
    // modal add pembelian

    // modal edit pembelian
        $("#metode_edit").change(function(){
            let metode = $(this).val();
            if(metode == 'Transfer'){
                $("#form-transfer-edit").append(`
                    <div class="form-group" id="form-trans">
                        <label for="rekening">Rekening</label>
                        <select name="rekening" id="rekening" class="form-control form-control-sm" required>
                            <option value="">Pilih Rekening</option>
                            <option value="BCA">BCA</option>
                            <option value="BRI">BRI</option>
                            <option value="Mandiri">Mandiri</option>
                        </select>
                    </div>
                `);
            } else {
                $("#form-trans").remove();
            }
        })

        $(".modal-detail-pembelian").click(function(){

            $("#form-trans").remove();
            
            $("#btnModalEditPembelian1").addClass("active");
            $("#btnModalEditPembelian2").removeClass("active");
            $("#btnModalEditPembelian3").removeClass("active");
            $("#formModalEditPembelian1").show();
            $("#formModalEditPembelian2").hide();
            $("#formModalEditPembelian3").hide();
            
            $("#btnModalEditPembelian21").removeClass("active");
            $("#btnModalEditPembelian22").removeClass("active");
            $("#formModalEditPembelian21").hide();
            $("#formModalEditPembelian22").hide();
            
            $("#btnModalEditPembelian31").removeClass("active");
            $("#btnModalEditPembelian32").removeClass("active");
            $("#formModalEditPembelian31").hide();
            $("#formModalEditPembelian32").hide();


            let id = $(this).data("id");

            $.ajax({
                url: "<?= base_url()?>produksi/get_pembelian_by_id",
                data: {id: id},
                async: true,
                dataType: 'json',
                method: "POST",
                success: function(data){
                    $("#id_pembelian_edit").val(data.id_pembelian);
                    $("#id_pembelian").val(data.id_pembelian);
                    $("#id_pembelian_barang").val(data.id_pembelian);
                    $("#tgl_pembelian_edit").val(data.tgl_pembelian);
                    $("#nama_edit").val(data.nama);
                    $("#no_hp_edit").val(data.no_hp);
                    $("#alamat_edit").val(data.alamat);
                    $("#metode_edit").val(data.metode);
                    if(data.rekening != ''){
                        $("#form-transfer-edit").append(`
                            <div class="form-group" id="form-trans">
                                <label for="rekening">Rekening</label>
                                <select name="rekening" id="rekening_edit" class="form-control form-control-sm" required>
                                    <option value="">Pilih Rekening</option>
                                    <option value="BCA">BCA</option>
                                    <option value="BRI">BRI</option>
                                    <option value="Mandiri">Mandiri</option>
                                </select>
                            </div>`);
                    }
                    $("#rekening_edit").val(data.rekening);
                }
            })
            
            $.ajax({
                url: "<?= base_url()?>produksi/get_detail_pembelian_by_id_pembelian",
                data: {id: id},
                async: true,
                dataType: 'json',
                method: "POST",
                success: function(data){
                    let html = '';
                    let total = 0;
                    for (let i = 0; i < data.length; i++) {
                        harga = data[i].harga;

                        reverse = harga.toString().split('').reverse().join(''),
                        ribuan 	= reverse.match(/\d{1,3}/g);
                        harga	= ribuan.join('.').split('').reverse().join('');

                        html += `
                            <tr style="border-bottom:1px solid black">
                                <td class="pl-2">
                                <input type="checkbox" class="mr-1" name="id_detail[]" id="`+i+`" value="`+data[i].id+`"><label for="`+i+`">`+data[i].nama_bahan+`</label></td>
                                <td class="text-center">`+data[i].qty+` `+data[i].satuan+`</td></li>
                                <td class="text-right">Rp `+harga+`</td>
                            </tr>`;
                        total = parseInt(total) + parseInt(data[i].harga);
                    }
                    
                    
                    reverse = total.toString().split('').reverse().join(''),
                    ribuan 	= reverse.match(/\d{1,3}/g);
                    total	= ribuan.join('.').split('').reverse().join('');

                    html += `
                        <tr>
                            <td><center><b>Total</b></center></td>
                            <td colspan=2 class="text-right">Rp `+total+`</td>
                        </tr>`
                    $("#list-detail").html(html);
                }
            })
            
            $.ajax({
                url: "<?= base_url()?>produksi/get_detail_pembelian_barang_by_id_pembelian",
                data: {id: id},
                async: true,
                dataType: 'json',
                method: "POST",
                success: function(data){
                    let html = '';
                    let total = 0;
                    for (let i = 0; i < data.length; i++) {
                        harga = data[i].harga;

                        reverse = harga.toString().split('').reverse().join(''),
                        ribuan 	= reverse.match(/\d{1,3}/g);
                        harga	= ribuan.join('.').split('').reverse().join('');

                        html += `
                            <tr style="border-bottom:1px solid black">
                                <td class="pl-2">
                                <input type="checkbox" class="mr-1" name="id_detail[]" id="`+i+`" value="`+data[i].id_detail+`"><label for="`+i+`">`+data[i].nama_barang+`</label></td>
                                <td class="text-center">`+data[i].qty+`</td></li>
                                <td class="text-right">Rp `+harga+`</td>
                            </tr>`;
                        total = parseInt(total) + parseInt(data[i].harga);
                    }
                    
                    
                    reverse = total.toString().split('').reverse().join(''),
                    ribuan 	= reverse.match(/\d{1,3}/g);
                    total	= ribuan.join('.').split('').reverse().join('');

                    html += `
                        <tr>
                            <td><center><b>Total</b></center></td>
                            <td colspan=2 class="text-right">Rp `+total+`</td>
                        </tr>`
                    $("#list-detail-barang").html(html);
                }
            })
        });
        
        // tambah data bahan
            var c = 1;
            var cc = 1;

            $("#btnTambahFormModalEditPembelian22").click(function(e){
                e.preventDefault();
                c++;
                cc++;
                $("#tambah-bahan-edit").append(
                                            `<div class="form-group" id="c`+c+`">
                                                <label for="id_bahan">Bahan `+cc+`</label>
                                                <select name="id_bahan[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Bahan</option>`+option+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="cc`+c+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group" id="ccc`+c+`">
                                                <label for="harga">Harga</label>
                                                <input type="text" name="harga[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalEditPembelian22").click(function(e){
                if(c != 1){
                    e.preventDefault();
                    $("#c"+c).remove();
                    $("#cc"+c).remove();
                    $("#ccc"+c).remove();
                    c--;
                    cc--;
                }
            })
        // tambah data bahan
        
        // tambah data barang
            var d = 1;
            var dd = 1;

            $("#btnTambahFormModalEditPembelian32").click(function(e){
                e.preventDefault();
                d++;
                dd++;
                $("#tambah-barang-edit").append(
                                            `<div class="form-group" id="d`+d+`">
                                                <label for="id_barang">Barang `+dd+`</label>
                                                <select name="id_barang[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Barang</option>`+barang+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="dd`+d+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty_barang[]" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="form-group" id="ddd`+d+`">
                                                <label for="harga">Harga</label>
                                                <input type="text" name="harga_barang[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalEditPembelian32").click(function(e){
                if(d != 1){
                    e.preventDefault();
                    $("#d"+d).remove();
                    $("#dd"+d).remove();
                    $("#ddd"+d).remove();
                    d--;
                    dd--;
                }
            })
        // tambah data barang
        
        // modal edit
            $("#btnModalEditPembelian1").click(function(){
                $("#btnModalEditPembelian1").addClass("active");
                $("#btnModalEditPembelian2").removeClass("active");
                $("#btnModalEditPembelian3").removeClass("active");
                $("#formModalEditPembelian1").show();
                $("#formModalEditPembelian2").hide();
                $("#formModalEditPembelian3").hide();
            })
            
            $("#btnModalEditPembelian2").click(function(){
                $("#btnModalEditPembelian1").removeClass("active");
                $("#btnModalEditPembelian2").addClass("active");
                $("#btnModalEditPembelian3").removeClass("active");
                $("#formModalEditPembelian1").hide();
                $("#formModalEditPembelian2").show();
                $("#formModalEditPembelian3").hide();
                
                $("#btnModalEditPembelian21").addClass("active");
                $("#btnModalEditPembelian22").removeClass("active");
                $("#formModalEditPembelian21").show();
                $("#formModalEditPembelian22").hide();
            })
            
            $("#btnModalEditPembelian3").click(function(){
                $("#btnModalEditPembelian1").removeClass("active");
                $("#btnModalEditPembelian2").removeClass("active");
                $("#btnModalEditPembelian3").addClass("active");
                $("#formModalEditPembelian1").hide();
                $("#formModalEditPembelian2").hide();
                $("#formModalEditPembelian3").show();
                
                $("#btnModalEditPembelian31").addClass("active");
                $("#btnModalEditPembelian32").removeClass("active");
                $("#formModalEditPembelian31").show();
                $("#formModalEditPembelian32").hide();
            })

            // sub menu
                $("#btnModalEditPembelian21").click(function(){
                    $("#btnModalEditPembelian21").addClass("active");
                    $("#btnModalEditPembelian22").removeClass("active");
                    $("#formModalEditPembelian21").show();
                    $("#formModalEditPembelian22").hide();
                })
                
                $("#btnModalEditPembelian22").click(function(){
                    $("#btnModalEditPembelian21").removeClass("active");
                    $("#btnModalEditPembelian22").addClass("active");
                    $("#formModalEditPembelian21").hide();
                    $("#formModalEditPembelian22").show();
                })
                
                $("#btnModalEditPembelian31").click(function(){
                    $("#btnModalEditPembelian31").addClass("active");
                    $("#btnModalEditPembelian32").removeClass("active");
                    $("#formModalEditPembelian31").show();
                    $("#formModalEditPembelian32").hide();
                })
                
                $("#btnModalEditPembelian32").click(function(){
                    $("#btnModalEditPembelian31").removeClass("active");
                    $("#btnModalEditPembelian32").addClass("active");
                    $("#formModalEditPembelian31").hide();
                    $("#formModalEditPembelian32").show();
                })
            // sub menu

        // modal edit
    // modal edit pembelian

    // confirm
        $("#btn-add-form").click(function(){
            var c = confirm('Yakin akan menambahkan pembelian?');
            return c;
        })

        $("#btn-edit-form").click(function(){
            var c = confirm('Yakin akan mengubah data pembelian?');
            return c;
        })

        $("#btn-edit-form-detail").click(function(){
            var c = confirm('Yakin akan menambahkan detail pembelian?');
            return c;
        })

        $("#btn-edit-3").click(function(){
            var c = confirm('Yakin akan menghapus detail pembelian?');
            return c;
        })
    // confirm

    // validation
        $('#formModalAddPembelian2').on('keyup', 'input[name^="harga"]', function(){
            $(this).val(formatRupiah(this.value, 'Rp. '))
        })
        
        $('#formModalAddPembelian3').on('keyup', 'input[name^="harga_barang"]', function(){
            $(this).val(formatRupiah(this.value, 'Rp. '))
        })
        
        $('#formModalEditPembelian2').on('keyup', 'input[name^="harga"]', function(){
            $(this).val(formatRupiah(this.value, 'Rp. '))
        })
        
        $('#formModalEditPembelian3').on('keyup', 'input[name^="harga_barang"]', function(){
            $(this).val(formatRupiah(this.value, 'Rp. '))
        })

        $('input[name="qty[]"').on('keyup', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        $('input[name="qty_barang[]"').on('keyup', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    // validation
</script>