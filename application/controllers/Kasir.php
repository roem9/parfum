<?php
class Kasir extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
        $this->load->model("Main_model");
    }

    public function penjualanAgen(){
        $data['title'] = "List Penjualan Agen";

        $data['penjualan'] = [];
        $penjualan = $this->Parfum_model->get_all_penjualan_by_tipe("Agen");
        foreach ($penjualan as $i => $penjualan) {
            $data['penjualan'][$i] = $penjualan;
            $tambahan = $this->Parfum_model->get_total_tambahan_by_id_penjualan($penjualan['id_penjualan']);
            $barang = $this->Parfum_model->get_total_barang_by_id_penjualan($penjualan['id_penjualan']);
            $data['penjualan'][$i]['total'] = $penjualan['total'] + $tambahan['total'] + $barang['total'];
        }
        $data['parfum'] = $this->Main_model->get_all("parfum", "", "nama_parfum");
        $data['bahan'] = $this->Main_model->get_all("bahan", ["jenis" => "Pembantu"], "nama_bahan");
        $data['barang'] = $this->Main_model->get_all("barang", "", "nama_barang");
        $data['agen'] = $this->Main_model->get_all("agen", "", "nama_agen");
        $data['tipe'] = "Agen";

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("kasir/penjualan", $data);
        $this->load->view("templates/footer");
    }
    
    public function penjualanSales(){
        $data['title'] = "List Penjualan Sales";

        $data['penjualan'] = [];
        $penjualan = $this->Parfum_model->get_all_penjualan_by_tipe("Sales");
        foreach ($penjualan as $i => $penjualan) {
            $data['penjualan'][$i] = $penjualan;
            $tambahan = $this->Parfum_model->get_total_tambahan_by_id_penjualan($penjualan['id_penjualan']);
            $barang = $this->Parfum_model->get_total_barang_by_id_penjualan($penjualan['id_penjualan']);
            $data['penjualan'][$i]['total'] = $penjualan['total'] + $tambahan['total'] + $barang['total'];
        }
        $data['parfum'] = $this->Main_model->get_all("parfum", "", "nama_parfum");
        $data['bahan'] = $this->Main_model->get_all("bahan", ["jenis" => "Pembantu"], "nama_bahan");
        $data['barang'] = $this->Main_model->get_all("barang", "", "nama_barang");
        $data['sales'] = $this->Main_model->get_all("sales", "", "nama_sales");
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
                "no_hp" => $this->input->post("no_hp"),
                "alamat" => $this->input->post("alamat"),
                "metode" => $this->input->post("metode"),
                "adm" => $adm,
                "rekening" => $rekening,
                "ongkir" => $ongkir,
                "tipe" => $tipe,
                "diskon" => $this->nominal($this->input->post("diskon", TRUE))
            ];
            $this->Main_model->add_data("penjualan", $data);
            $parfum = $this->input->post("id_parfum");
            $qty = $this->input->post("qty");
            foreach ($parfum as $i => $parfum) {
                $detail = $this->Main_model->get_one("parfum", ["id_parfum" => $parfum]);
                if($detail){
                    $data = [
                        "id_parfum" => $parfum,
                        "qty" => $qty[$i],
                        "id_penjualan" => $id,
                        "harga" => $detail['harga']
                    ];
                    $this->Main_model->add_data("detail_penjualan", $data);
                }
            }
            // menambahkan bahan tambahan jika tambahan diisi
                $bahan = $this->input->post("id_bahan");
                $qty = $this->input->post("qty_tambahan");

                foreach ($bahan as $i => $bahan) {
                    $bhn = $this->Main_model->get_one("bahan", ["id_bahan" => $bahan]);
                    if($bhn){
                        $data = [
                            "id_bahan" => $bahan,
                            "harga" => $bhn['harga_satuan'],
                            "qty" => $qty[$i],
                            "id_penjualan" => $id
                        ];
                        $this->Main_model->add_data("penggunaan_bahan_tambahan", $data);
                    }
                }
            //menambahkan barang jika barang diisi
                $barang = $this->input->post("id_barang");
                $qty = $this->input->post("qty_barang");
                foreach ($barang as $i => $barang) {
                    $detail = $this->Main_model->get_one("barang", ["id_barang" => $barang]);
                    if($detail){
                        $data = [
                            "id_barang" => $barang,
                            "qty" => $qty[$i],
                            "id_penjualan" => $id,
                            "harga" => $detail['harga']
                        ];
        
                        // $this->db->insert("detail_penjualan_barang", $data);
                        $this->Main_model->add_data("detail_penjualan_barang", $data);
                    }
                }
            // tipe penjualan sales or agen
            if($tipe == "Agen"){
                $data = [
                    "id_agen" => $this->input->post("id_agen", TRUE),
                    "id_penjualan" => $id
                ];
                $this->Main_model->add_data("penjualan_agen", $data);
            } elseif($tipe == "Sales"){
                $data = [
                    "id_sales" => $this->input->post("id_sales", TRUE),
                    "id_penjualan" => $id
                ];
                $this->Main_model->add_data("penjualan_sales", $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_detail_penjualan_by_id(){
            $id = $this->input->post("id_penjualan", TRUE);
            $parfum = $this->input->post("id_parfum");
            $qty = $this->input->post("qty");
            foreach ($parfum as $i => $parfum) {
                $detail = $this->Main_model->get_one("parfum", ["id_parfum" => $parfum]);
                if($detail){
                    $data = [
                        "id_parfum" => $parfum,
                        "qty" => $qty[$i],
                        "id_penjualan" => $id,
                        "harga" => $detail['harga']
                    ];
                    $this->Main_model->add_data("detail_penjualan", $data);
                }
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function add_bahan_tambahan_by_id(){
            $id = $this->input->post("id_penjualan", TRUE);
            $bahan = $this->input->post("id_bahan");
            $qty = $this->input->post("qty_tambahan");
            foreach ($bahan as $i => $bahan) {
                $bhn = $this->Main_model->get_one("bahan", ["id_bahan" => $bahan]);
                if($bhn){
                    $data = [
                        "id_bahan" => $bahan,
                        "harga" => $bhn['harga_satuan'],
                        "qty" => $qty[$i],
                        "id_penjualan" => $id
                    ];
                    $this->Main_model->add_data("penggunaan_bahan_tambahan", $data);
                }
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function add_detail_penjualan_barang_by_id(){
            $id = $this->input->post("id_penjualan", TRUE);
            $barang = $this->input->post("id_barang");
            $qty = $this->input->post("qty_barang");
            foreach ($barang as $i => $barang) {
                $detail = $this->Main_model->get_one("barang", ["id_barang" => $barang]);
                if($detail){
                    $data = [
                        "id_barang" => $barang,
                        "qty" => $qty[$i],
                        "id_penjualan" => $id,
                        "harga" => $detail['harga']
                    ];
                    $this->Main_model->add_data("detail_penjualan_barang", $data);
                }
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

    // edit
        public function edit_penjualan_by_id(){
            $id = $this->input->post("id_penjualan");
            $tipe = $this->input->post("tipe", TRUE);
            
            // if form empty
                if($this->input->post("adm", true)){
                    $adm = $this->nominal($this->input->post("adm", true));
                } else {
                    $adm = 0;
                }
                
                if($this->input->post("ongkir", true)){
                    $ongkir = $this->nominal($this->input->post("ongkir", true));
                } else {
                    $ongkir = 0;
                }
                
                if($this->input->post("rekening", true)){
                    $rekening = $this->input->post("rekening", true);
                } else {
                    $rekening = '';
                }
            // if form empty

            $data = [
                "tgl_penjualan" => $this->input->post("tgl_penjualan"),
                "nama" => $this->input->post("nama"),
                "no_hp" => $this->input->post("no_hp"),
                "alamat" => $this->input->post("alamat"),
                "metode" => $this->input->post("metode"),
                "adm" => $adm,
                "rekening" => $rekening,
                "ongkir" => $ongkir,
                "diskon" => $this->nominal($this->input->post("diskon", TRUE))
            ];
            $this->Main_model->edit_data("penjualan", ["id_penjualan" => $id], $data);

            if($tipe == "Agen"){
                $data = [
                    "id_agen" => $this->input->post("id_agen", TRUE)
                ];
                $this->Main_model->edit_data("penjualan_agen", ["id_penjualan" => $id], $data);
            } else {
                $data = [
                    "id_sales" => $this->input->post("id_sales", TRUE)
                ];
                $this->Main_model->edit_data("penjualan_sales", ["id_penjualan" => $id], $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit

    // get
        public function get_penjualan_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("penjualan", ["id_penjualan" => $id]);
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
            $id_detail = $this->input->post("id_detail", TRUE);
            foreach ($id_detail as $id) {
                $this->Main_model->delete_data("detail_penjualan", ["id_detail" => $id]);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function delete_tambahan_penjualan_by_id(){
            $id_detail = $this->input->post("id", TRUE);
            foreach ($id_detail as $id) {
                $this->Main_model->delete_data("penggunaan_bahan_tambahan", ["id" => $id]);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> tambahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function delete_detail_penjualan_barang_by_id(){
            $id_detail = $this->input->post("id_detail", TRUE);
            foreach ($id_detail as $id) {
                $this->Main_model->delete_data("detail_penjualan_barang", ["id_detail" => $id]);
            }
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
    // other
}