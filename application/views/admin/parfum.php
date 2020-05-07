<!-- modal add parfum -->
    <div class="modal fade" id="modalAddParfum" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddParfumTitle">Tambah Data Parfum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-add-form-1">Data Parfum</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-add-form-2">Data Bahan Parfum</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body cus-font">
                            <form action="<?= base_url()?>admin/add_parfum" method="post">
                                <div id="form-add-1">
                                    <div class="form-group">
                                        <label for="nama_parfum">Nama Parfum</label>
                                        <input type="text" name="nama_parfum" id="nama_parfum" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" name="harga" id="harga" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="min_stok">Stok Minimal</label>
                                        <input type="text" name="min_stok" id="min_stok" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <a href="#" id="next-form-1" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> data bahan</a>
                                    </div>
                                </div>
                                <div id="form-add-2">
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
                                    <div id="tambah-bahan"></div>
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm btn-danger mr-1" id="btn-hapus-add-form">hapus bahan</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btn-tambah-add-form">tambah bahan</a>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <a href="#" class="btn btn-sm btn-success" id="back-form-2"><i class="fa fa-arrow-left"></i> data parfum</a>
                                        <input type="submit" value="Tambah Data" class="btn btn-sm btn-primary" id="btn-add-form">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal add parfum -->

<!-- modal edit parfum -->
    <div class="modal fade" id="modalEditParfum" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditParfumTitle">Edit Data Parfum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-edit-form-1">Data Parfum</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-edit-form-2">Komposisi</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btn-edit-form-3"><i class="fa fa-history"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body cus-font">
                            <form action="<?= base_url()?>admin/edit_parfum_by_id" method="post" id="form-edit-1">
                                <input type="hidden" name="id_parfum" id="id_parfum_edit" required>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status_edit" class="form-control form-control-sm">
                                        <option value="">pilih status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_parfum">Nama Parfum</label>
                                    <input type="text" name="nama_parfum" id="nama_parfum_edit" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" id="harga_edit" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="min_stok">Stok Minimal</label>
                                    <input type="text" name="min_stok" id="min_stok_edit" class="form-control form-control-sm" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type="submit" value="Edit Data" id="btn-edit-parfum" class="btn btn-sm btn-success">
                                </div>
                            </form>

                            <div id="form-edit-2">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs">
                                            <li class="nav-item">
                                                <a href="#" class='nav-link' id="btn-sub-form-1"><i class="fa fa-trash-alt"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class='nav-link' id="btn-sub-form-2"><i class="fa fa-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url()?>admin/delete_bahan_parfum_by_id" method="post" id="form-sub-1">
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle text-info mr-1"></i> komposisi parfum, pilih bahan kemudian pilih hapus jika ingin menghapus bahan dari komposisi
                                            </div>
                                            <table width=100% style="border-collapse: collapse">
                                                <tbody id="list-detail"></tbody>
                                            </table>
                                            <div class="d-flex justify-content-end mt-5">
                                                <input type="submit" value="Hapus Detail" class="btn btn-danger btn-sm" id="btn-delete">
                                            </div>
                                        </form>
                                        
                                        <form action="<?= base_url()?>admin/add_bahan_parfum_by_id" method="post" id="form-sub-2">
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menambahkan bahan komposisi
                                            </div>
                                            <input type="hidden" name="id_parfum" id="id_parfum" required>
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
                                            <div id="tambah-bahan-edit"></div>
                                            <div class="d-flex justify-content-end">
                                                <a href="#" class="btn btn-sm btn-danger mr-1" id="btn-hapus-edit-form">hapus bahan</a>
                                                <a href="#" class="btn btn-sm btn-success" id="btn-tambah-edit-form">tambah bahan</a>
                                            </div>
                                            <div class="d-flex justify-content-end mt-2">
                                                <input type="submit" value="Tambah Data" class="btn btn-sm btn-primary" id="btn-edit-form">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="<?= base_url()?>admin/delete_history_parfum_by_id" method="post" id="form-edit-3">
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
<!-- modal edit parfum -->

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
    <div class="card shadow mb-4" style="max-width:850px">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="#modalAddParfum" class="modal-add-parfum nav-link bg-success text-light" data-toggle="modal">tambah parfum</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th width=10%>status</th>
                        <th>Nama Parfum</th>
                        <th width="12%">Min Stok</th>
                        <th width="12%"><center>Stok</center></th>
                        <th width="15%">Harga</th>
                        <th width="10%">Detail</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($parfum as $data) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= $data['status']?></td>
                                    <td><?= $data['nama_parfum']?></td>
                                    <td><center><?= $data['min_stok']?></center></td>
                                    <td><center><?= $data['stok']?></center></td>
                                    <td><?= rupiah($data['harga'])?></td>
                                    <td><a href="#modalEditParfum" data-id="<?= $data['id_parfum']?>" data-toggle="modal" class="modal-edit-parfum badge badge-warning">detail</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#parfum").addClass("active");

    $(".modal-edit-parfum").click(function(){
        var y = 1;
        var urut1 = 1;

        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>admin/get_parfum_by_id",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                $("#modalEditParfumTitle").html(data.nama_parfum);
                $("#id_parfum_edit").val(data.id_parfum);
                $("#id_parfum").val(data.id_parfum);
                $("#status_edit").val(data.status);
                $("#nama_parfum_edit").val(data.nama_parfum);
                $("#harga_edit").val(formatRupiah(data.harga, 'Rp. '));
                $("#min_stok_edit").val(data.min_stok);
            }
        })
        
        $.ajax({
            url: "<?= base_url()?>admin/get_bahan_parfum_by_id_parfum",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                let html = "";
                for (let i = 0; i < data.length; i++) {
                    html += `<tr style="border-bottom: 1px solid black">
                                <td><input type="checkbox" class="mr-1" name="id[]" id="`+data[i].id+`" value="`+data[i].id+`"><label for="`+data[i].id+`">`+data[i].nama_bahan+`</label></td>
                                <td>`+data[i].qty+``+data[i].satuan+`</td>
                            </tr>`;
                }

                $("#list-detail").html(html);
            }
        })

        // history perubahan harga
        $.ajax({
            url: "<?= base_url()?>admin/get_history_parfum_by_id",
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
                    <td valign="top" colspan=2><b>`+data[0].nama_parfum+`</b></td>
                    <td valign="top"><b>`+data[0].n_min_stok+`</b></td>
                    <td valign="top" class="text-right"><b>Rp. `+harga+`</b></td>
                </tr>`;

                if(data[0].harga != null){
                    for (let i = 1; i < data.length; i++) {
                        harga = data[i].harga;

                        reverse = harga.toString().split('').reverse().join(''),
                        ribuan 	= reverse.match(/\d{1,3}/g);
                        harga	= ribuan.join('.').split('').reverse().join('');
                        
                        x = data[i].tgl;
                        x = x.split("-");
                        date = x[2]+'-'+x[1]+'-'+x[0];

                        html += `<tr style="border-bottom: 1px solid black">
                                    <td valign="top"><input type="checkbox" class="mr-1" name="id[]" id=a"`+i+`" value="`+data[i].id+`"> `+date+`</td>
                                    <td valign="top"><label for=a"`+i+`">`+data[i].nama_parfum+`</label></td>
                                    <td valign="top"><b>`+data[i].min_stok+`</b></td>
                                    <td valign="top" class="text-right">Rp `+harga+`</td>
                                </tr>`;
                        
                    }
                    
                    let html2 = `
                        <div class="d-flex justify-content-end mt-5">
                            <input type="submit" value="Hapus Detail" class="btn btn-sm btn-danger" id="btn-edit-3">
                        </div>`;

                    $("#btn").html(html2);
                }

                $("#list-history").html(html);
                

            }
        })
    })

    $(".modal-add-parfum").click(function(){
        $("#btn-add-form-1").addClass("active");
        $("#btn-add-form-2").removeClass("active");
        $("#form-add-1").show();
        $("#form-add-2").hide();
        
        var x = 1;
        var urut = 1;
    })
    
    // input kata
        var x = 1;
        var urut = 1;

        var html = <?php echo json_encode($bahan, JSON_PRETTY_PRINT);?>;
        var option = '';
        for (let i = 0; i < html.length; i++) {
            option += '<option value="' +html[i].id_bahan+ '">' +html[i].nama_bahan+ '</option>';
        }

        $("#btn-tambah-add-form").click(function(e){
            e.preventDefault();
            x++;
            urut++;
            $("#tambah-bahan").append(
                                        `<div class="form-group" id="a`+x+`">
                                            <label for="id_bahan">Bahan `+urut+`</label>
                                            <select name="id_bahan[]" class="form-control form-control-sm" required>
                                                <option value="">Pilih Bahan</option>`+option+`
                                            </select>
                                        </div>
                                        <div class="form-group" id="b`+x+`">
                                            <label for="qty">QTY</label>
                                            <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                        </div>`);
        })

        $("#btn-hapus-add-form").click(function(e){
            if(x != 1){
                e.preventDefault();
                $("#a"+x).remove();
                $("#b"+x).remove();
                x--;
                urut--;
            }
        })
    // input kata

    // edit kata
        var y = 1;
        var urut1 = 1;

        $("#btn-tambah-edit-form").click(function(e){
            e.preventDefault();
            y++;
            urut1++;
            $("#tambah-bahan-edit").append(
                                        `<div class="form-group" id="a`+y+`">
                                            <label for="id_bahan">Bahan `+urut1+`</label>
                                            <select name="id_bahan[]" class="form-control form-control-sm" required>
                                                <option value="">Pilih Bahan</option>`+option+`
                                            </select>
                                        </div>
                                        <div class="form-group" id="b`+y+`">
                                            <label for="qty">QTY</label>
                                            <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                        </div>`);
        })

        $("#btn-hapus-edit-form").click(function(e){
            if(y != 1){
                e.preventDefault();
                $("#a"+y).remove();
                $("#b"+y).remove();
                y--;
                urut1--;
            }
        })
    // edit kata
    
    // add form
        $("#btn-add-form-1").click(function(){
            $("#btn-add-form-1").addClass("active");
            $("#btn-add-form-2").removeClass("active");
            $("#form-add-1").show();
            $("#form-add-2").hide();
        })
        
        $("#btn-add-form-2").click(function(){
            $("#btn-add-form-1").removeClass("active");
            $("#btn-add-form-2").addClass("active");
            $("#form-add-1").hide();
            $("#form-add-2").show();
        })
        
        $("#next-form-1").click(function(){
            $("#btn-add-form-1").removeClass("active");
            $("#btn-add-form-2").addClass("active");
            $("#form-add-1").hide();
            $("#form-add-2").show();
        })

        $("#back-form-2").click(function(){
            $("#btn-add-form-1").addClass("active");
            $("#btn-add-form-2").removeClass("active");
            $("#form-add-1").show();
            $("#form-add-2").hide();
        })
    // add form
    
    // edit form
        $("#btn-edit-form-1").addClass("active");
        $("#btn-edit-form-2").removeClass("active");
        $("#btn-edit-form-3").removeClass("active");
        $("#form-edit-1").show();
        $("#form-edit-2").hide();
        $("#form-edit-3").hide();
        

        $("#btn-edit-form-1").click(function(){
            $("#btn-edit-form-1").addClass("active");
            $("#btn-edit-form-2").removeClass("active");
            $("#btn-edit-form-3").removeClass("active");
            $("#form-edit-1").show();
            $("#form-edit-2").hide();
            $("#form-edit-3").hide();
        })
        
        $("#btn-edit-form-2").click(function(){
            $("#btn-edit-form-1").removeClass("active");
            $("#btn-edit-form-2").addClass("active");
            $("#btn-edit-form-3").removeClass("active");
            $("#form-edit-1").hide();
            $("#form-edit-2").show();
            $("#form-edit-3").hide();
            
            $("#btn-sub-form-1").addClass("active");
            $("#btn-sub-form-2").removeClass("active");
            $("#form-sub-1").show();
            $("#form-sub-2").hide();
        })
        
        $("#btn-edit-form-3").click(function(){
            $("#btn-edit-form-1").removeClass("active");
            $("#btn-edit-form-2").removeClass("active");
            $("#btn-edit-form-3").addClass("active");
            $("#form-edit-1").hide();
            $("#form-edit-2").hide();
            $("#form-edit-3").show();
        })

        $("#btn-sub-form-1").click(function(){
            $("#btn-sub-form-1").addClass("active");
            $("#btn-sub-form-2").removeClass("active");
            $("#form-sub-1").show();
            $("#form-sub-2").hide();
        })

        $("#btn-sub-form-2").click(function(){
            $("#btn-sub-form-1").removeClass("active");
            $("#btn-sub-form-2").addClass("active");
            $("#form-sub-1").hide();
            $("#form-sub-2").show();
        })

    // edit form

    // confirm
        $("#btn-add-form").click(function(){
            var c = confirm("Yakin akan menambahkan data parfum?");
            return c;
        })

        $("#btn-edit-parfum").click(function(){
            var c = confirm("Yakin akan mengubah data parfum?");
            return c;
        })
        
        $("#btn-delete").click(function(){
            var c = confirm("Yakin akan menghapus komposisi parfum?");
            return c;
        })

        $("#btn-edit-form").click(function(){
            var c = confirm("Yakin akan menambahkan komposisi parfum?");
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

        $('input[name="min_stok"').on('keyup', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        $('input[name="qty[]"').on('keyup', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    // validation form
</script>