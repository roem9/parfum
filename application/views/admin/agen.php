<!-- modal add agen -->
    <div class="modal fade" id="modalAddAgen" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddAgenTitle">Tambah Agen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/add_agen" method="post">
                        <div class="form-group">
                            <label for="nama">Nama Agen</label>
                            <input type="text" name="nama_agen" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Agen" class="btn btn-sm btn-primary" id="btnSubmitModalAddAgen">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add agen -->

<!-- modal edit agen -->
    <div class="modal fade" id="modalEditAgen" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditAgenTitle">Edit Agen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/edit_agen_by_id" method="post">
                        <input type="hidden" name="id" id="id_agen_edit">
                        <div class="form-group">
                            <label for="nama">Nama Agen</label>
                            <input type="text" name="nama_agen" id="nama_agen_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Edit Agen" class="btn btn-sm btn-success" id="btnSubmitModalEditAgen">
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
                    <a href="#modalAddAgen" class="modal-add-agen nav-link bg-success text-light" data-toggle="modal">tambah agen</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th width="10%">edit</th>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 0;
                            foreach ($agen as $agen) :?>
                            <tr>
                                <td><center><?= ++$no?></center></td>
                                <td><?= $agen['nama_agen']?></td>
                                <td><a href="#modalEditAgen" data-toggle="modal" data-id="<?= $agen['id_agen']?>" class="modalEditAgen badge badge-success">edit</a></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#agen").addClass("active");
    $(".modalEditAgen").click(function(){
        let id = $(this).data("id");
        $.ajax({
            url: "<?= base_url()?>admin/get_agen_by_id",
            data: {id: id},
            method: "POST",
            dataType: "json",
            async: true,
            success: function(data){
                $("#id_agen_edit").val(data.id_agen);
                $("#nama_agen_edit").val(data.nama_agen);
            }
        })
    })

    // confirm
        $("#btnSubmitModalEditAgen").click(function(){
            var c = confirm("Yakin akan merubah data agen?");
            return c;
        })
        
        $("#btnSubmitModalAddAgen").click(function(){
            var c = confirm("Yakin akan menambahkan data agen?");
            return c;
        })
</script>