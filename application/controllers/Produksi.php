<?php
class Produksi extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
    }

    public function pembelian(){
        $data['title'] = "List Pembelian";

        $pembelian = $this->Parfum_model->get_all_pembelian();

        $data['pembelian'] = [];
        foreach ($pembelian as $i => $pembelian) {
            $data['pembelian'][$i] = $pembelian;
            $bahan = $this->Parfum_model->get_total_bahan_by_id_pembelian($pembelian['id_pembelian']);
            $barang = $this->Parfum_model->get_total_barang_by_id_pembelian($pembelian['id_pembelian']);
            $data['pembelian'][$i]['total'] = $bahan['total'] + $barang['total'];
        }

        $data['bahan'] = $this->Parfum_model->get_all_bahan();
        $data['barang'] = $this->Parfum_model->get_all_barang();

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("produksi/pembelian", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_pembelian(){
            // var_dump($_POST);
            $id = $this->Parfum_model->get_last_id_pembelian();
            
            // var_dump($id);
            $this->Parfum_model->add_pembelian($id);

            
            $this->Parfum_model->add_detail_pembelian_by_id($id);

            $this->Parfum_model->add_detail_pembelian_barang_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> pembelian<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('produksi/pembelian');
        }        

        public function add_detail_pembelian_by_id(){
            $id = $this->input->post("id_pembelian", TRUE);

            $this->Parfum_model->add_detail_pembelian_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail pembelian<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('produksi/pembelian');
        }

        public function add_detail_pembelian_barang_by_id(){
            $id = $this->input->post("id_pembelian", TRUE);

            $this->Parfum_model->add_detail_pembelian_barang_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail pembelian barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('produksi/pembelian');
        }
    // add

    // edit
        public function edit_pembelian_by_id(){
            $id = $this->input->post("id_pembelian");
            $this->Parfum_model->edit_pembelian_by_id($id);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data pembelian<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('produksi/pembelian');
        }
    // edit

    // get
        public function get_pembelian_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_pembelian_by_id($id);

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
            $this->Parfum_model->delete_detail_pembelian_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail pembelian<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('produksi/pembelian');
        }

        public function delete_detail_pembelian_barang_by_id(){
            // var_dump($_POST);
            $this->Parfum_model->delete_detail_pembelian_barang_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail pembelian barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('produksi/pembelian');
        }
}