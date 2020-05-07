<!-- modal stok parfum -->
    <div class="modal fade" id="modalStokParfum" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalStokParfumTitle">Tambah Stok Parfum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalStokParfum1">Data Stok</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalStokParfum2">Data Parfum</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body cus-font">
                            <form action="<?= base_url()?>admin/add_penyetokan" method="post">
                                <div id="formModalStokParfum1">
                                    <div class="form-group">
                                        <label for="tgl_penyetokan">Tgl Penyetokan</label>
                                        <input type="date" name="tgl_penyetokan" id="tgl_penyetokan" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <a href="#" id="btnNextformModalStokParfum1" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> data parfum</a>
                                    </div>
                                </div>
                                <div id="formModalStokParfum2">
                                    <div class="form-group">
                                        <label for="id_parfum">Parfum 1</label>
                                        <select name="id_parfum[]" class="form-control form-control-sm" required>
                                            <option value="">Pilih Parfum</option>
                                            <?php foreach ($parfum as $data) :?>
                                                <option value="<?= $data['id_parfum']?>"><?= $data['nama_parfum']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">QTY</label>
                                        <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                    </div>
                                    <div id="tambah-parfum"></div>
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm btn-danger mr-1" id="btnStokHapusParfum">hapus parfum</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btnStokTambahParfum">tambah parfum</a>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <a href="#" class="btn btn-sm btn-success" id="btnBackformModalStokParfum2"><i class="fa fa-arrow-left"></i> data penyetokan</a>
                                        <input type="submit" value="Tambah Data" class="btn btn-sm btn-primary" id="btnSubmitModalStokParfum">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal stok parfum -->


