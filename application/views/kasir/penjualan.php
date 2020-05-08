<!-- modal add penjualan -->
    <div class="modal fade" id="modalAddPenjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddPenjualanTitle">Tambah Data Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link active' id="btnModalAddPenjualan1">Data Penjualan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalAddPenjualan2">Data Parfum</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalAddPenjualan3">Data Tambahan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalAddPenjualan4">Data Barang</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body cus-font">
                            <form action="<?= base_url()?>kasir/add_penjualan" method="post">
                                <input type="hidden" name="tipe" value="<?= $tipe?>">
                                <div id="formModalAddPenjualan1">
                                    <?php if($tipe == 'Agen'):?>
                                        <div class="form-group">
                                            <label for="id_agen">Nama Agen</label>
                                            <select name="id_agen" id="id_agen" class="form-control form-control-sm" required>
                                                <option value="">Pilih Agen</option>
                                                <?php foreach ($agen as $data) :?>
                                                    <option value="<?= $data['id_agen']?>"><?= $data['nama_agen']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    <?php elseif($tipe == 'Sales') :?>
                                        <div class="form-group">
                                            <label for="id_sales">Nama Sales</label>
                                            <select name="id_sales" id="id_sales" class="form-control form-control-sm" required>
                                                <option value="">Pilih Sales</option>
                                                <?php foreach ($sales as $data) :?>
                                                    <option value="<?= $data['id_sales']?>"><?= $data['nama_sales']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    <?php endif;?>
                                    <div id="form-agen-sales"></div>
                                    <div class="form-group">
                                        <label for="tgl_penjualan">Tgl Penjualan</label>
                                        <input type="date" name="tgl_penjualan" id="tgl_penjualan" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">No Handphone</label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat Lengkap</label>
                                        <textarea name="alamat" id="alamat" rows="5" class="form-control form-control-sm" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="metode">Metode Pembayaran</label>
                                        <select name="metode" id="metode" class="form-control form-control-sm" required>
                                            <option value="">Pilih Metode Pembayaran</option>
                                            <option value="Cash">Cash</option>
                                            <option value="COD">COD</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="rekening">Rekening</label>
                                        <select name="rekening" id="rekening" class="form-control form-control-sm" disabled>
                                            <option value="">Pilih Rekening</option>
                                            <option value="BCA">BCA</option>
                                            <option value="BRI">BRI</option>
                                            <option value="Mandiri">Mandiri</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="adm">Administrasi</label>
                                        <input type="text" name="adm" id="adm" class="form-control form-control-sm" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="ongkir">Ongkir</label>
                                        <input type="text" name="ongkir" id="ongkir" class="form-control form-control-sm" disabled>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <a href="#" id="btnNextFormModalAddPenjualan1" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> data parfum</a>
                                    </div>
                                </div>
                                <div id="formModalAddPenjualan2">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menginputkan parfum yang terjual
                                    </div>
                                    <div class="form-group">
                                        <label for="id_parfum">Parfum 1</label>
                                        <select name="id_parfum[]" class="form-control form-control-sm">
                                            <option value="">Pilih Parfum</option>
                                            <?php foreach ($parfum as $data) :?>
                                                <option value="<?= $data['id_parfum']?>"><?= $data['nama_parfum']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">QTY</label>
                                        <input type="text" name="qty[]" class="form-control form-control-sm">
                                    </div>
                                    <div id="formTambahanModalAddPenjualan2"></div>
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalAddPenjualan2">hapus parfum</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalAddPenjualan2">tambah parfum</a>
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="#" class="btn btn-sm btn-success" id="btnBackFormModalAddPenjualan2"><i class="fa fa-arrow-left"></i> data penjualan</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btnNextFormModalAddPenjualan2"><i class="fa fa-arrow-right"></i> data tambahan</a>
                                    </div>
                                </div>
                                <div id="formModalAddPenjualan3">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menginputkan tambahan
                                    </div>
                                    <div class="form-group">
                                        <label for="id_bahan">Tambahan 1</label>
                                        <select name="id_bahan[]" class="form-control form-control-sm">
                                            <option value="">Pilih Tambahan</option>
                                            <?php foreach ($bahan as $data) :?>
                                                <option value="<?= $data['id_bahan']?>"><?= $data['nama_bahan']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">QTY</label>
                                        <input type="text" name="qty_tambahan[]" class="form-control form-control-sm">
                                    </div>
                                    <div id="formTambahanModalAddPenjualan3"></div>
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalAddPenjualan3">hapus tambahan</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalAddPenjualan3">tambah tambahan</a>
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="#" class="btn btn-sm btn-success" id="btnBackFormModalAddPenjualan3"><i class="fa fa-arrow-left"></i> data parfum</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btnNextFormModalAddPenjualan3"><i class="fa fa-arrow-right"></i> data barang</a>
                                    </div>
                                </div>
                                <div id="formModalAddPenjualan4">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menginputkan barang yang terjual
                                    </div>
                                    <div class="form-group">
                                        <label for="id_barang">Barang 1</label>
                                        <select name="id_barang[]" class="form-control form-control-sm">
                                            <option value="">Pilih Barang</option>
                                            <?php foreach ($barang as $data) :?>
                                                <option value="<?= $data['id_barang']?>"><?= $data['nama_barang']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">QTY</label>
                                        <input type="text" name="qty_barang[]" class="form-control form-control-sm">
                                    </div>
                                    <div id="formTambahanModalAddPenjualan4"></div>
                                    <div class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalAddPenjualan4">hapus barang</a>
                                        <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalAddPenjualan4">tambah barang</a>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <a href="#" class="btn btn-sm btn-success" id="btnBackFormModalAddPenjualan4"><i class="fa fa-arrow-left"></i> data tambahan</a>
                                        <input type="submit" value="Tambah Penjualan" class="btn btn-sm btn-primary" id="submitModalAddPenjualan">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal add penjualan -->

