<?php
class Kasir extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
    }

    public function penjualan(){
        $data['title'] = "List Penjualan";

        $data['penjualan'] = [];
        $penjualan = $this->Parfum_model->get_all_penjualan();
        foreach ($penjualan as $i => $penjualan) {
            $data['penjualan'][$i] = $penjualan;
            $tambahan = $this->Parfum_model->get_total_tambahan_by_id_penjualan($penjualan['id_penjualan']);
            $barang = $this->Parfum_model->get_total_barang_by_id_penjualan($penjualan['id_penjualan']);
            $data['penjualan'][$i]['total'] = $penjualan['total'] + $tambahan['total'] + $barang['total'];
        }

        $data['parfum'] = $this->Parfum_model->get_all_parfum();
        $data['bahan'] = $this->Parfum_model->get_all_bahan_by_jenis("Pembantu");
        $data['barang'] = $this->Parfum_model->get_all_barang();

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("kasir/penjualan", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_penjualan(){
            var_dump($_POST);
            $id = $this->Parfum_model->get_last_id_penjualan();
            $parfum = $this->input->post("id_parfum", TRUE);
            $bahan = $this->input->post("id_bahan", TRUE);
            $barang = $this->input->post("id_barang", TRUE);

            $this->Parfum_model->add_penjualan($id);

            $this->Parfum_model->add_detail_penjualan_by_id($id);

            // menambahkan bahan tambahan jika tambahan diisi
            $this->Parfum_model->add_bahan_tambahan_by_id($id);

            //menambahkan barang jika barang diisi
            $this->Parfum_model->add_detail_penjualan_barang_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('kasir/penjualan');
        }

        public function add_detail_penjualan_by_id(){
            $id = $this->input->post("id_penjualan", TRUE);

            $this->Parfum_model->add_detail_penjualan_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('kasir/penjualan');
        }
        
        public function add_bahan_tambahan_by_id(){
            $id = $this->input->post("id_penjualan", TRUE);

            $this->Parfum_model->add_bahan_tambahan_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('kasir/penjualan');
        }
        
        public function add_detail_penjualan_barang_by_id(){
            $id = $this->input->post("id_penjualan", TRUE);

            $this->Parfum_model->add_detail_penjualan_barang_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('kasir/penjualan');
        }
    // add

    // edit
        public function edit_penjualan_by_id(){
            $id = $this->input->post("id_penjualan");
            $this->Parfum_model->edit_penjualan_by_id($id);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('kasir/penjualan');
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
    // get

    // delete
        public function delete_detail_penjualan_by_id(){
            $this->Parfum_model->delete_detail_penjualan_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('kasir/penjualan');
        }

        public function delete_tambahan_penjualan_by_id(){
            $this->Parfum_model->delete_tambahan_penjualan_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> tambahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('kasir/penjualan');
        }
        
        public function delete_detail_penjualan_barang_by_id(){
            $this->Parfum_model->delete_detail_penjualan_barang_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail penjualan barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('kasir/penjualan');
        }
    // delete
}