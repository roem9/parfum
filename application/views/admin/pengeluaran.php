<!-- modal add agen -->
    <div class="modal fade" id="modalAddPengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPengeluaranTitle">Tambah Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/add_pengeluaran" method="post">
                        <div class="form-group">
                            <label for="tgl">Tgl Pengeluaran</label>
                            <input type="date" name="tgl_pengeluaran" id="tgl_pengeluaran" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" name="nominal" id="nominal" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Pengeluaran" class="btn btn-sm btn-primary" id="btnSubmitModalAddPengeluaran">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add agen -->

<!-- modal edit agen -->
    <div class="modal fade" id="modalEditPengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPengeluaranTitle">Edit Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/edit_pengeluaran" method="post">
                        <input type="hidden" name="id_pengeluaran" id="id_pengeluaran_edit">
                        <div class="form-group">
                            <label for="tgl">Tgl Pengeluaran</label>
                            <input type="date" name="tgl_pengeluaran" id="tgl_pengeluaran_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" name="nominal" id="nominal_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Edit Pengeluaran" class="btn btn-sm btn-success" id="btnSubmitModalEditPengeluaran">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal edit agen -->

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
                    <a href="#modalAddPengeluaran" class="modal-add-agen nav-link bg-success text-light" data-toggle="modal">tambah pengeluaran</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tgl</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th width="10%">edit</th>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 0;
                            foreach ($pengeluaran as $pengeluaran) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= date("d-m-Y", strtotime($pengeluaran['tgl_pengeluaran']))?></td>
                                    <td><?= $pengeluaran['keterangan']?></td>
                                    <td><?= rupiah($pengeluaran['nominal'])?></td>
                                    <td><a href="#modalEditPengeluaran" data-toggle="modal" data-id="<?= $pengeluaran['id_pengeluaran']?>" class="modalEditPengeluaran badge badge-success">edit</a></td>
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
    $(".modalEditPengeluaran").click(function(){
        let id = $(this).data("id");
        $.ajax({
            url: "<?= base_url()?>admin/get_pengeluaran_by_id",
            data: {id: id},
            method: "POST",
            dataType: "json",
            async: true,
            success: function(data){
                $("#id_pengeluaran_edit").val(data.id_pengeluaran);
                $("#tgl_pengeluaran_edit").val(data.tgl_pengeluaran);
                $("#keterangan_edit").val(data.keterangan);
                $("#nominal_edit").val(data.nominal);
            }
        })
    })

    // validation
        $('input[name="nominal"').keyup(function(){
            $('input[name="nominal"').val(formatRupiah(this.value, 'Rp. '))
        })

    // confirm
        $("#btnSubmitModalEditPengeluaran").click(function(){
            var c = confirm("Yakin akan merubah data pengeluaran?");
            return c;
        })
        
        $("#btnSubmitModalAddPengeluaran").click(function(){
            var c = confirm("Yakin akan menambahkan data pengeluaran?");
            return c;
        })
</script>