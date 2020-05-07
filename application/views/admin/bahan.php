<!-- modal edit bahan -->
    <div class="modal fade" id="modalEditBahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditBahanTitle">Edit Data Bahan</h5>
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
                            <form action="<?= base_url()?>admin/edit_bahan_by_id" method="post" id="edit-form-1">
                                <input type="hidden" name="id_bahan" id="id_bahan_edit" required>
                                <div class="form-group">
                                    <label for="nama_bahan_edit">Nama Bahan</label>
                                    <input type="text" name="nama_bahan" id="nama_bahan_edit" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis Bahan</label>
                                    <select name="jenis" id="jenis_edit" class="form-control form-control-sm">
                                        <option value="">Pilih Jenis Bahan</option>
                                        <option value="Baku">Baku</option>
                                        <option value="Pembantu">Pembantu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="satuan_edit">Satuan (QTY)</label>
                                    <input type="text" name="satuan" id="satuan_edit" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_satuan">Harga Satuan</label>
                                    <input type="text" name="harga_satuan" id="harga_satuan_edit" class="form-control form-control-sm" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type="submit" value="Ubah Data" class="btn btn-sm btn-success" id="btn-edit-bahan">
                                </div>
                            </form>

                            <form action="<?= base_url()?>admin/delete_history_bahan_by_id" method="post" id="edit-form-2">
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
<!-- modal edit bahan -->

<!-- modal add bahan -->
    <div class="modal fade" id="modalAddBahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddBahanTitle">Tambah Data Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/add_bahan" method="post">
                        <input type="hidden" name="id_bahan" id="id_bahan_edit">
                        <div class="form-group">
                            <label for="nama_bahan_edit">Nama Bahan</label>
                            <input type="text" name="nama_bahan" id="nama_bahan" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Bahan</label>
                            <select name="jenis" id="jenis" class="form-control form-control-sm">
                                <option value="">Pilih Jenis Bahan</option>
                                <option value="Baku">Baku</option>
                                <option value="Pembantu">Pembantu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="satuan_edit">Satuan (QTY)</label>
                            <input type="text" name="satuan" id="satuan" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_satuan">Harga Satuan</label>
                            <input type="text" name="harga_satuan" id="harga_satuan" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Data" class="btn btn-sm btn-primary" id="btn-add-bahan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add bahan -->

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

    <div class="card shadow mb-4" style="max-width:800px">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="#modalAddBahan" class="nav-link bg-success text-light" data-toggle="modal">tambah bahan</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama Bahan</th>
                        <th width="15%">Ketersediaan</th>
                        <th width="15%">Harga</th>
                        <th width="10%">Detail</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($bahan as $bahan) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= $bahan['nama_bahan']?></td>
                                    <td><center><?= $bahan['ketersediaan'] . " " . $bahan['satuan']?></center></td>
                                    <td><?= rupiah($bahan['harga_satuan']) . "/" . $bahan['satuan']?></td>
                                    <td><a href="#modalEditBahan" data-toggle="modal" data-id="<?= $bahan['id_bahan']?>" class="modal-edit-bahan badge badge-warning">Detail</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#bahan").addClass("active");

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

    $(".modal-edit-bahan").click(function(){
        $("#btn").html("");
        
        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>admin/get_bahan_by_id",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                $("#modalEditBahanTitle").html(data.nama_bahan);
                $("#id_bahan_edit").val(data.id_bahan);
                $("#jenis_edit").val(data.jenis);
                $("#nama_bahan_edit").val(data.nama_bahan);
                $("#satuan_edit").val(data.satuan);
                $("#harga_satuan_edit").val(formatRupiah(data.harga_satuan, "Rp. "));
            }
        })

        // history perubahan harga
        $.ajax({
            url: "<?= base_url()?>admin/get_history_bahan_by_id",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                let harga = 0;

                harga = data[0].harga;

                reverse = harga.toString().split('').reverse().join(''),
                ribuan 	= reverse.match(/\d{1,3}/g);
                harga	= ribuan.join('.').split('').reverse().join('');

                let html = `<tr style="border-bottom: 1px solid black">
                    <td valign="top" colspan=2><b>Harga Sekarang</b></td>
                    <td valign="top" class="text-right"><b>Rp. `+harga+`</b></td>
                </tr>`;

                if(data[0].harga_satuan != null){
                    for (let i = 0; i < data.length; i++) {
                        harga = data[i].harga_satuan;

                        reverse = harga.toString().split('').reverse().join(''),
                        ribuan 	= reverse.match(/\d{1,3}/g);
                        harga	= ribuan.join('.').split('').reverse().join('');
                        
                        x = data[i].tgl;
                        x = x.split("-");
                        date = x[2]+'-'+x[1]+'-'+x[0];

                        html += `<tr style="border-bottom: 1px solid black">
                                    <td valign="top"><input type="checkbox" class="mr-1" name="id[]" id=a"`+i+`" value="`+data[i].id+`"> `+date+`</td>
                                    <td valign="top"><label for=a"`+i+`">`+data[i].nama_bahan+`</label></td>
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
        $("#btn-edit-bahan").click(function(){
            var c = confirm("Yakin akan mengubah data bahan?");
            return c;
        })

        $("#btn-add-bahan").click(function(){
            var c = confirm("Yakin akan menambahkan data bahan?");
            return c;
        })

        $("#btn").on("click", "#btn-edit-3", function(){
            var c = confirm("Yakin akan menghapus history perubahan harga?");
            return c;
        })
    // confirm

    // validation
        $("#harga_satuan_edit").keyup(function(){
            $("#harga_satuan_edit").val(formatRupiah(this.value, "Rp. "))
        })
        
        $("#harga_satuan").keyup(function(){
            $("#harga_satuan").val(formatRupiah(this.value, "Rp. "))
        })
    // validation
</script>