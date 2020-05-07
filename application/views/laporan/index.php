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
    <div class="card shadow mb-4" style="max-width:550px">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th>Periode</th>
                        <th width=30%>HPP</th>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 0;
                            foreach ($periode as $periode) :?>
                            <tr>
                                <td><center><?= ++$no?></center></td>
                                <?php 
                                    $data = explode(" ", $periode['periode']);
                                ?>
                                <td><?= $month[$data[0]] . " " . $data[1]?></td>
                                <td><a href="<?= base_url()?>laporan/hpp/<?= $periode['periode']?>">hpp <?= $periode['periode']?>.pdf</a></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#laporan").addClass("active");
</script>