<?php
class Admin extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
    }

    public function bahanBaku(){
        $data['title'] = "List Bahan Baku";

        $bahan = $this->Parfum_model->get_all_bahan_by_jenis("Baku");

        foreach ($bahan as $i => $bahan) {
            $data['bahan'][$i] = $bahan;
            $sedia = $this->Parfum_model->get_ketersediaan_bahan_by_id($bahan['id_bahan']);
            $data['bahan'][$i]['ketersediaan'] = $sedia;
        }


        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/bahan", $data);
        $this->load->view("templates/footer");
    }
    
    public function bahanPembantu(){
        $data['title'] = "List Bahan Pembantu";

        $bahan = $this->Parfum_model->get_all_bahan_by_jenis("Pembantu");

        foreach ($bahan as $i => $bahan) {
            $data['bahan'][$i] = $bahan;
            $sedia = $this->Parfum_model->get_ketersediaan_bahan_by_id($bahan['id_bahan']);
            $data['bahan'][$i]['ketersediaan'] = $sedia;
        }


        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/bahan", $data);
        $this->load->view("templates/footer");
    }

    public function parfum(){
        $data['title'] = "List Parfum";

        $data['bahan'] = $this->Parfum_model->get_all_bahan();

        $parfum = $this->Parfum_model->get_all_parfum();
        
        foreach ($parfum as $i => $parfum) {
            $data['parfum'][$i] = $parfum;
            $data['parfum'][$i]['stok'] = $this->Parfum_model->get_stok_parfum_by_id($parfum['id_parfum']);
        }

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/parfum", $data);
        $this->load->view("templates/footer");
    }
    
    public function barang(){
        $data['title'] = "List Barang";

        $barang = $this->Parfum_model->get_all_barang();

        foreach ($barang as $i => $barang) {
            $data['barang'][$i] = $barang;
            $data['barang'][$i]['stok'] = $this->Parfum_model->get_stok_barang_by_id($barang['id_barang']);
        }


        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/barang", $data);
        $this->load->view("templates/footer");
    }

    public function penyetokan(){
        $data['title'] = "List Penyetokan";

        $penyetokan = $this->Parfum_model->get_all_penyetokan();

        $data['penyetokan'] = [];
        
        foreach ($penyetokan as $i => $penyetokan) {
            $data['penyetokan'][$i] = $penyetokan;
            $stok = $this->Parfum_model->get_stok_penyetokan_by_id_penyetokan($penyetokan['id_penyetokan']);
            $data['penyetokan'][$i]['stok'] = $stok['stok'];
        }

        $data['parfum'] = $this->Parfum_model->get_all_parfum();

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/penyetokan", $data);
        $this->load->view("templates/footer");
    }

    public function overhead(){
        $data['title'] = "List Overhead";

        $data['overhead'] = $this->Parfum_model->get_all_overhead();

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/overhead", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_bahan(){
            $this->Parfum_model->add_bahan();
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> bahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_parfum(){
            // var_dump($_POST);
            $id = $this->Parfum_model->get_last_id_parfum();
            
            // var_dump($id);
            $this->Parfum_model->add_parfum($id);

            $this->Parfum_model->add_bahan_parfum_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/parfum');
        }

        public function add_bahan_parfum_by_id(){
            $id = $this->input->post("id_parfum", TRUE);

            $this->Parfum_model->add_bahan_parfum_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> bahan parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/parfum');
        }

        public function add_barang(){
            $this->Parfum_model->add_barang();
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/barang');
        }

        public function add_penyetokan(){
            // var_dump($_POST);
            $id = $this->Parfum_model->get_last_id_penyetokan();

            $this->Parfum_model->add_penyetokan($id);
            
            $this->Parfum_model->add_detail_penyetokan_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> stok parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/penyetokan');
        }

        public function add_detail_penyetokan_by_id(){
            $id = $this->input->post("id_penyetokan", TRUE);

            $this->Parfum_model->add_detail_penyetokan_by_id($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/penyetokan');
        }

        public function add_overhead(){
            // var_dump($_POST);
            $this->Parfum_model->add_overhead();
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> overhead<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/overhead');
        }
    // add

    // edit
        public function edit_bahan_by_id(){
            $id = $this->input->post("id_bahan");
            $this->Parfum_model->edit_bahan_by_id($id);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data bahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }

        
        public function edit_parfum_by_id(){
            $id = $this->input->post("id_parfum");
            $this->Parfum_model->edit_parfum_by_id($id);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/parfum');
        }
        
        public function edit_barang_by_id(){
            $id = $this->input->post("id_barang");
            $this->Parfum_model->edit_barang_by_id($id);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/barang');
        }

        public function edit_penyetokan_by_id(){
            $id = $this->input->post("id_penyetokan");
            $this->Parfum_model->edit_penyetokan_by_id($id);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data penyetokan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/penyetokan');
        }
        
        public function edit_overhead_by_id(){
            $id = $this->input->post("id");
            $this->Parfum_model->edit_overhead_by_id($id);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data overhead<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/overhead');
        }
    // edit

    // get
        public function get_bahan_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_bahan_by_id($id);

            echo json_encode($data);
        }

        public function get_parfum_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_parfum_by_id($id);

            echo json_encode($data);
        }
        
        public function get_bahan_parfum_by_id_parfum(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_bahan_parfum_by_id_parfum($id);

            echo json_encode($data);
        }

        public function get_history_bahan_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_history_bahan_by_id($id);

            echo json_encode($data);
        }
        
        public function get_history_parfum_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_history_parfum_by_id($id);

            echo json_encode($data);
        }
        
        public function get_barang_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_barang_by_id($id);

            echo json_encode($data);
        }
        
        public function get_history_barang_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_history_barang_by_id($id);

            echo json_encode($data);
        }
        
        public function get_penyetokan_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_penyetokan_by_id($id);

            echo json_encode($data);
        }
        
        public function get_detail_penyetokan_by_id_penyetokan(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_detail_penyetokan_by_id_penyetokan($id);

            echo json_encode($data);
        }

        public function get_overhead_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_overhead_by_id($id);

            echo json_encode($data);
        }
    // get

    // delete
        public function delete_bahan_parfum_by_id(){
            // var_dump($_POST);
            
            $this->Parfum_model->delete_bahan_parfum_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> bahan Parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/parfum');
        }

        public function delete_history_bahan_by_id(){
            $this->Parfum_model->delete_history_bahan_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> history bahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function delete_history_parfum_by_id(){
            $this->Parfum_model->delete_history_parfum_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> history parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function delete_history_barang_by_id(){
            $this->Parfum_model->delete_history_barang_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> history barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function delete_detail_penyetokan_by_id(){
            $this->Parfum_model->delete_detail_penyetokan_by_id();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail penyetokan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/penyetokan');
        }
    // delete
}