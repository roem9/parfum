<!-- modal add barang -->
    <div class="modal fade" id="modalAddBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddBarangTitle">Tambah Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/add_barang" method="post">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Barang" class="btn btn-sm btn-primary" id="btn-add-form">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add barang -->

<!-- modal edit barang -->
    <div class="modal fade" id="modalEditBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditBarangTitle">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-edit-form-1">Data Bahan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-edit-form-2"><i class="fa fa-history"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url()?>admin/edit_barang_by_id" method="post" id="edit-form-1">
                                <input type="hidden" name="id_barang" id="id_barang_edit" required>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status_edit" class="form-control form-control-sm">
                                        <option value="">pilih status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="nama_barang_edit" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" id="harga_edit" class="form-control form-control-sm" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type="submit" value="Edit Data" id="btn-edit-barang" class="btn btn-sm btn-success">
                                </div>
                            </form>

                            <form action="<?= base_url()?>admin/delete_history_barang_by_id" method="post" id="edit-form-2">
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle text-info mr-1"></i> history perubahan harga, pilih data kemudian pilih menu hapus untuk menghapus history
                                </div>
                                <table width="100%" style="border: border-collapse" class="cus-font">
                                    <tbody id="list-history"></tbody>
                                </table>
                                <div id="btn"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal edit barang -->

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

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="max-width:700px">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="#modalAddBarang" class="modal-add-barang nav-link bg-success text-light" data-toggle="modal">tambah barang</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th width=10%>status</th>
                        <th>Nama Barang</th>
                        <th width=10%><center>Stok</center></th>
                        <th width="15%">Harga</th>
                        <th width="10%">Detail</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($barang as $barang) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= $barang['status']?></td>
                                    <td><?= $barang['nama_barang']?></td>
                                    <td><center><?= $barang['stok']?></center></td>
                                    <td><?= rupiah($barang['harga'])?></td>
                                    <td><a href="#modalEditBarang" data-id="<?= $barang['id_barang']?>" data-toggle="modal" class="modal-edit-barang badge badge-warning">detail</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#barang").addClass("active");

    $("#btn-edit-form-1").addClass("active");
    $("#btn-edit-form-2").removeClass("active");
    
    $("#edit-form-1").show();
    $("#edit-form-2").hide();

    $("#btn-edit-form-1").click(function(){
        $("#btn-edit-form-1").addClass("active");
        $("#btn-edit-form-2").removeClass("active");
        
        $("#edit-form-1").show();
        $("#edit-form-2").hide();
    })
    
    $("#btn-edit-form-2").click(function(){
        $("#btn-edit-form-1").removeClass("active");
        $("#btn-edit-form-2").addClass("active");
        
        $("#edit-form-1").hide();
        $("#edit-form-2").show();
    })

    $(".modal-edit-barang").click(function(){
        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>admin/get_barang_by_id",
            method: "POST",
            dataType: "json",
            async: true,
            data: {id: id},
            success: function(data){
                $("#id_barang_edit").val(data.id_barang);
                $("#status_edit").val(data.status);
                $("#nama_barang_edit").val(data.nama_barang);
                $("#harga_edit").val(formatRupiah(data.harga, "Rp. "));
            }
        })

        // history perubahan harga
        $.ajax({
            url: "<?= base_url()?>admin/get_history_barang_by_id",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                let harga = 0;

                harga = data[0].n_harga;

                reverse = harga.toString().split('').reverse().join(''),
                ribuan 	= reverse.match(/\d{1,3}/g);
                harga	= ribuan.join('.').split('').reverse().join('');

                let html = `<tr style="border-bottom: 1px solid black">
                    <td valign="top" colspan=2><b>Harga Sekarang</b></td>
                    <td valign="top" class="text-right"><b>Rp. `+harga+`</b></td>
                </tr>`;

                if(data[0].harga != null){
                    for (let i = 0; i < data.length; i++) {
                        harga = data[i].harga;

                        reverse = harga.toString().split('').reverse().join(''),
                        ribuan 	= reverse.match(/\d{1,3}/g);
                        harga	= ribuan.join('.').split('').reverse().join('');
                        
                        x = data[i].tgl;
                        x = x.split("-");
                        date = x[2]+'-'+x[1]+'-'+x[0];

                        html += `<tr style="border-bottom: 1px solid black">
                                    <td valign="top"><input type="checkbox" class="mr-1" name="id[]" id=a"`+i+`" value="`+data[i].id+`"> `+date+`</td>
                                    <td valign="top"><label for=a"`+i+`">`+data[i].nama_barang+`</label></td>
                                    <td valign="top" class="text-right">Rp `+harga+`</td>
                                </tr>`;
                        
                    }
                    
                    let html2 = `
                        <div class="d-flex justify-content-end mt-5">
                            <input type="submit" value="Hapus History" class="btn btn-sm btn-danger" id="btn-edit-3">
                        </div>`;

                    $("#btn").html(html2);
                }

                $("#list-history").html(html);
                

            }
        })
    })

    // confirm
        $("#btn-add-form").click(function(){
            var c = confirm("Yakin akan menambahkan data barang?");
            return c;
        })

        $("#btn-edit-barang").click(function(){
            var c = confirm("Yakin akan mengubah data barang?");
            return c;
        })
        
        $("#btn").on("click", "#btn-edit-3", function(){
            var c = confirm("Yakin akan menghapus history perubahan harga?");
            return c;
        })
        
    // confirm

    // validation form
        $("#harga").keyup(function(){
            $("#harga").val(formatRupiah(this.value, 'Rp. '))
        })
        
        $("#harga_edit").keyup(function(){
            $("#harga_edit").val(formatRupiah(this.value, 'Rp. '))
        })
    // validation form
</script>