<!-- modal add sales -->
<div class="modal fade" id="modalAddSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddSalesTitle">Tambah Sales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/add_sales" method="post">
                        <div class="form-group">
                            <label for="nama">Nama Sales</label>
                            <input type="text" name="nama_sales" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah Sales" class="btn btn-sm btn-primary" id="btnSubmitModalAddSales">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal add sales -->

<!-- modal edit sales -->
    <div class="modal fade" id="modalEditSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditSalesTitle">Edit Sales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url()?>admin/edit_sales_by_id" method="post">
                        <input type="hidden" name="id" id="id_sales_edit">
                        <div class="form-group">
                            <label for="nama">Nama Sales</label>
                            <input type="text" name="nama_sales" id="nama_sales_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Edit Sales" class="btn btn-sm btn-success" id="btnSubmitModalEditSales">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal edit sales -->

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
                    <a href="#modalAddSales" class="modal-add-sales nav-link bg-success text-light" data-toggle="modal">tambah sales</a>
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
                            foreach ($sales as $sales) :?>
                            <tr>
                                <td><center><?= ++$no?></center></td>
                                <td><?= $sales['nama_sales']?></td>
                                <td><a href="#modalEditSales" data-toggle="modal" data-id="<?= $sales['id_sales']?>" class="modalEditSales badge badge-success">edit</a></td>
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
    $(".modalEditSales").click(function(){
        let id = $(this).data("id");
        $.ajax({
            url: "<?= base_url()?>admin/get_sales_by_id",
            data: {id: id},
            method: "POST",
            dataType: "json",
            async: true,
            success: function(data){
                $("#id_sales_edit").val(data.id_sales);
                $("#nama_sales_edit").val(data.nama_sales);
            }
        })
    })

    // confirm
        $("#btnSubmitModalEditSales").click(function(){
            var c = confirm("Yakin akan merubah data sales?");
            return c;
        })
        
        $("#btnSubmitModalAddSales").click(function(){
            var c = confirm("Yakin akan menambahkan data sales?");
            return c;
        })
</script>