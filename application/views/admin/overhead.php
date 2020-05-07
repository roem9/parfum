<!-- modal add barang -->
    <div class="modal fade" id="modalAddOverhead" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddOverheadTitle">Tambah Overhead</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/add_overhead" method="post">
                        <div class="form-group">
                            <label for="tgl">Tgl</label>
                            <input type="date" name="tgl" id="tgl" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <select name="jenis" id="jenis" class="form-control form-control-sm">
                                <option value="">Pilih Jenis</option>
                                <option value="Iklan">Biaya Iklan</option>
                                <option value="CS">Biaya CS</option>
                                <option value="Makan">Biaya Makan</option>
                                <option value="Gaji">Biaya Gaji</option>
                                <option value="Kontrakan">Biaya Kontrakan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" name="nominal" id="nominal" class="form-control form-control-sm">
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Overhead" class="btn btn-sm btn-primary" id="btnSubmitmodalAddOverhead1">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add barang -->

<!-- modal edit barang -->
    <div class="modal fade" id="modalEditOverhead" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditOverheadTitle">Edit Overhead</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/edit_overhead_by_id" method="post">
                        <input type="hidden" name="id" id="id_overhead">
                        <div class="form-group">
                            <label for="tgl">Tgl</label>
                            <input type="date" name="tgl" id="tgl_edit" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <select name="jenis" id="jenis_edit" class="form-control form-control-sm">
                                <option value="">Pilih Jenis</option>
                                <option value="Iklan">Biaya Iklan</option>
                                <option value="CS">Biaya CS</option>
                                <option value="Makan">Biaya Makan</option>
                                <option value="Gaji">Biaya Gaji</option>
                                <option value="Kontrakan">Biaya Kontrakan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" name="nominal" id="nominal_edit" class="form-control form-control-sm">
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Edit Overhead" class="btn btn-sm btn-success" id="btnSubmitmodalEditOverhead1">
                        </div>
                    </form>
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
    <div class="card shadow mb-4" style="max-width:650px">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="#modalAddOverhead" class="modal-add-overhead nav-link bg-success text-light" data-toggle="modal">tambah overhead</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th>Jenis</th>
                        <th width=20%>Tgl</th>
                        <th>Nominal</th>
                        <th width=10%>edit</th>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 0;
                            foreach ($overhead as $overhead) :?>
                            <tr>
                                <td><center><?= ++$no?></center></td>
                                <td><?= $overhead['jenis']?></td>
                                <td><?= $overhead['tgl']?></td>
                                <td><?= rupiah($overhead['nominal'])?></td>
                                <td><a href="#modalEditOverhead" data-toggle="modal" data-id="<?= $overhead['id']?>" class="modalEditOverhead badge badge-success">edit</a></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#overhead").addClass("active");

    $(".modalEditOverhead").click(function(){
        
        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>admin/get_overhead_by_id",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                $("#id_overhead").val(data.id);
                $("#tgl_edit").val(data.tgl);
                $("#jenis_edit").val(data.jenis);
                $("#nominal_edit").val(formatRupiah(data.nominal, 'Rp. '));
            }
        })
    })
    
    // validation
        $("input[name='nominal']").keyup(function(){
            $("input[name='nominal']").val(formatRupiah(this.value, 'Rp. '))
        })
    // validation

    // confirm
        $("#btnSubmitmodalAddOverhead1").click(function(){
            var c = confirm("Yakin akan menambahkan overhead?")
            return c;
        })

        $("#btnSubmitmodalEditOverhead1").click(function(){
            var c = confirm("Yakin akan merubah overhead?")
            return c;
        })
    // confirm
</script>