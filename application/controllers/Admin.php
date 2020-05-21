<?php
class Admin extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
        $this->load->model("Main_model");
    }

    public function bahanBaku(){
        $data['title'] = "List Bahan Baku";
        $bahan = $this->Main_model->get_all("bahan", ["jenis" => "Baku"], "nama_bahan");
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
        $bahan = $this->Main_model->get_all("bahan", ["jenis" => "Pembantu"], "nama_bahan");
        foreach ($bahan as $i => $bahan) {
            $data['bahan'][$i] = $bahan;
            $sedia = $this->Parfum_model->($bahan['id_bahan']);
            $data['bahan'][$i]['ketersediaan'] = $sedia;
        }
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/bahan", $data);
        $this->load->view("templates/footer");
    }

    public function parfum(){
        $data['title'] = "List Parfum";
        $data['bahan'] = $this->Main_model->get_all("bahan", "", "nama_bahan");
        $parfum = $this->Main_model->get_all("parfum", "", "nama_parfum");
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
        $barang = $this->Main_model->get_all("barang", "", "nama_barang");
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
        $penyetokan = $this->Main_model->get_all("penyetokan", "", "tgl_penyetokan", "DESC");
        $data['penyetokan'] = [];
        foreach ($penyetokan as $i => $penyetokan) {
            $data['penyetokan'][$i] = $penyetokan;
            $stok = $this->Parfum_model->get_stok_penyetokan_by_id_penyetokan($penyetokan['id_penyetokan']);
            $data['penyetokan'][$i]['stok'] = $stok['stok'];
        }
        $data['parfum'] = $this->Main_model->get_all("parfum", "", "nama_parfum");
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/penyetokan", $data);
        $this->load->view("templates/footer");
    }

    public function overhead(){
        $data['title'] = "List Overhead";
        $data['overhead'] = $this->Main_model->get_all("biaya_overhead", "", "tgl", "DESC");
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/overhead", $data);
        $this->load->view("templates/footer");
    }

    public function agen(){
        $data['title'] = "List Agen";
        $data['agen'] = $this->Main_model->get_all("agen", "", "nama_agen");
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/agen", $data);
        $this->load->view("templates/footer");
    }

    public function sales(){
        $data['title'] = "List Sales";
        $data['sales'] = $this->Main_model->get_all("sales", "", "nama_sales");
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/sales", $data);
        $this->load->view("templates/footer");
    }
    
    public function pengeluaran(){
        $data['title'] = "List Pengeluaran Lain-Lain";
        $data['pengeluaran'] = $this->Main_model->get_all("pengeluaran", "", "tgl_pengeluaran", "DESC");
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/pengeluaran", $data);
        $this->load->view("templates/footer");
    }
    
    public function pemasukan(){
        $data['title'] = "List Pemasukan";
        $data['pemasukan'] = $this->Main_model->get_all("pemasukan", "", "tgl_pemasukan", "DESC");
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("admin/pemasukan", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_bahan(){
            $data = [
                "nama_bahan" => $this->input->post("nama_bahan", TRUE),
                "satuan" => $this->input->post("satuan", TRUE),
                "harga_satuan" => $this->nominal($this->input->post("harga_satuan", TRUE)),
                "jenis" => $this->input->post("jenis", TRUE)
            ];
            $result = $this->Main_model->add_data("bahan", $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> bahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> bahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_parfum(){
            $id = $this->Parfum_model->get_last_id_parfum();
            $data = [
                "id_parfum" => $id,
                "nama_parfum" => $this->input->post("nama_parfum"),
                "harga" => $this->nominal($this->input->post("harga")),
                "status" => "aktif",
                "min_stok" => $this->input->post("min_stok", TRUE)
            ];
            $this->Main_model->add_data("parfum", $data);

            $bahan = $this->input->post("id_bahan");
            $qty = $this->input->post("qty");
            foreach ($bahan as $i => $bahan) {
                $data = [
                    "id_bahan" => $bahan,
                    "qty" => $qty[$i],
                    "id_parfum" => $id
                ];
                $this->Main_model->add_data("bahan_parfum", $data);
            }            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/parfum');
        }

        public function add_bahan_parfum_by_id(){
            $id = $this->input->post("id_parfum", TRUE);
            $bahan = $this->input->post("id_bahan");
            $qty = $this->input->post("qty");
            foreach ($bahan as $i => $bahan) {
                $data = [
                    "id_bahan" => $bahan,
                    "qty" => $qty[$i],
                    "id_parfum" => $id
                ];
                $this->Main_model->add_data("bahan_parfum", $data);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> bahan parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/parfum');
        }

        public function add_barang(){
            $data = [
                "nama_barang" => $this->input->post("nama_barang", TRUE),
                "harga" => $this->nominal($this->input->post("harga", TRUE)),
                "status" => "aktif"
            ];
            $result = $this->Main_model->add_data("barang", $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/barang');
        }

        public function add_penyetokan(){
            $id = $this->Parfum_model->get_last_id_penyetokan();
            $data = [
                "id_penyetokan" => $id,
                "tgl_penyetokan" => $this->input->post("tgl_penyetokan", TRUE)
            ];
            $this->Main_model->add_data("penyetokan", $data);

            $parfum = $this->input->post("id_parfum");
            $qty = $this->input->post("qty");
            $id_detail = $this->Parfum_model->get_last_id_detail_penyetokan();
            foreach ($parfum as $i => $parfum) {
                $detail = $this->Main_model->get_one("parfum", ["id_parfum" => $parfum]);
                $data = [
                    "id_detail" => $id_detail,
                    "id_parfum" => $parfum,
                    "qty" => $qty[$i],
                    "id_penyetokan" => $id
                ];
                $this->Main_model->add_data("detail_penyetokan", $data);

                $bahan = $this->Parfum_model->get_bahan_parfum_by_id_parfum($detail['id_parfum']);
                foreach ($bahan as $bahan) {
                    $data = [
                        "id_detail" => $id_detail,
                        "id_bahan" => $bahan['id_bahan'],
                        "qty" => $bahan['qty'],
                        "harga_satuan" => $bahan['harga_satuan']
                    ];
                    $this->Main_model->add_data("penggunaan_bahan", $data);
                }
                $id_detail++;
            }
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> stok parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/penyetokan');
        }

        public function add_detail_penyetokan_by_id(){
            $id = $this->input->post("id_penyetokan", TRUE);
            $parfum = $this->input->post("id_parfum");
            $qty = $this->input->post("qty");
            $id_detail = $this->Parfum_model->get_last_id_detail_penyetokan();
            foreach ($parfum as $i => $parfum) {
                $detail = $this->get_parfum_by_id($parfum);
                $data = [
                    "id_detail" => $id_detail,
                    "id_parfum" => $parfum,
                    "qty" => $qty[$i],
                    "id_penyetokan" => $id
                ];
                $this->Main_model->add_data("detail_penyetokan", $data);

                $bahan = $this->Parfum_model->get_bahan_parfum_by_id_parfum($detail['id_parfum']);
                foreach ($bahan as $bahan) {
                    $data = [
                        "id_detail" => $id_detail,
                        "id_bahan" => $bahan['id_bahan'],
                        "qty" => $bahan['qty'],
                        "harga_satuan" => $bahan['harga_satuan']
                    ];
                    $this->Main_model->add_data("penggunaan_bahan", $data);
                }

                $id_detail++;
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> detail penjualan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/penyetokan');
        }

        public function add_overhead(){
            $data = [
                "tgl" => $this->input->post("tgl", TRUE),
                "jenis" => $this->input->post("jenis", TRUE),
                "nominal" => $this->nominal($this->input->post("nominal", TRUE))
            ];
            $result = $this->Main_model->add_data("biaya_overhead", $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> overhead<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> overhead<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/overhead');
        }

        public function add_agen(){
            $data = [
                'nama_agen' => $this->input->post("nama_agen", TRUE)
            ];
            $result = $this->Main_model->add_data("agen", $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> agen<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> agen<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function add_sales(){
            $data = [
                'nama_sales' => $this->input->post("nama_sales", TRUE)
            ];
            $result = $this->Main_model->add_data("agen", $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> sales<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> sales<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_pengeluaran(){
            $data['tgl_pengeluaran'] = $this->input->post("tgl_pengeluaran", TRUE);
            $data['keterangan'] = $this->input->post("keterangan", TRUE);
            $data['nominal'] = $this->nominal($this->input->post("nominal", TRUE));
            $data['metode'] = $this->input->post("metode", TRUE);
            if($this->input->post("rekening", TRUE)){
                $data['rekening'] = $this->input->post("rekening", TRUE);
            }
            $result = $this->Main_model->add_data("pengeluaran", $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> pengeluaran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> pengeluaran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function add_pemasukan(){
            $data['tgl_pemasukan'] = $this->input->post("tgl_pemasukan", TRUE);
            $data['keterangan'] = $this->input->post("keterangan", TRUE);
            $data['nama'] = $this->input->post("nama", TRUE);
            $data['nominal'] = $this->nominal($this->input->post("nominal", TRUE));
            $data['metode'] = $this->input->post("metode", TRUE);
            if($this->input->post("rekening", TRUE)){
                $data['rekening'] = $this->input->post("rekening", TRUE);
            }

            $result = $this->Main_model->add_data("pemasukan", $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> pemasukan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>menambahkan</strong> pemasukan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

    // edit
        public function edit_bahan_by_id(){
            $id = $this->input->post("id_bahan");
            $data = [
                "nama_bahan" => $this->input->post("nama_bahan", TRUE),
                "satuan" => $this->input->post("satuan", TRUE),
                "harga_satuan" => $this->nominal($this->input->post("harga_satuan", TRUE)),
                "jenis" => $this->input->post("jenis", TRUE)
            ];

            $bahan = $this->Main_model->get_one("bahan", ["id_bahan" => $id]);
            if($bahan['harga_satuan'] != $data['harga_satuan']){
                $edit = [
                    "tgl" => date("Y-m-d"),
                    "id_bahan" => $bahan['id_bahan'],
                    "harga_satuan" => $bahan['harga_satuan']
                ];
                $this->Main_model->add_data("history_bahan", $edit);
            }

            $result = $this->Main_model->edit_data("bahan", ["id_bahan" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data bahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else 
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>mengubah</strong> data bahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function edit_parfum_by_id(){
            $id = $this->input->post("id_parfum");
            $data = [
                "nama_parfum" => $this->input->post("nama_parfum"),
                "harga" => $this->nominal($this->input->post("harga")),
                "status" => $this->input->post("status"),
                "min_stok" => $this->input->post("min_stok", TRUE)
            ];

            $parfum = $this->Main_model->get_one("parfum", ["id_parfum" => $id]);
            if($parfum['harga'] != $data['harga'] || $parfum['min_stok'] != $data['min_stok']){
                $edit = [
                    "tgl" => date("Y-m-d"),
                    "id_parfum" => $parfum['id_parfum'],
                    "harga" => $parfum['harga'],
                    "min_stok" => $parfum['min_stok']
                ];
                $this->Main_model->add_data("history_parfum", $edit);
            }
            $result = $this->Main_model->edit_data("parfum", ["id_parfum" => $id], $data);
            
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else    
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>mengubah</strong> data parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/parfum');
        }
        
        public function edit_barang_by_id(){
            $id = $this->input->post("id_barang");
            $data = [
                "nama_barang" => $this->input->post("nama_barang", TRUE),
                "status" => $this->input->post("status"),
                "harga" => $this->nominal($this->input->post("harga", TRUE))
            ];
            $barang = $this->Main_model->get_one("barang", ["id_barang" => $id]);
            
            if($barang['harga'] != $data['harga']){
                $edit = [
                    "tgl" => date("Y-m-d"),
                    "id_barang" => $barang['id_barang'],
                    "harga" => $barang['harga']
                ];
                $this->Main_model->add_data("history_barang", $edit);
            }

            $result = $this->Main_model->edit_data("barang", ["id_barang" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>mengubah</strong> data barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/barang');
        }

        public function edit_penyetokan_by_id(){
            $id = $this->input->post("id_penyetokan");
            $data = [
                "tgl_penyetokan" => $this->input->post("tgl_penyetokan")
            ];

            $result = $this->Main_model->edit_data("penyetokan", ["id_penyetokan" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data penyetokan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>mengubah</strong> data penyetokan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect('admin/penyetokan');
        }
        
        public function edit_overhead_by_id(){
            $id = $this->input->post("id");
            $data = [
                "tgl" => $this->input->post("tgl", TRUE),
                "jenis" => $this->input->post("jenis", TRUE),
                "nominal" => $this->nominal($this->input->post("nominal", TRUE))
            ];
            $result = $this->Main_model->edit_data("biaya_overhead", ["id" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> data overhead<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>mengubah</strong> data overhead<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/overhead');
        }

        public function edit_agen_by_id(){
            $id = $this->input->post("id");
            $data['nama_agen'] = $this->input->post("nama_agen");

            $result = $this->Main_model->edit_data("agen", ["id_agen" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>merubah</strong> data agen<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>merubah</strong> data agen<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function edit_sales_by_id(){
            $id = $this->input->post("id");
            $data['nama_sales'] = $this->input->post("nama_sales");

            $result = $this->Main_model->edit_data("sales", ["id_sales" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>merubah</strong> data sales<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>merubah</strong> data sales<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function edit_pengeluaran(){
            $id = $this->input->post("id_pengeluaran");
            $data['tgl_pengeluaran'] = $this->input->post("tgl_pengeluaran", TRUE);
            $data['keterangan'] = $this->input->post("keterangan", TRUE);
            $data['nominal'] = $this->nominal($this->input->post("nominal", TRUE));
            $data['metode'] = $this->input->post("metode", TRUE);
            if($this->input->post("rekening", TRUE)){
                $data['rekening'] = $this->input->post("rekening", TRUE);
            }

            $result = $this->Main_model->edit_data("pengeluaran", ["id_pengeluaran" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>merubah</strong> data pengeluaran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>merubah</strong> data pengeluaran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);

        }
        
        public function edit_pemasukan(){
            $id = $this->input->post("id_pemasukan");
            $data['tgl_pemasukan'] = $this->input->post("tgl_pemasukan", TRUE);
            $data['keterangan'] = $this->input->post("keterangan", TRUE);
            $data['nominal'] = $this->nominal($this->input->post("nominal", TRUE));
            $data['nama'] = $this->input->post("nama", TRUE);
            $data['metode'] = $this->input->post("metode", TRUE);
            if($this->input->post("rekening", TRUE)){
                $data['rekening'] = $this->input->post("rekening", TRUE);
            }

            $result = $this->Main_model->edit_data("pemasukan", ["id_pemasukan" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>merubah</strong> data pemasukan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal <strong>merubah</strong> data pemasukan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);

        }
    // edit

    // get
        public function get_bahan_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("bahan", ["id_bahan" => $id]);
            echo json_encode($data);
        }

        public function get_parfum_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("parfum", ["id_parfum" => $id]);
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
            $data = $this->Main_model->get_one("barang", ["id_barang" => $id]);
            echo json_encode($data);
        }
        
        public function get_history_barang_by_id(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_history_barang_by_id($id);
            echo json_encode($data);
        }
        
        public function get_penyetokan_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("penyetokan", ["id_penyetokan" => $id]);
            echo json_encode($data);
        }
        
        public function get_detail_penyetokan_by_id_penyetokan(){
            $id = $this->input->post("id");
            $data = $this->Parfum_model->get_detail_penyetokan_by_id_penyetokan($id);
            echo json_encode($data);
        }

        public function get_overhead_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("biaya_overhead", ["id" => $id]);
            echo json_encode($data);
        }

        public function get_agen_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("agen", ["id_agen" => $id]);
            echo json_encode($data);
        }
        
        public function get_sales_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("sales", ["id_sales" => $id]);
            echo json_encode($data);
        }
        
        public function get_pengeluaran_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("pengeluaran", ["id_pengeluaran" => $id]);
            echo json_encode($data);
        }
        
        public function get_pemasukan_by_id(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("pemasukan", ["id_pemasukan" => $id]);
            echo json_encode($data);
        }
    // get

    // delete
        public function delete_bahan_parfum_by_id(){
            $id_bahan = $this->input->post("id", TRUE);
            foreach ($id_bahan as $id_bahan) {
                $this->Main_model->delete_data("bahan_parfum", ["id" => $id_bahan]);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> bahan Parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/parfum');
        }

        public function delete_history_bahan_by_id(){
            $id_detail = $this->input->post("id", TRUE);

            foreach ($id_detail as $id) {
                $this->Main_model->delete_data("history_bahan", ["id" => $id_detail]);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> history bahan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function delete_history_parfum_by_id(){
            $id_detail = $this->input->post("id", TRUE);
            foreach ($id_detail as $id) {
                $this->Main_model->delete_data("history_parfum", ["id" => $id]);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> history parfum<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        public function delete_history_barang_by_id(){
            $id_detail = $this->input->post("id", TRUE);
            foreach ($id_detail as $id) {
                $this->Main_model->delete_data("history_barang", ["id" => $id]);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> history barang<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function delete_detail_penyetokan_by_id(){
            $id_detail = $this->input->post("id", TRUE);

            foreach ($id_detail as $id) {
                $this->Main_model->delete_data("penggunaan_bahan", ["id_detail" => $id]);
                $this->Main_model->delete_data("detail_penyetokan", ["id_detail" => $id]);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> detail penyetokan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/penyetokan');
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