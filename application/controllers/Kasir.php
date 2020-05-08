<?php
class Kasir extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
    }

    public function penjualanAgen(){
        $data['title'] = "List Penjualan Agen";

        $data['penjualan'] = [];
        // $penjualan = $this->Parfum_model->get_all_penjualan();
        $penjualan = $this->Parfum_model->get_all_penjualan_by_tipe("Agen");
        foreach ($penjualan as $i => $penjualan) {
            $data['penjualan'][$i] = $penjualan;
            $tambahan = $this->Parfum_model->get_total_tambahan_by_id_penjualan($penjualan['id_penjualan']);
            $barang = $this->Parfum_model->get_total_barang_by_id_penjualan($penjualan['id_penjualan']);
            $data['penjualan'][$i]['total'] = $penjualan['total'] + $tambahan['total'] + $barang['total'];
        }

        $data['parfum'] = $this->Parfum_model->get_all_parfum();
        $data['bahan'] = $this->Parfum_model->get_all_bahan_by_jenis("Pembantu");
        $data['barang'] = $this->Parfum_model->get_all_barang();
        $data['agen'] = $this->Parfum_model->get_all_agen();
        $data['tipe'] = "Agen";

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("kasir/penjualan", $data);
        $this->load->view("templates/footer");
    }
    
    public function penjualanSales(){
        $data['title'] = "List Penjualan Sales";

        $data['penjualan'] = [];
        // $penjualan = $this->Parfum_model->get_all_penjualan();
        $penjualan = $this->Parfum_model->get_all_penjualan_by_tipe("Sales");
        foreach ($penjualan as $i => $penjualan) {
            $data['penjualan'][$i] = $penjualan;
            $tambahan = $this->Parfum_model->get_total_tambahan_by_id_penjualan($penjualan['id_penjualan']);
            $barang = $this->Parfum_model->get_total_barang_by_id_penjualan($penjualan['id_penjualan']);
            $data['penjualan'][$i]['total'] = $penjualan['total'] + $tambahan['total'] + $barang['total'];
        }

        $data['parfum'] = $this->Parfum_model->get_all_parfum();
        $data['bahan'] = $this->Parfum_model->get_all_bahan_by_jenis("Pembantu");
        $data['barang'] = $this->Parfum_model->get_all_barang();
        $data['sales'] = $this->Parfum_model->get_all_sales();
        $data['tipe'] = "Sales";

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("kasir/penjualan", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_penjualan(){
            $id = $this->Parfum_model->get_last_id_penjualan();
            $parfum = $this->input->post("id_parfum", TRUE);
            $bahan = $this->input->post("id_bahan", TRUE);
            $barang = $this->input->post("id_barang", TRUE);
            $tipe = $this->input->post("tipe", TRUE);

            $adm = 0;
            $ongkir = 0;
            $rekening = "";

            if($this->input->post("adm", true))
                $adm = $this->nominal($this->input->post("adm", true));
            
            if($this->input->post("ongkir", true))
                $ongkir = $this->nominal($this->input->post("ongkir", true));
            
            if($this->input->post("rekening", true))
                $rekening = $this->input->post("rekening", true);

            $data = [
                "id_penjualan" => $id,
                "tgl_penjualan" => $this->input->post("tgl_penjualan"),
                "nama" => $this->input->post("nama"),
                "no_hp" => $this->nominal($this->input->post("no_hp")),
                "alamat" => $this->nominal($this->input->post("alamat")),
                "metode" => $this->input->post("metode"),
                "adm" => $adm,
                "rekening" => $rekening,
                "ongkir" => $ongkir,
                "tipe" => $tipe
            ];

            $this->Parfum_model->add_penjualan($data);

            $this->Parfum_model->add_detail_penjualan_by_id($id);

            // menambahkan bahan tambahan jika tambahan diisi
            $this->Parfum_model->add_bahan_tambahan_by_id($id);

            //menambahkan barang jika barang diisi
            $this->Parfum_model->add_detail_penjualan_barang_by_id($id);

            // tipe penjualan sales or agen
            if($tipe == "Agen"){
                $data = [
                    "id_agen" => $this->input->post("id_agen", TRUE),
                    "id_penjualan" => $id
                ];
                $this->Parfum_model->add_penjualan_agen($data);
            } elseif($tipe == "Sales"){
                $data = [
                    "id_sales" => $this->input->post("id_sales", TRUE),
                    "id_penjualan" => $id
                ];
                $this->Parfum_model->add_penjualan_sales($data);
            }
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_detail_penjualan_by_id(){
            $id = $this->input->post("id_penjualan", TRUE);

            $this->Parfum_model->add_detail_penjualan_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function add_bahan_tambahan_by_id(){
            $id = $this->input->post("id_penjualan", TRUE);

            $this->Parfum_model->add_bahan_tambahan_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function add_detail_penjualan_barang_by_id(){
            $id = $this->input->post("id_penjualan", TRUE);

            $this->Parfum_model->add_detail_penjualan_barang_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

    // edit
        public function edit_penjualan_by_id(){
            $id = $this->input->post("id_penjualan");
            $tipe = $this->input->post("tipe", TRUE);
            $this->Parfum_model->edit_penjualan_by_id($id);

            if($tipe == "Agen"){
                $data = [
                    "id_agen" => $this->input->post("id_agen", TRUE)
                ];

                $this->Parfum_model->edit_penjualan_agen_sales_by_id_penjualan("Agen", $id, $data);
            } else {
                $data = [
                    "id_sales" => $this->input->post("id_sales", TRUE)
                ];

                $this->Parfum_model->edit_penjualan_agen_sales_by_id_penjualan("Sales", $id, $data);
            }

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit

    // get
        public function get_penjualan_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_penjualan_by_id($id);

            echo json_encode($data);
        }
        
        public function get_detail_penjualan_by_id_penjualan(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_detail_penjualan_by_id_penjualan($id);

            echo json_encode($data);
        }

        public function get_tambahan_by_id_penjualan(){
            $id = $this->input->post("id", TRUE);
            $data = $this->Parfum_model->get_tambahan_by_id_penjualan($id);
            echo json_encode($data);
        }
        
        public function get_detail_penjualan_barang_by_id_penjualan(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_detail_penjualan_barang_by_id_penjualan($id);

            echo json_encode($data);
        }

        public function get_id_sales_by_id_penjualan(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_id_sales_by_id_penjualan($id);

            echo json_encode($data);
        }
        
        public function get_id_agen_by_id_penjualan(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_id_agen_by_id_penjualan($id);

            echo json_encode($data);
        }
    // get

    // delete
        public function delete_detail_penjualan_by_id(){
            $this->Parfum_model->delete_detail_penjualan_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function delete_tambahan_penjualan_by_id(){
            $this->Parfum_model->delete_tambahan_penjualan_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> tambahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function delete_detail_penjualan_barang_by_id(){
            $this->Parfum_model->delete_detail_penjualan_barang_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail penjualan barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }
    // delete

    // other
        public function nominal($data){
            $data = str_replace("Rp. ", "", $data);
            $data = str_replace(".", "", $data);
            return $data;
        }
}