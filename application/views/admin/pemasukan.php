<!-- modal add agen -->
    <div class="modal fade" id="modalAddPemasukan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPemasukanTitle">Tambah Pemasukan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/add_pemasukan" method="post">
                        <div class="form-group">
                            <label for="keterangan">Jenis Pemasukan</label>
                            <select name="keterangan" id="keterangan" class="form-control form-control-sm">
                                <option value="">Pilih Pemasukan</option>
                                <option value="Agen">Pemasukan Agen</option>
                                <option value="Shopee">Pemasukan Shopee</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl">Tgl Pemasukan</label>
                            <input type="date" name="tgl_pemasukan" id="tgl_pemasukan" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" name="nominal" id="nominal" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Pemasukan" class="btn btn-sm btn-primary" id="btnSubmitModalAddPemasukan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add agen -->

<!-- modal edit agen -->
    <div class="modal fade" id="modalEditPemasukan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPemasukanTitle">Edit Pemasukan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/edit_pemasukan" method="post">
                        <input type="hidden" name="id_pemasukan" id="id_pemasukan_edit">
                        <div class="form-group">
                            <label for="tgl">Tgl Pemasukan</label>
                            <input type="date" name="tgl_pemasukan" id="tgl_pemasukan_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama_edit" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Jenis Pemasukan</label>
                            <select name="keterangan" id="keterangan_edit" class="form-control form-control-sm">
                                <option value="">Pilih Pemasukan</option>
                                <option value="Agen">Pemasukan Agen</option>
                                <option value="Shopee">Pemasukan Shopee</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="text" name="nominal" id="nominal_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Edit Pemasukan" class="btn btn-sm btn-success" id="btnSubmitModalEditPemasukan">
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
    <div class="card shadow mb-4" style="max-width:750px">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="#modalAddPemasukan" class="modal-add-agen nav-link bg-success text-light" data-toggle="modal">tambah pemasukan</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tgl</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th width="10%">edit</th>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 0;
                            foreach ($pemasukan as $pemasukan) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= date("d-m-Y", strtotime($pemasukan['tgl_pemasukan']))?></td>
                                    <td><?= $pemasukan['nama']?></td>
                                    <td><?= $pemasukan['keterangan']?></td>
                                    <td><?= rupiah($pemasukan['nominal'])?></td>
                                    <td><a href="#modalEditPemasukan" data-toggle="modal" data-id="<?= $pemasukan['id_pemasukan']?>" class="modalEditPemasukan badge badge-success">edit</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#pemasukan").addClass("active");
    $(".modalEditPemasukan").click(function(){
        let id = $(this).data("id");
        $.ajax({
            url: "<?= base_url()?>admin/get_pemasukan_by_id",
            data: {id: id},
            method: "POST",
            dataType: "json",
            async: true,
            success: function(data){
                $("#id_pemasukan_edit").val(data.id_pemasukan);
                $("#tgl_pemasukan_edit").val(data.tgl_pemasukan);
                $("#keterangan_edit").val(data.keterangan);
                $("#nominal_edit").val(data.nominal);
                $("#nama_edit").val(data.nama);
            }
        })
    })

    // validation
        $('input[name="nominal"').keyup(function(){
            $('input[name="nominal"').val(formatRupiah(this.value, 'Rp. '))
        })

    // confirm
        $("#btnSubmitModalEditPemasukan").click(function(){
            var c = confirm("Yakin akan merubah data pemasukan?");
            return c;
        })
        
        $("#btnSubmitModalAddPemasukan").click(function(){
            var c = confirm("Yakin akan menambahkan data pemasukan?");
            return c;
        })
</script>