<?php
class Produksi extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
        $this->load->model("Main_model");
    }

    public function pembelian(){
        $data['title'] = "List Pembelian";
        $pembelian = $this->Main_model->get_all("pembelian", "", "tgl_pembelian", "DESC");

        $data['pembelian'] = [];
        foreach ($pembelian as $i => $pembelian) {
            $data['pembelian'][$i] = $pembelian;
            $bahan = $this->Parfum_model->get_total_bahan_by_id_pembelian($pembelian['id_pembelian']);
            $barang = $this->Parfum_model->get_total_barang_by_id_pembelian($pembelian['id_pembelian']);
            $data['pembelian'][$i]['total'] = $bahan['total'] + $barang['total'];
        }

        $data['bahan'] = $this->Main_model->get_all("bahan", "", "nama_bahan");
        $data['barang'] = $this->Main_model->get_all("barang", "", "nama_barang");

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("produksi/pembelian", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_pembelian(){
            $id = $this->Parfum_model->get_last_id_pembelian();
            
            if($this->input->post("rekening")){
                $rekening = $this->input->post("rekening");
            } else {
                $rekening = '';
            }
            $data = [
                "id_pembelian" => $id,
                "tgl_pembelian" => $this->input->post("tgl_pembelian"),
                "nama" => $this->input->post("nama", TRUE),
                "metode" => $this->input->post("metode"),
                "rekening" => $rekening
            ];
            $this->Main_model->add_data("pembelian", $data);

            $bahan = $this->input->post("id_bahan");
            $qty = $this->input->post("qty");
            $harga = $this->input->post("harga");

            foreach ($bahan as $i => $bahan) {
                if($bahan != ''){
                    $data = [
                        "id_bahan" => $bahan,
                        "qty" => $qty[$i],
                        "harga" => $this->nominal($harga[$i]),
                        "id_pembelian" => $id
                    ];
                    $this->Main_model->add_data("detail_pembelian", $data);
                }
            }

            $barang = $this->input->post("id_barang");
            $qty = $this->input->post("qty_barang");
            $harga = $this->input->post("harga_barang");

            foreach ($barang as $i => $barang) {
                if($barang != ''){
                    $data = [
                        "id_barang" => $barang,
                        "qty" => $qty[$i],
                        "harga" => $this->nominal($harga[$i]),
                        "id_pembelian" => $id
                    ];
                    $this->Main_model->add_data("detail_pembelian_barang", $data);
                }
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> pembelian<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('produksi/pembelian');
        }        

        public function add_detail_pembelian_by_id(){
            $id = $this->input->post("id_pembelian", TRUE);
            $bahan = $this->input->post("id_bahan");
            $qty = $this->input->post("qty");
            $harga = $this->input->post("harga");

            foreach ($bahan as $i => $bahan) {
                if($bahan != ''){
                    $data = [
                        "id_bahan" => $bahan,
                        "qty" => $qty[$i],
                        "harga" => $this->nominal($harga[$i]),
                        "id_pembelian" => $id
                    ];
                    $this->Main_model->add_data("detail_pembelian", $data);
                }
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail pembelian<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('produksi/pembelian');
        }

        public function add_detail_pembelian_barang_by_id(){
            $id = $this->input->post("id_pembelian", TRUE);
            $barang = $this->input->post("id_barang");
            $qty = $this->input->post("qty_barang");
            $harga = $this->input->post("harga_barang");

            foreach ($barang as $i => $barang) {
                if($barang != ''){
                    $data = [
                        "id_barang" => $barang,
                        "qty" => $qty[$i],
                        "harga" => $this->nominal($harga[$i]),
                        "id_pembelian" => $id
                    ];
                    $this->Main_model->add_data("detail_pembelian_barang", $data);
                }
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail pembelian barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('produksi/pembelian');
        }
    // add

    // edit
        public function edit_pembelian_by_id(){
            $id = $this->input->post("id_pembelian");
            if($this->input->post("rekening")){
                $rekening = $this->input->post("rekening");
            } else {
                $rekening = '';
            }
            $data = [
                "tgl_pembelian" => $this->input->post("tgl_pembelian"),
                "nama" => $this->input->post("nama", TRUE),
                "metode" => $this->input->post("metode"),
                "rekening" => $rekening
            ];

            $result = $this->Main_model->edit_data("pembelian", ["id_pembelian" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data pembelian<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>mengubah</strong> data pembelian<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('produksi/pembelian');
        }
    // edit

    // get
        public function get_pembelian_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("pembelian", ["id_pembelian" => $id]);
            echo json_encode($data);
        }
        
        public function get_detail_pembelian_by_id_pembelian(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_detail_pembelian_by_id_pembelian($id);

            echo json_encode($data);
        }
        
        public function get_detail_pembelian_barang_by_id_pembelian(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_detail_pembelian_barang_by_id_pembelian($id);

            echo json_encode($data);
        }
    // get

    // delete
        public function delete_detail_pembelian_by_id(){
            $id_detail = $this->input->post("id_detail", TRUE);
            foreach ($id_detail as $id) {
                $this->Main_model->delete_data("detail_pembelian", ["id_pembelian" => $id]);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail pembelian<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('produksi/pembelian');
        }

        public function delete_detail_pembelian_barang_by_id(){
            $id_detail = $this->input->post("id_detail", TRUE);
            foreach ($id_detail as $id) {
                $this->Main_model->delete_data("detail_pembelian_barang", ["id_detail" => $id]);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail pembelian barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('produksi/pembelian');
        }
    // delete

    
    // other function
        public function nominal($data){
            $data = str_replace("Rp. ", "", $data);
            $data = str_replace(".", "", $data);
            return $data;
        }
    // other function
}