<!-- modal edit -->
    <div class="modal fade" id="modalEditPenyetokan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPenyetokanTitle">Edit Data Penyetokan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPenyetokan1">Data Penyetokan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPenyetokan2"><i class="fa fa-plus"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPenyetokan3"><i class="fa fa-trash-alt"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body cus-font">
                            <form action="<?= base_url()?>admin/edit_penyetokan_by_id" method="post" id="formModalEditPenyetokan1">
                                <input type="hidden" name="id_penyetokan" id="id_penyetokan_edit">
                                <div class="form-group">
                                    <label for="tgl_penyetokan">Tgl Penyetokan</label>
                                    <input type="date" name="tgl_penyetokan" id="tgl_penyetokan_edit" class="form-control form-control-sm" required>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <input type="submit" value="Edit Data" class="btn btn-sm btn-success" id="btnSubmitModalStokParfum2">
                                </div>
                            </form>

                            <form action="<?= base_url()?>admin/add_detail_penyetokan_by_id" method="post" id="formModalEditPenyetokan2">
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menambahkan data penyetokan parfum
                                </div>
                                <input type="hidden" name="id_penyetokan" id="id_penyetokan">
                                <div class="form-group">
                                    <label for="id_parfum">Parfum 1</label>
                                    <select name="id_parfum[]" class="form-control form-control-sm" required>
                                        <option value="">Pilih Parfum</option>
                                        <?php foreach ($parfum as $data) :?>
                                            <option value="<?= $data['id_parfum']?>"><?= $data['nama_parfum']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="qty">QTY</label>
                                    <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                </div>
                                <div id="tambah-parfum-edit"></div>
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="btn btn-sm btn-danger mr-1" id="btnEditHapusParfum">hapus parfum</a>
                                    <a href="#" class="btn btn-sm btn-success" id="btnEditTambahParfum">tambah parfum</a>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <input type="submit" value="Tambah Data" class="btn btn-sm btn-primary" id="btnSubmitModalStokParfum3">
                                </div>
                            </form>
                            
                            <form action="<?= base_url()?>admin/delete_detail_penyetokan_by_id" method="post" id="formModalEditPenyetokan3">
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menghapus data, jika terjadi kesalahan input. pilih item yang ingin dihapus kemudian pilih tombol hapus detail
                                </div>
                                <table width="100%" style="border: border-collapse">
                                    <tbody id="list-detail"></tbody>
                                </table>
                                <div class="d-flex justify-content-end mt-5">
                                    <input type="submit" value="Hapus Detail" class="btn btn-sm btn-danger" id="btnSubmitModalStokParfum4">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal edit -->
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

    <div class="card shadow mb-4" style="max-width:550px">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="#modalStokParfum" class="modal-add-penjualan nav-link bg-success text-light" data-toggle="modal">tambah stok</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <!-- <th width=5%>status</th> -->
                        <th width>Tgl Penyetokan</th>
                        <th width=10%>Stok</th>
                        <th width="8%">detail</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($penyetokan as $penyetokan) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= date('d-M-Y', strtotime($penyetokan['tgl_penyetokan']))?></td>
                                    <td><?= $penyetokan['stok']?></td>
                                    <td><a href="#modalEditPenyetokan" class="badge badge-warning modal-detail-penyetokan" data-toggle="modal" data-id="<?= $penyetokan['id_penyetokan']?>">detail</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#penyetokan").addClass("active");
    
    // modal add stok parfum
        $("#btnModalStokParfum1").addClass("active");
        $("#btnModalStokParfum2").removeClass("active");
        $("#formModalStokParfum1").show();
        $("#formModalStokParfum2").hide();

        $("#btnModalStokParfum1, #btnBackformModalStokParfum2").click(function(){
            $("#btnModalStokParfum1").addClass("active");
            $("#btnModalStokParfum2").removeClass("active");
            $("#formModalStokParfum1").show();
            $("#formModalStokParfum2").hide();
        })
        
        $("#btnModalStokParfum2, #btnNextformModalStokParfum1").click(function(){
            $("#btnModalStokParfum1").removeClass("active");
            $("#btnModalStokParfum2").addClass("active");
            $("#formModalStokParfum1").hide();
            $("#formModalStokParfum2").show();
        })
        
        // tambah data parfum
            var a = 1;
            var aurut = 1;
            
            var html = <?php echo json_encode($parfum, JSON_PRETTY_PRINT);?>;
            var parfum = '';
            for (let i = 0; i < html.length; i++) {
                parfum += '<option value="' +html[i].id_parfum+ '">' +html[i].nama_parfum+ '</option>';
            }

            $("#btnStokTambahParfum").click(function(e){
                e.preventDefault();
                a++;
                aurut++;
                $("#tambah-parfum").append(
                                            `<div class="form-group" id="aa`+a+`">
                                                <label for="id_parfum">Parfum `+aurut+`</label>
                                                <select name="id_parfum[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Parfum</option>`+parfum+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="bb`+a+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnStokHapusParfum").click(function(e){
                if(a != 1){
                    e.preventDefault();
                    $("#aa"+a).remove();
                    $("#bb"+a).remove();
                    a--;
                    aurut--;
                }
            })
        // tambah data parfum

    // modal add stok parfum

    // modal edit stok parfum
        $(".modal-detail-penyetokan") .click(function(){
            $("#btnModalEditPenyetokan1").addClass("active");
            $("#btnModalEditPenyetokan2").removeClass("active");
            $("#btnModalEditPenyetokan3").removeClass("active");
            $("#formModalEditPenyetokan1").show();
            $("#formModalEditPenyetokan2").hide();
            $("#formModalEditPenyetokan3").hide();

            let id = $(this).data("id");

            $.ajax({
                url: "<?= base_url()?>admin/get_penyetokan_by_id",
                data: {id: id},
                async: true,
                dataType: 'json',
                method: "POST",
                success: function(data){
                    $("#id_penyetokan").val(data.id_penyetokan);
                    $("#id_penyetokan_edit").val(data.id_penyetokan);
                    $("#tgl_penyetokan_edit").val(data.tgl_penyetokan);
                }
            })

            $.ajax({
                url: "<?= base_url()?>admin/get_detail_penyetokan_by_id_penyetokan",
                data: {id: id},
                async: true,
                dataType: 'json',
                method: "POST",
                success: function(data){
                    // console.log(data)
                    let html = "";

                    for (let i = 0; i < data.length; i++) {
                        html += `<tr style="border-bottom: 1px solid black">
                                    <td><input type="checkbox" class="mr-1" name="id[]" id=a"`+i+`" value="`+data[i].id_detail+`"><label for=a"`+i+`">`+data[i].nama_parfum+`</label></td>
                                    <td>x `+data[i].qty+`</td>
                                </tr>`;
                        
                    }

                    $("#list-detail").html(html);
                }
            })
        })

        $("#btnModalEditPenyetokan1").click(function(){
            $("#btnModalEditPenyetokan1").addClass("active");
            $("#btnModalEditPenyetokan2").removeClass("active");
            $("#btnModalEditPenyetokan3").removeClass("active");
            $("#formModalEditPenyetokan1").show();
            $("#formModalEditPenyetokan2").hide();
            $("#formModalEditPenyetokan3").hide();
        })
        
        $("#btnModalEditPenyetokan2").click(function(){
            $("#btnModalEditPenyetokan1").removeClass("active");
            $("#btnModalEditPenyetokan2").addClass("active");
            $("#btnModalEditPenyetokan3").removeClass("active");
            $("#formModalEditPenyetokan1").hide();
            $("#formModalEditPenyetokan2").show();
            $("#formModalEditPenyetokan3").hide();
        })
        
        $("#btnModalEditPenyetokan3").click(function(){
            $("#btnModalEditPenyetokan1").removeClass("active");
            $("#btnModalEditPenyetokan2").removeClass("active");
            $("#btnModalEditPenyetokan3").addClass("active");
            $("#formModalEditPenyetokan1").hide();
            $("#formModalEditPenyetokan2").hide();
            $("#formModalEditPenyetokan3").show();
        })
        
        // tambah data parfum
            var b = 1;
            var burut = 1;

            $("#btnEditTambahParfum").click(function(e){
                e.preventDefault();
                b++;
                burut++;
                $("#tambah-parfum-edit").append(
                                            `<div class="form-group" id="cc`+b+`">
                                                <label for="id_parfum">Parfum `+burut+`</label>
                                                <select name="id_parfum[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Parfum</option>`+parfum+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="dd`+b+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnEditHapusParfum").click(function(e){
                if(b != 1){
                    e.preventDefault();
                    $("#cc"+b).remove();
                    $("#dd"+b).remove();
                    b--;
                    burut--;
                }
            })
        // tambah data parfum

    // modal edit stok parfum

    // confirm
        $("#btnSubmitModalStokParfum").click(function(){
            var c = confirm('Yakin akan menambahkan penyetokan?');
            return c;
        })
        
        $("#btnSubmitModalStokParfum2").click(function(){
            var c = confirm('Yakin akan mengubah data penyetokan?');
            return c;
        })

        $("#btnSubmitModalStokParfum3").click(function(){
            var c = confirm('Yakin akan menambahkan penyetokan parfum?');
            return c;
        })

        $("#btnSubmitModalStokParfum4").click(function(){
            var c = confirm('Yakin akan menghapus penyetokan parfum?');
            return c;
        })
    // confirm

    // validation
        $('input[name="qty[]"').on('keyup', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    // validation
</script>