<!-- modal edit -->
    <div class="modal fade" id="modalEditPenjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPenjualanTitle">Edit Data Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPenjualan1">Data Penjualan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPenjualan2">Parfum</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPenjualan3">Tambahan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class='nav-link' id="btnModalEditPenjualan4">Barang</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body cus-font">
                            <form action="<?= base_url()?>kasir/edit_penjualan_by_id" method="post" id="formModalEditPenjualan1">
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk mengubah data penjualan
                                </div>
                                <input type="hidden" name="tipe" value="<?= $tipe?>">
                                <input type="hidden" name="id_penjualan" id="id_penjualan_edit">
                                <?php if($tipe == 'Agen'):?>
                                    <div class="form-group">
                                        <label for="id_agen">Nama Agen</label>
                                        <select name="id_agen" id="id_agen_edit" class="form-control form-control-sm" required>
                                            <option value="">Pilih Agen</option>
                                            <?php foreach ($agen as $data) :?>
                                                <option value="<?= $data['id_agen']?>"><?= $data['nama_agen']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                <?php elseif($tipe == 'Sales') :?>
                                    <div class="form-group">
                                        <label for="id_sales">Nama Sales</label>
                                        <select name="id_sales" id="id_sales_edit" class="form-control form-control-sm" required>
                                            <option value="">Pilih Sales</option>
                                            <?php foreach ($sales as $data) :?>
                                                <option value="<?= $data['id_sales']?>"><?= $data['nama_sales']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                <?php endif;?>
                                <div class="form-group">
                                    <label for="tgl_penjualan">Tgl Penjualan</label>
                                    <input type="date" name="tgl_penjualan" id="tgl_penjualan_edit" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama_edit" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No Handphone</label>
                                    <input type="text" name="no_hp" id="no_hp_edit" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea name="alamat" id="alamat_edit" rows="5" class="form-control form-control-sm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="metode">Metode Pembayaran</label>
                                    <select name="metode" id="metode_edit" class="form-control form-control-sm">
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="Cash">Cash</option>
                                        <option value="COD">COD</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rekening">Rekening</label>
                                    <select name="rekening" id="rekening_edit" class="form-control form-control-sm" disabled>
                                        <option value="">Pilih Rekening</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="Mandiri">Mandiri</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="adm">Administrasi</label>
                                    <input type="text" name="adm" id="adm_edit" class="form-control form-control-sm" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="ongkir">Ongkir</label>
                                    <input type="text" name="ongkir" id="ongkir_edit" class="form-control form-control-sm" disabled>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type="submit" value="Edit Data" class="btn btn-sm btn-success" id="btnSubmitFormModalEditPenjualan1">
                                </div>
                            </form>
                            
                            <div class="card" id="formModalEditPenjualan2">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" id="btnModalEditPenjualan21"><i class="fa fa-trash-alt"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" id="btnModalEditPenjualan22"><i class="fa fa-plus"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url()?>kasir/delete_detail_penjualan_by_id" method="post" id="formModalEditPenjualan21">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menghapus data, jika terjadi kesalahan input. pilih item yang ingin dihapus kemudian pilih tombol hapus detail
                                        </div>
                                        <table width="100%" style="border: border-collapse">
                                            <tbody id="listFormModalEditPenjualan21"></tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-5">
                                            <input type="submit" value="Hapus Data" class="btn btn-sm btn-danger" id="btnSubmitFormModalEditPenjualan2">
                                        </div>
                                    </form>
                                    
                                    <form action="<?= base_url()?>kasir/add_detail_penjualan_by_id" method="post" id="formModalEditPenjualan22">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menambahkan parfum yang terjual
                                        </div>
                                        <input type="hidden" name="id_penjualan" id="id_penjualan">
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
                                        <div id="formTambahanModalEditPenjualan22"></div>
                                        <div class="d-flex justify-content-end">
                                            <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalEditPenjualan22">hapus parfum</a>
                                            <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalEditPenjualan22">tambah parfum</a>
                                        </div>
                                        <div class="d-flex justify-content-end mt-2">
                                            <input type="submit" value="Tambah Data" class="btn btn-sm btn-primary" id="btnSubmitFormModalEditPenjualan3">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card" id="formModalEditPenjualan3">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" id="btnModalEditPenjualan31"><i class="fa fa-trash-alt"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" id="btnModalEditPenjualan32"><i class="fa fa-plus"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url()?>kasir/delete_tambahan_penjualan_by_id" method="post" id="formModalEditPenjualan31">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menghapus data, jika terjadi kesalahan input. pilih item yang ingin dihapus kemudian pilih tombol hapus detail
                                        </div>
                                        <table width="100%" style="border: border-collapse">
                                            <tbody id="listFormModalEditPenjualan31"></tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-5">
                                            <input type="submit" value="Hapus Data" class="btn btn-sm btn-danger" id="btnSubmitFormModalEditPenjualan4">
                                        </div>
                                    </form>
                                    <form action="<?= base_url()?>kasir/add_bahan_tambahan_by_id" method="post" id="formModalEditPenjualan32">
                                        <input type="hidden" name="id_penjualan" id="id_penjualan_sub2_1">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menginputkan tambahan
                                        </div>
                                        <div class="form-group">
                                            <label for="id_bahan">Tambahan 1</label>
                                            <select name="id_bahan[]" class="form-control form-control-sm" required>
                                                <option value="">Pilih Tambahan</option>
                                                <?php foreach ($bahan as $data) :?>
                                                    <option value="<?= $data['id_bahan']?>"><?= $data['nama_bahan']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">QTY</label>
                                            <input type="text" name="qty_tambahan[]" class="form-control form-control-sm" required>
                                        </div>
                                        <div id="formTambahanModalEditPenjualan32"></div>
                                        <div class="d-flex justify-content-end">
                                            <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalEditPenjualan32">hapus tambahan</a>
                                            <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalEditPenjualan32">tambah tambahan</a>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <input type="submit" value="Tambah Data" class="btn btn-sm btn-primary" id="btnSubmitFormModalEditPenjualan5">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="card" id="formModalEditPenjualan4">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" id="btnModalEditPenjualan41"><i class="fa fa-trash-alt"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" id="btnModalEditPenjualan42"><i class="fa fa-plus"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url()?>kasir/delete_detail_penjualan_barang_by_id" method="post" id="formModalEditPenjualan41">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menghapus data, jika terjadi kesalahan input. pilih item yang ingin dihapus kemudian pilih tombol hapus detail
                                        </div>
                                        <table width="100%" style="border: border-collapse">
                                            <tbody id="listFormModalEditPenjualan41"></tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-5">
                                            <input type="submit" value="Hapus Data" class="btn btn-sm btn-danger" id="btnSubmitFormModalEditPenjualan6">
                                        </div>
                                    </form>
                                    <form action="<?= base_url()?>kasir/add_detail_penjualan_barang_by_id" method="post" id="formModalEditPenjualan42">
                                        <input type="hidden" name="id_penjualan" id="id_penjualan_sub2_1">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle text-info mr-1"></i> menu ini untuk menginputkan barang tambahan
                                        </div>
                                        <div class="form-group">
                                            <label for="id_barang">Barang 1</label>
                                            <select name="id_barang[]" class="form-control form-control-sm" required>
                                                <option value="">Pilih Barang</option>
                                                <?php foreach ($barang as $data) :?>
                                                    <option value="<?= $data['id_barang']?>"><?= $data['nama_barang']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">QTY</label>
                                            <input type="text" name="qty_barang[]" class="form-control form-control-sm" required>
                                        </div>
                                        <div id="formTambahanModalEditPenjualan42"></div>
                                        <div class="d-flex justify-content-end">
                                            <a href="#" class="btn btn-sm btn-danger mr-1" id="btnHapusFormModalEditPenjualan42">hapus tambahan</a>
                                            <a href="#" class="btn btn-sm btn-success" id="btnTambahFormModalEditPenjualan42">tambah tambahan</a>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <input type="submit" value="Tambah Data" class="btn btn-sm btn-primary" id="btnSubmitFormModalEditPenjualan7">
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a href="#modalAddPenjualan" class="modal-add-penjualan nav-link bg-success text-light" data-toggle="modal">tambah penjualan</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm cus-font" id="dataTable" cellspacing="0">
                    <thead>
                        <th width="5%">No</th>
                        <th width=5%>Metode</th>
                        <th width=10%><center>Tgl</center></th>
                        <th>Nama Lengkap</th>
                        <th width=15%>No Handphone</th>
                        <th width="15%">Total</th>
                        <?php if($tipe == "Agen"):?>
                            <th>Agen</th>
                        <?php else:?>
                            <th>Sales</th>
                        <?php endif;?>
                        <th width="8%">detail</th>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            foreach ($penjualan as $penjualan) :?>
                                <tr>
                                    <td><center><?= ++$no?></center></td>
                                    <td><?= $penjualan['metode']?></td>
                                    <td><?= date('d-m-Y', strtotime($penjualan['tgl_penjualan']))?></td>
                                    <td><?= $penjualan['nama']?></td>
                                    <td><?= $penjualan['no_hp']?></td>
                                    <td><?= rupiah($penjualan['total'])?></td>
                                    <?php if($tipe == "Agen"):?>
                                        <td><?= $penjualan['nama_agen']?></td>
                                    <?php else:?>
                                        <td><?= $penjualan['nama_sales']?></td>
                                    <?php endif;?>
                                    <td><a href="#modalEditPenjualan" class="badge badge-warning modal-detail-penjualan" data-toggle="modal" data-id="<?= $penjualan['id_penjualan']?>">detail</a></td>
                                </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#penjualan").addClass("active");
    
    $("select[name='metode']").change(function(){
        let metode = $(this).val();
        if(metode == 'Cash'){
            $("select[name='rekening']").attr('disabled', 'disabled');
            $("select[name='rekening']").prop('required', false);
            $("input[name='adm']").attr('disabled', 'disabled');
            $("input[name='adm']").prop('required', false);
            $("input[name='ongkir']").attr('disabled', 'disabled');
            $("input[name='ongkir']").prop('required', false);

            $("input[name='adm']").val('');
            $("input[name='ongkir']").val('');
            $("select[name='rekening']").val('');
        } else if(metode == 'COD'){
            $("select[name='rekening']").attr('disabled', 'disabled');
            $("select[name='rekening']").prop('required', false);
            $("input[name='adm']").removeAttr('disabled');
            $("input[name='adm']").prop('required', true);
            $("input[name='ongkir']").attr('disabled', 'disabled');
            $("input[name='ongkir']").prop('required', false);
            
            $("input[name='adm']").val('');
            $("input[name='ongkir']").val('');
            $("select[name='rekening']").val('');
        } else if(metode == 'Transfer'){
            $("select[name='rekening']").removeAttr('disabled');
            $("select[name='rekening']").prop('required', true);
            $("input[name='adm']").attr('disabled', 'disabled');
            $("input[name='adm']").prop('required', false);
            $("input[name='ongkir']").removeAttr('disabled');
            $("input[name='ongkir']").prop('required', true);
            
            $("input[name='adm']").val('');
            $("input[name='ongkir']").val('');
            $("select[name='rekening']").val('');
        }
    })

    $(".modal-add-penjualan").click(function(){
        $("#btnModalAddPenjualan1").addClass('active');
        $("#btnModalAddPenjualan2").removeClass('active');
        $("#btnModalAddPenjualan3").removeClass('active');
        $("#btnModalAddPenjualan4").removeClass('active');

        $("#formModalAddPenjualan1").show();
        $("#formModalAddPenjualan2").hide();
        $("#formModalAddPenjualan3").hide();
        $("#formModalAddPenjualan4").hide();
    })

    $(".modal-detail-penjualan").click(function(){
        let id = $(this).data("id");
        
        $("#btnModalEditPenjualan1").addClass('active');
        $("#btnModalEditPenjualan2").removeClass('active');
        $("#btnModalEditPenjualan3").removeClass('active');
        $("#btnModalEditPenjualan4").removeClass('active');

        $("#formModalEditPenjualan1").show();
        $("#formModalEditPenjualan2").hide();
        $("#formModalEditPenjualan3").hide();
        $("#formModalEditPenjualan4").hide();

        $.ajax({
            url: "<?= base_url()?>kasir/get_penjualan_by_id",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                $("#modalEditPenjualanTitle").html(data.nama);
                $("input[name='id_penjualan']").val(data.id_penjualan);
                $("#tgl_penjualan_edit").val(data.tgl_penjualan);
                $("#nama_edit").val(data.nama);
                $("#no_hp_edit").val(data.no_hp);
                $("#alamat_edit").val(data.alamat);
                $("#metode_edit").val(data.metode);
                
                let metode = data.metode;
                
                if(metode == 'Cash'){
                    $("select[name='rekening']").attr('disabled', 'disabled');
                    $("select[name='rekening']").prop('required', false);
                    $("input[name='adm']").attr('disabled', 'disabled');
                    $("input[name='adm']").prop('required', false);
                    $("input[name='ongkir']").attr('disabled', 'disabled');
                    $("input[name='ongkir']").prop('required', false);

                    $("input[name='adm']").val('');
                    $("input[name='ongkir']").val('');
                    $("select[name='rekening']").val('');
                } else if(metode == 'COD'){
                    $("select[name='rekening']").attr('disabled', 'disabled');
                    $("select[name='rekening']").prop('required', false);
                    $("input[name='adm']").removeAttr('disabled');
                    $("input[name='adm']").prop('required', true);
                    $("input[name='ongkir']").attr('disabled', 'disabled');
                    $("input[name='ongkir']").prop('required', false);
                    
                    $("input[name='adm']").val('');
                    $("input[name='ongkir']").val('');
                    $("select[name='rekening']").val('');
                    
                    $("#adm_edit").val(data.adm);
                } else if(metode == 'Transfer'){
                    $("select[name='rekening']").removeAttr('disabled');
                    $("select[name='rekening']").prop('required', true);
                    $("input[name='adm']").attr('disabled', 'disabled');
                    $("input[name='adm']").prop('required', false);
                    $("input[name='ongkir']").removeAttr('disabled');
                    $("input[name='ongkir']").prop('required', true);
                    
                    $("input[name='adm']").val('');
                    $("input[name='ongkir']").val('');
                    $("select[name='rekening']").val('');
                    
                    $("#rekening_edit").val(data.rekening);
                    $("#ongkir_edit").val(data.ongkir);
                }
            }
        })
        
        $.ajax({
            url: "<?= base_url()?>kasir/get_detail_penjualan_by_id_penjualan",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                let html = '';
                let sub = '';
                let total = 0;
        

                for (let i = 0; i < data.length; i++) {
                    sub = parseInt(data[i].qty) * parseInt(data[i].harga)
                    total = parseInt(total) + parseInt(sub);

                    reverse = sub.toString().split('').reverse().join(''),
                    ribuan 	= reverse.match(/\d{1,3}/g);
                    sub	= ribuan.join('.').split('').reverse().join('');
                    
                    html += `<tr style="border-bottom: 1px solid black">
                                <td><input type="checkbox" class="mr-1" name="id_detail[]" id="`+i+`" value="`+data[i].id_detail+`"><label for="`+i+`">`+data[i].nama_parfum+`</label></td>
                                <td>`+data[i].harga+`</td>
                                <td>x `+data[i].qty+`</td>
                                <td class="text-right">Rp `+sub+`</td>
                            </tr>`;
                    
                }
                    
                    reverse = total.toString().split('').reverse().join(''),
                    ribuan 	= reverse.match(/\d{1,3}/g);
                    total	= ribuan.join('.').split('').reverse().join('');

                html += `
                <tr>
                    <td><b><center>Total</center></b></td>
                    <td colspan=3 class="text-right">Rp `+total+`</td>
                </tr>`;


                $("#listFormModalEditPenjualan21").html(html);
            }
        })
        
        $.ajax({
            url: "<?= base_url()?>kasir/get_tambahan_by_id_penjualan",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                let html = '';
                let sub = '';
                let total = 0;
        

                for (let i = 0; i < data.length; i++) {
                    sub = parseInt(data[i].qty) * parseInt(data[i].harga_satuan)
                    total = parseInt(total) + parseInt(sub);

                    reverse = sub.toString().split('').reverse().join(''),
                    ribuan 	= reverse.match(/\d{1,3}/g);
                    sub	= ribuan.join('.').split('').reverse().join('');
                    
                    html += `<tr style="border-bottom: 1px solid black">
                                <td><input type="checkbox" class="mr-1" name="id[]" id=a"`+i+`" value="`+data[i].id+`"><label for=a"`+i+`">`+data[i].nama_bahan+`</label></td>
                                <td>`+data[i].harga_satuan+`</td>
                                <td>x `+data[i].qty+`</td>
                                <td class="text-right">Rp `+sub+`</td>
                            </tr>`;
                    
                }
                    
                    reverse = total.toString().split('').reverse().join(''),
                    ribuan 	= reverse.match(/\d{1,3}/g);
                    total	= ribuan.join('.').split('').reverse().join('');

                html += `
                <tr>
                    <td><b><center>Total</center></b></td>
                    <td colspan=3 class="text-right">Rp `+total+`</td>
                </tr>`;


                $("#listFormModalEditPenjualan31").html(html);
            }
        })
        
        $.ajax({
            url: "<?= base_url()?>kasir/get_detail_penjualan_barang_by_id_penjualan",
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                let html = '';
                let sub = '';
                let total = 0;
        

                for (let i = 0; i < data.length; i++) {
                    sub = parseInt(data[i].qty) * parseInt(data[i].harga)
                    total = parseInt(total) + parseInt(sub);

                    reverse = sub.toString().split('').reverse().join(''),
                    ribuan 	= reverse.match(/\d{1,3}/g);
                    sub	= ribuan.join('.').split('').reverse().join('');
                    
                    html += `<tr style="border-bottom: 1px solid black">
                                <td><input type="checkbox" class="mr-1" name="id_detail[]" id=aa"`+i+`" value="`+data[i].id_detail+`"><label for=aa"`+i+`">`+data[i].nama_barang+`</label></td>
                                <td>`+data[i].harga+`</td>
                                <td>x `+data[i].qty+`</td>
                                <td class="text-right">Rp `+sub+`</td>
                            </tr>`;
                    
                }
                    
                    reverse = total.toString().split('').reverse().join(''),
                    ribuan 	= reverse.match(/\d{1,3}/g);
                    total	= ribuan.join('.').split('').reverse().join('');

                html += `
                <tr>
                    <td><b><center>Total</center></b></td>
                    <td colspan=3 class="text-right">Rp `+total+`</td>
                </tr>`;


                $("#listFormModalEditPenjualan41").html(html);
            }
        })

        <?php if ($tipe == "Agen"):?>
            let url = "<?= base_url()?>kasir/get_id_agen_by_id_penjualan";
        <?php else:?>
            let url = "<?= base_url()?>kasir/get_id_sales_by_id_penjualan";
        <?php endif;?>

        $.ajax({
            url: url,
            data: {id: id},
            async: true,
            dataType: 'json',
            method: "POST",
            success: function(data){
                <?php if ($tipe == "Agen"):?>
                    $("#id_agen_edit").val(data.id_agen)
                <?php else:?>
                    $("#id_sales_edit").val(data.id_sales)
                <?php endif;?>
            }
        })
    });
    
    // form tambahan
        
        // select parfum
            var html = <?php echo json_encode($parfum, JSON_PRETTY_PRINT);?>;
            var parfum = '';
            for (let i = 0; i < html.length; i++) {
                parfum += '<option value="' +html[i].id_parfum+ '">' +html[i].nama_parfum+ '</option>';
            }
        // select parfum
            
        // select bahan
            var html = <?php echo json_encode($bahan, JSON_PRETTY_PRINT);?>;
            var bahan = '';
            for (let i = 0; i < html.length; i++) {
                bahan += '<option value="' +html[i].id_bahan+ '">' +html[i].nama_bahan+'</option>';
            }
        // select bahan

        // select barang
            var html = <?php echo json_encode($barang, JSON_PRETTY_PRINT);?>;
            var barang = '';
            for (let i = 0; i < html.length; i++) {
                barang += '<option value="' +html[i].id_barang+ '">' +html[i].nama_barang+'</option>';
            }
        // select barang
        
        // tambah parfum
            var a = 1;
            var aa = 1;

            $("#btnTambahFormModalAddPenjualan2").click(function(e){
                e.preventDefault();
                a++;
                aa++;
                $("#formTambahanModalAddPenjualan2").append(
                                            `<div class="form-group" id="a`+a+`">
                                                <label for="id_parfum">Parfum `+aa+`</label>
                                                <select name="id_parfum[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Parfum</option>`+parfum+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="aa`+a+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalAddPenjualan2").click(function(e){
                if(a != 1){
                    e.preventDefault();
                    $("#a"+a).remove();
                    $("#aa"+a).remove();
                    a--;
                    aa--;
                }
            })
        // tambah parfum

        // tambah bahan tambahan
            var b = 1;
            var bb = 1;

            $("#btnTambahFormModalAddPenjualan3").click(function(e){
                e.preventDefault();
                b++;
                bb++;
                $("#formTambahanModalAddPenjualan3").append(
                                            `<div class="form-group" id="b`+b+`">
                                                <label for="id_bahan">Tambahan `+bb+`</label>
                                                <select name="id_bahan[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Tambahan</option>`+bahan+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="bb`+b+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty_tambahan[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalAddPenjualan3").click(function(e){
                if(b != 1){
                    e.preventDefault();
                    $("#b"+b).remove();
                    $("#bb"+b).remove();
                    b--;
                    bb--;
                }
            })
        // tambah bahan tambahan

        // tambah data barang
            var c = 1;
            var cc = 1;

            $("#btnTambahFormModalAddPenjualan4").click(function(e){
                e.preventDefault();
                c++;
                cc++;
                $("#formTambahanModalAddPenjualan4").append(
                                            `<div class="form-group" id="c`+c+`">
                                                <label for="id_barang">Barang `+cc+`</label>
                                                <select name="id_barang[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Barang</option>`+barang+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="cc`+c+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty_barang[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalAddPenjualan4").click(function(e){
                if(c != 1){
                    e.preventDefault();
                    $("#c"+c).remove();
                    $("#cc"+c).remove();
                    c--;
                    cc--;
                }
            })
        // tambah data barang
    // form tambahan
    
    // modal add
        $("#btnModalAddPenjualan1, #btnBackFormModalAddPenjualan2").click(function(){
            $("#btnModalAddPenjualan1").addClass('active');
            $("#btnModalAddPenjualan2").removeClass('active');
            $("#btnModalAddPenjualan3").removeClass('active');
            $("#btnModalAddPenjualan4").removeClass('active');

            $("#formModalAddPenjualan1").show();
            $("#formModalAddPenjualan2").hide();
            $("#formModalAddPenjualan3").hide();
            $("#formModalAddPenjualan4").hide();
        })
        
        $("#btnModalAddPenjualan2, #btnBackFormModalAddPenjualan3, #btnNextFormModalAddPenjualan1").click(function(){
            $("#btnModalAddPenjualan1").removeClass('active');
            $("#btnModalAddPenjualan2").addClass('active');
            $("#btnModalAddPenjualan3").removeClass('active');
            $("#btnModalAddPenjualan4").removeClass('active');

            $("#formModalAddPenjualan1").hide();
            $("#formModalAddPenjualan2").show();
            $("#formModalAddPenjualan3").hide();
            $("#formModalAddPenjualan4").hide();
        })
        
        $("#btnModalAddPenjualan3, #btnBackFormModalAddPenjualan4, #btnNextFormModalAddPenjualan2").click(function(){
            $("#btnModalAddPenjualan1").removeClass('active');
            $("#btnModalAddPenjualan2").removeClass('active');
            $("#btnModalAddPenjualan3").addClass('active');
            $("#btnModalAddPenjualan4").removeClass('active');

            $("#formModalAddPenjualan1").hide();
            $("#formModalAddPenjualan2").hide();
            $("#formModalAddPenjualan3").show();
            $("#formModalAddPenjualan4").hide();
        })
        
        $("#btnModalAddPenjualan4, #btnNextFormModalAddPenjualan3").click(function(){
            $("#btnModalAddPenjualan1").removeClass('active');
            $("#btnModalAddPenjualan2").removeClass('active');
            $("#btnModalAddPenjualan3").removeClass('active');
            $("#btnModalAddPenjualan4").addClass('active');

            $("#formModalAddPenjualan1").hide();
            $("#formModalAddPenjualan2").hide();
            $("#formModalAddPenjualan3").hide();
            $("#formModalAddPenjualan4").show();
        })

    // modal add
    
    // modal edit
        
        $("#btnModalEditPenjualan1").click(function(){
            $("#btnModalEditPenjualan1").addClass('active');
            $("#btnModalEditPenjualan2").removeClass('active');
            $("#btnModalEditPenjualan3").removeClass('active');
            $("#btnModalEditPenjualan4").removeClass('active');

            $("#formModalEditPenjualan1").show();
            $("#formModalEditPenjualan2").hide();
            $("#formModalEditPenjualan3").hide();
            $("#formModalEditPenjualan4").hide();
        })
        
        $("#btnModalEditPenjualan2").click(function(){
            $("#btnModalEditPenjualan1").removeClass('active');
            $("#btnModalEditPenjualan2").addClass('active');
            $("#btnModalEditPenjualan3").removeClass('active');
            $("#btnModalEditPenjualan4").removeClass('active');

            $("#formModalEditPenjualan1").hide();
            $("#formModalEditPenjualan2").show();
            $("#formModalEditPenjualan3").hide();
            $("#formModalEditPenjualan4").hide();
            
            $("#btnModalEditPenjualan21").addClass('active');
            $("#btnModalEditPenjualan22").removeClass('active');
            $("#formModalEditPenjualan21").show();
            $("#formModalEditPenjualan22").hide();
        })
        
        $("#btnModalEditPenjualan3").click(function(){
            $("#btnModalEditPenjualan1").removeClass('active');
            $("#btnModalEditPenjualan2").removeClass('active');
            $("#btnModalEditPenjualan3").addClass('active');
            $("#btnModalEditPenjualan4").removeClass('active');

            $("#formModalEditPenjualan1").hide();
            $("#formModalEditPenjualan2").hide();
            $("#formModalEditPenjualan3").show();
            $("#formModalEditPenjualan4").hide();
            
            $("#btnModalEditPenjualan31").addClass('active');
            $("#btnModalEditPenjualan32").removeClass('active');
            $("#formModalEditPenjualan31").show();
            $("#formModalEditPenjualan32").hide();
        })
        
        $("#btnModalEditPenjualan4").click(function(){
            $("#btnModalEditPenjualan1").removeClass('active');
            $("#btnModalEditPenjualan2").removeClass('active');
            $("#btnModalEditPenjualan3").removeClass('active');
            $("#btnModalEditPenjualan4").addClass('active');

            $("#formModalEditPenjualan1").hide();
            $("#formModalEditPenjualan2").hide();
            $("#formModalEditPenjualan3").hide();
            $("#formModalEditPenjualan4").show();
            
            $("#btnModalEditPenjualan41").addClass('active');
            $("#btnModalEditPenjualan42").removeClass('active');
            $("#formModalEditPenjualan41").show();
            $("#formModalEditPenjualan42").hide();
        })
        
        $("#btnModalEditPenjualan21").click(function(){
            $("#btnModalEditPenjualan21").addClass('active');
            $("#btnModalEditPenjualan22").removeClass('active');
            $("#formModalEditPenjualan21").show();
            $("#formModalEditPenjualan22").hide();
        })
        
        $("#btnModalEditPenjualan22").click(function(){
            $("#btnModalEditPenjualan21").removeClass('active');
            $("#btnModalEditPenjualan22").addClass('active');
            $("#formModalEditPenjualan21").hide();
            $("#formModalEditPenjualan22").show();
        })
        
        $("#btnModalEditPenjualan31").click(function(){
            $("#btnModalEditPenjualan31").addClass('active');
            $("#btnModalEditPenjualan32").removeClass('active');
            $("#formModalEditPenjualan31").show();
            $("#formModalEditPenjualan32").hide();
        })
        
        $("#btnModalEditPenjualan32").click(function(){
            $("#btnModalEditPenjualan31").removeClass('active');
            $("#btnModalEditPenjualan32").addClass('active');
            $("#formModalEditPenjualan31").hide();
            $("#formModalEditPenjualan32").show();
        })
        
        $("#btnModalEditPenjualan41").click(function(){
            $("#btnModalEditPenjualan41").addClass('active');
            $("#btnModalEditPenjualan42").removeClass('active');
            $("#formModalEditPenjualan41").show();
            $("#formModalEditPenjualan42").hide();
        })
        
        $("#btnModalEditPenjualan42").click(function(){
            $("#btnModalEditPenjualan41").removeClass('active');
            $("#btnModalEditPenjualan42").addClass('active');
            $("#formModalEditPenjualan41").hide();
            $("#formModalEditPenjualan42").show();
        })

    // modal edit

    
    // form tambahan
        // tambah parfum
            var d = 1;
            var dd = 1;

            $("#btnTambahFormModalEditPenjualan22").click(function(e){
                e.preventDefault();
                d++;
                dd++;
                $("#formTambahanModalEditPenjualan22").append(
                                            `<div class="form-group" id="d`+d+`">
                                                <label for="id_parfum">Parfum `+dd+`</label>
                                                <select name="id_parfum[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Parfum</option>`+parfum+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="dd`+d+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalEditPenjualan22").click(function(e){
                if(d != 1){
                    e.preventDefault();
                    $("#d"+d).remove();
                    $("#dd"+d).remove();
                    d--;
                    dd--;
                }
            })
        // tambah parfum

        // tambah bahan tambahan
            var f = 1;
            var ff = 1;

            $("#btnTambahFormModalEditPenjualan32").click(function(e){
                e.preventDefault();
                f++;
                ff++;
                $("#formTambahanModalEditPenjualan32").append(
                                            `<div class="form-group" id="f`+f+`">
                                                <label for="id_bahan">Tambahan `+ff+`</label>
                                                <select name="id_bahan[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Tambahan</option>`+bahan+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="ff`+f+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty_tambahan[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalEditPenjualan32").click(function(e){
                if(f != 1){
                    e.preventDefault();
                    $("#f"+f).remove();
                    $("#ff"+f).remove();
                    f--;
                    ff--;
                }
            })
        // tambah bahan tambahan

        // tambah data barang
            var g = 1;
            var gg = 1;

            $("#btnTambahFormModalEditPenjualan42").click(function(e){
                e.preventDefault();
                g++;
                gg++;
                $("#formTambahanModalEditPenjualan42").append(
                                            `<div class="form-group" id="g`+g+`">
                                                <label for="id_barang">Barang `+gg+`</label>
                                                <select name="id_barang[]" class="form-control form-control-sm" required>
                                                    <option value="">Pilih Barang</option>`+barang+`
                                                </select>
                                            </div>
                                            <div class="form-group" id="gg`+g+`">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty_barang[]" class="form-control form-control-sm" required>
                                            </div>`);
            })

            $("#btnHapusFormModalEditPenjualan42").click(function(e){
                if(g != 1){
                    e.preventDefault();
                    $("#g"+g).remove();
                    $("#gg"+g).remove();
                    g--;
                    gg--;
                }
            })
        // tambah data barang
    // form tambahan

    // confirm
        $("#submitModalAddPenjualan").click(function(){
            var c = confirm('Yakin akan menambahkan penjualan?');
            return c;
        })

        $("#btnSubmitFormModalEditPenjualan1").click(function(){
            var c = confirm('Yakin akan mengubah data penjualan?');
            return c;
        })
        
        $("#btnSubmitFormModalEditPenjualan2, #btnSubmitFormModalEditPenjualan4, #btnSubmitFormModalEditPenjualan6").click(function(){
            var c = confirm('Yakin akan menghapus data?');
            return c;
        })
        
        $("#btnSubmitFormModalEditPenjualan3, #btnSubmitFormModalEditPenjualan5, #btnSubmitFormModalEditPenjualan7").click(function(){
            var c = confirm('Yakin akan menambahkan data?');
            return c;
        })
    // confirm

    //validation
        $("input[name='adm']").keyup(function(){
            $("input[name='adm']").val(formatRupiah(this.value, 'Rp. '))
        })

        $("input[name='ongkir']").keyup(function(){
            $("input[name='ongkir']").val(formatRupiah(this.value, 'Rp. '))
        })

        $('input[name="qty[]"').on('keyup', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        $('input[name="qty_barang[]"').on('keyup', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        $('input[name="qty_tambahan[]"').on('keyup', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    //validation
</script>