<?php
class Laporan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
    }

    public function index(){
        $data['title'] = "Cetak Laporan";
        
        $data['month'] = ["1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];

        // $data['periode'] = $this->Parfum_model->get_periode();

        // var_dump($periode);

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("laporan/form-laporan", $data);
        $this->load->view("templates/footer");
    }

    public function hpp($periode){
        $date = explode("%20", $periode);

        $month = ["1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];

        $data['title'] = "Laporan HPP " . $month[$date['0']] ." " . $date['1'];

        $data['bahan_baku_awal'] = $this->Parfum_model->get_persediaan_bahan_baku_awal($periode);
        $data['bahan_pembantu_awal'] = $this->Parfum_model->get_persediaan_bahan_pembantu_awal($periode);

        $data['pembelian_bahan_baku'] = $this->Parfum_model->get_pembelian_bahan_by_jenis_by_periode("Baku", $periode);

        $data['pembelian_bahan_pembantu'] = $this->Parfum_model->get_pembelian_bahan_by_jenis_by_periode("Pembantu", $periode);

        $data['bahan_baku_akhir'] = $this->Parfum_model->get_persediaan_bahan_baku_akhir($periode);
        $data['bahan_pembantu_akhir'] = $this->Parfum_model->get_persediaan_bahan_pembantu_akhir($periode);

        $data['biaya_kerja'] = $this->Parfum_model->get_biaya_kerja_by_periode($periode);
        $data['biaya_overhead'] = $this->Parfum_model->get_biaya_overhead_by_periode($periode);
        // $data['other'] = $this->Parfum_model->get_other_by_periode($periode);

        // var_dump($data);
        
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("laporan/export-hpp", $data);
        $this->load->view("templates/footer");
    }

    public function cetak_laporan(){
        $laporan = $this->input->post("laporan", TRUE);

        if($laporan == "Laporan Penjualan Transfer"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            
            $filename = "Penjualan_Transfer_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $data['bca'] = [];

            $penjualan = $this->Parfum_model->get_penjualan_transfer_by_periode($bulan, $tahun, "BCA");
            foreach ($penjualan as $i => $penjualan) {
                $data['bca'][$i] = $penjualan;
                
                $parfum = $this->Parfum_model->get_detail_penjualan_by_id_penjualan($penjualan['id_penjualan']);
                $data['bca'][$i]['detail']['parfum'] = [];
                foreach ($parfum as $j => $parfum) {
                    $data['bca'][$i]['detail']['parfum'][$j] = $parfum;
                }
                
                $barang = $this->Parfum_model->get_detail_penjualan_barang_by_id_penjualan($penjualan['id_penjualan']);
                $data['bca'][$i]['detail']['barang'] = [];
                foreach ($barang as $j => $barang) {
                    $data['bca'][$i]['detail']['barang'][$j] = $barang;
                }
                
                $tambahan = $this->Parfum_model->get_detail_tambahan_by_id_penjualan($penjualan['id_penjualan']);
                $data['bca'][$i]['detail']['tambahan'] = [];
                foreach ($tambahan as $j => $tambahan) {
                    $data['bca'][$i]['detail']['tambahan'][$j] = $tambahan;
                }
                // $data['data'][$i]['detail'] = 
            }
            
            $data['bri'] = [];

            $penjualan = $this->Parfum_model->get_penjualan_transfer_by_periode($bulan, $tahun, "BRI");
            foreach ($penjualan as $i => $penjualan) {
                $data['bri'][$i] = $penjualan;
                
                $parfum = $this->Parfum_model->get_detail_penjualan_by_id_penjualan($penjualan['id_penjualan']);
                $data['bri'][$i]['detail']['parfum'] = [];
                foreach ($parfum as $j => $parfum) {
                    $data['bri'][$i]['detail']['parfum'][$j] = $parfum;
                }
                
                $barang = $this->Parfum_model->get_detail_penjualan_barang_by_id_penjualan($penjualan['id_penjualan']);
                $data['bri'][$i]['detail']['barang'] = [];
                foreach ($barang as $j => $barang) {
                    $data['bri'][$i]['detail']['barang'][$j] = $barang;
                }
                
                $tambahan = $this->Parfum_model->get_detail_tambahan_by_id_penjualan($penjualan['id_penjualan']);
                $data['bri'][$i]['detail']['tambahan'] = [];
                foreach ($tambahan as $j => $tambahan) {
                    $data['bri'][$i]['detail']['tambahan'][$j] = $tambahan;
                }
                // $data['data'][$i]['detail'] = 
            }
            
            $data['mandiri'] = [];
            $penjualan = $this->Parfum_model->get_penjualan_transfer_by_periode($bulan, $tahun, "Mandiri");
            foreach ($penjualan as $i => $penjualan) {
                $data['mandiri'][$i] = $penjualan;
                
                $parfum = $this->Parfum_model->get_detail_penjualan_by_id_penjualan($penjualan['id_penjualan']);
                $data['mandiri'][$i]['detail']['parfum'] = [];
                foreach ($parfum as $j => $parfum) {
                    $data['mandiri'][$i]['detail']['parfum'][$j] = $parfum;
                }
                
                $barang = $this->Parfum_model->get_detail_penjualan_barang_by_id_penjualan($penjualan['id_penjualan']);
                $data['mandiri'][$i]['detail']['barang'] = [];
                foreach ($barang as $j => $barang) {
                    $data['mandiri'][$i]['detail']['barang'][$j] = $barang;
                }
                
                $tambahan = $this->Parfum_model->get_detail_tambahan_by_id_penjualan($penjualan['id_penjualan']);
                $data['mandiri'][$i]['detail']['tambahan'] = [];
                foreach ($tambahan as $j => $tambahan) {
                    $data['mandiri'][$i]['detail']['tambahan'][$j] = $tambahan;
                }
                // $data['data'][$i]['detail'] = 
            }

            $this->load->view("laporan/export-penjualan-transfer", $data);

        } else if($laporan == "Laporan Penjualan Keseluruhan"){
            $filename = "Penjualan_Keseluruhan_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);

            $data['data'] = [];

            $penjualan = $this->Parfum_model->get_penjualan_by_periode($bulan, $tahun);
            foreach ($penjualan as $i => $penjualan) {
                $data['data'][$i] = $penjualan;
                
                $parfum = $this->Parfum_model->get_detail_penjualan_by_id_penjualan($penjualan['id_penjualan']);
                $data['data'][$i]['detail']['parfum'] = [];
                foreach ($parfum as $j => $parfum) {
                    $data['data'][$i]['detail']['parfum'][$j] = $parfum;
                }
                
                $barang = $this->Parfum_model->get_detail_penjualan_barang_by_id_penjualan($penjualan['id_penjualan']);
                $data['data'][$i]['detail']['barang'] = [];
                foreach ($barang as $j => $barang) {
                    $data['data'][$i]['detail']['barang'][$j] = $barang;
                }
                
                $tambahan = $this->Parfum_model->get_detail_tambahan_by_id_penjualan($penjualan['id_penjualan']);
                $data['data'][$i]['detail']['tambahan'] = [];
                foreach ($tambahan as $j => $tambahan) {
                    $data['data'][$i]['detail']['tambahan'][$j] = $tambahan;
                }
                // $data['data'][$i]['detail'] = 
            }
            $this->load->view("laporan/export-penjualan", $data);
        } else if($laporan == "Laporan Penjualan Sales"){
            $data['title'] = "Laporan Penjualan Sales";
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $filename = "Penjualan_Sales_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');
            
            $data['data'] = [];

            $sales = $this->Parfum_model->get_sales_by_periode($bulan, $tahun);
            foreach ($sales as $i => $sales) {
                $data['data'][$i] = $sales;
                $penjualan = $this->Parfum_model->get_penjualan_sales_by_periode($bulan, $tahun, $sales['id_sales']);
                foreach ($penjualan as $k => $penjualan) {
                    $data['data'][$i]['penjualan'][$k] = $penjualan;
                    
                    $parfum = $this->Parfum_model->get_detail_penjualan_by_id_penjualan($penjualan['id_penjualan']);
                    $data['data'][$i]['penjualan'][$k]['detail']['parfum'] = [];
                    foreach ($parfum as $j => $parfum) {
                        $data['data'][$i]['penjualan'][$k]['detail']['parfum'][$j] = $parfum;
                    }
                    
                    $barang = $this->Parfum_model->get_detail_penjualan_barang_by_id_penjualan($penjualan['id_penjualan']);
                    $data['data'][$i]['penjualan'][$k]['detail']['barang'] = [];
                    foreach ($barang as $j => $barang) {
                        $data['data'][$i]['penjualan'][$k]['detail']['barang'][$j] = $barang;
                    }
                    
                    $tambahan = $this->Parfum_model->get_detail_tambahan_by_id_penjualan($penjualan['id_penjualan']);
                    $data['data'][$i]['penjualan'][$k]['detail']['tambahan'] = [];
                    foreach ($tambahan as $j => $tambahan) {
                        $data['data'][$i]['penjualan'][$k]['detail']['tambahan'][$j] = $tambahan;
                    }
                }
            }
            $this->load->view("laporan/export-penjualan-sales", $data);
        } else if($laporan == "Laporan Penjualan Agen"){
            $data['title'] = "Laporan Penjualan Agen";
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $filename = "Penjualan_Agen_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');
            
            $data['data'] = [];

            $agen = $this->Parfum_model->get_agen_by_periode($bulan, $tahun);
            foreach ($agen as $i => $agen) {
                $data['data'][$i] = $agen;
                $penjualan = $this->Parfum_model->get_penjualan_agen_by_periode($bulan, $tahun, $agen['id_agen']);
                foreach ($penjualan as $k => $penjualan) {
                    $data['data'][$i]['penjualan'][$k] = $penjualan;
                    
                    $parfum = $this->Parfum_model->get_detail_penjualan_by_id_penjualan($penjualan['id_penjualan']);
                    $data['data'][$i]['penjualan'][$k]['detail']['parfum'] = [];
                    foreach ($parfum as $j => $parfum) {
                        $data['data'][$i]['penjualan'][$k]['detail']['parfum'][$j] = $parfum;
                    }
                    
                    $barang = $this->Parfum_model->get_detail_penjualan_barang_by_id_penjualan($penjualan['id_penjualan']);
                    $data['data'][$i]['penjualan'][$k]['detail']['barang'] = [];
                    foreach ($barang as $j => $barang) {
                        $data['data'][$i]['penjualan'][$k]['detail']['barang'][$j] = $barang;
                    }
                    
                    $tambahan = $this->Parfum_model->get_detail_tambahan_by_id_penjualan($penjualan['id_penjualan']);
                    $data['data'][$i]['penjualan'][$k]['detail']['tambahan'] = [];
                    foreach ($tambahan as $j => $tambahan) {
                        $data['data'][$i]['penjualan'][$k]['detail']['tambahan'][$j] = $tambahan;
                    }
                }
            }
            $this->load->view("laporan/export-penjualan-sales", $data);
        } else if($laporan == "Laporan Pembelian Barang"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $filename = "Pembelian_Barang_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $data['data'] = [];

            $pembelian = $this->Parfum_model->get_pembelian_by_periode($bulan, $tahun);
            foreach ($pembelian as $i => $pembelian) {
                $data['data'][$i] = $pembelian;
                
                $barang = $this->Parfum_model->get_detail_pembelian_barang_by_id_pembelian($pembelian['id_pembelian']);
                $data['data'][$i]['detail']['barang'] = [];
                foreach ($barang as $j => $barang) {
                    $data['data'][$i]['detail']['barang'][$j] = $barang;
                }
                
                $tambahan = $this->Parfum_model->get_detail_pembelian_by_id_pembelian($pembelian['id_pembelian']);
                $data['data'][$i]['detail']['tambahan'] = [];
                foreach ($tambahan as $j => $tambahan) {
                    $data['data'][$i]['detail']['tambahan'][$j] = $tambahan;
                }
            }
            // var_dump($data);
            $this->load->view("laporan/export-pembelian", $data);
        } else if($laporan == "Laporan Pembelian Barang Transfer"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            
            $filename = "Pembelian_Transfer_" . $bulan . "_" . $tahun;
            // header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            // header('Content-Disposition: attachment;filename='.$filename.'xls');

            $data['bca'] = [];

            $pembelian = $this->Parfum_model->get_pembelian_transfer_by_periode($bulan, $tahun, "BCA");
            foreach ($pembelian as $i => $pembelian) {
                $data['bca'][$i] = $pembelian;

                $barang = $this->Parfum_model->get_detail_pembelian_barang_by_id_pembelian($pembelian['id_pembelian']);
                $data['bca'][$i]['detail']['barang'] = [];
                foreach ($barang as $j => $barang) {
                    $data['bca'][$i]['detail']['barang'][$j] = $barang;
                }
                
                $tambahan = $this->Parfum_model->get_detail_pembelian_by_id_pembelian($pembelian['id_pembelian']);
                $data['bca'][$i]['detail']['tambahan'] = [];
                foreach ($tambahan as $j => $tambahan) {
                    $data['bca'][$i]['detail']['tambahan'][$j] = $tambahan;
                }
                // $data['data'][$i]['detail'] = 
            }
            
            $data['bri'] = [];

            $pembelian = $this->Parfum_model->get_pembelian_transfer_by_periode($bulan, $tahun, "BRI");
            foreach ($pembelian as $i => $pembelian) {
                $data['bri'][$i] = $pembelian;

                $barang = $this->Parfum_model->get_detail_pembelian_barang_by_id_pembelian($pembelian['id_pembelian']);
                $data['bri'][$i]['detail']['barang'] = [];
                foreach ($barang as $j => $barang) {
                    $data['bri'][$i]['detail']['barang'][$j] = $barang;
                }
                
                $tambahan = $this->Parfum_model->get_detail_pembelian_by_id_pembelian($pembelian['id_pembelian']);
                $data['bri'][$i]['detail']['tambahan'] = [];
                foreach ($tambahan as $j => $tambahan) {
                    $data['bri'][$i]['detail']['tambahan'][$j] = $tambahan;
                }
                // $data['data'][$i]['detail'] = 
            }
            
            $data['mandiri'] = [];
            $pembelian = $this->Parfum_model->get_pembelian_transfer_by_periode($bulan, $tahun, "Mandiri");
            foreach ($pembelian as $i => $pembelian) {
                $data['mandiri'][$i] = $pembelian;

                $barang = $this->Parfum_model->get_detail_pembelian_barang_by_id_pembelian($pembelian['id_pembelian']);
                $data['mandiri'][$i]['detail']['barang'] = [];
                foreach ($barang as $j => $barang) {
                    $data['mandiri'][$i]['detail']['barang'][$j] = $barang;
                }
                
                $tambahan = $this->Parfum_model->get_detail_pembelian_by_id_pembelian($pembelian['id_pembelian']);
                $data['mandiri'][$i]['detail']['tambahan'] = [];
                foreach ($tambahan as $j => $tambahan) {
                    $data['mandiri'][$i]['detail']['tambahan'][$j] = $tambahan;
                }
                // $data['data'][$i]['detail'] = 
            }
            // var_dump($data);
            $this->load->view("laporan/export-pembelian-transfer", $data);
        } else if($laporan == "Laporan Penjualan Barang"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            
            $filename = "Penjualan_Barang_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $penjualan = $this->Parfum_model->get_penjualan_barang_by_periode($bulan, $tahun);
            $data['barang'] = [];
            foreach ($penjualan as $i => $penjualan) {
                $data['barang'][$i] = $this->Parfum_model->get_barang_by_id($penjualan['id_barang']);
                $data['barang'][$i]['total'] = $penjualan['total'];
            }
            
            $penjualan = $this->Parfum_model->get_penjualan_parfum_by_periode($bulan, $tahun);
            $data['parfum'] = [];
            foreach ($penjualan as $i => $penjualan) {
                $data['parfum'][$i] = $this->Parfum_model->get_parfum_by_id($penjualan['id_parfum']);
                $data['parfum'][$i]['total'] = $penjualan['total'];
            }
            
            $penjualan = $this->Parfum_model->get_penjualan_tambahan_by_periode($bulan, $tahun);
            $data['tambahan'] = [];
            foreach ($penjualan as $i => $penjualan) {
                $data['tambahan'][$i] = $this->Parfum_model->get_bahan_by_id($penjualan['id_bahan']);
                $data['tambahan'][$i]['total'] = $penjualan['total'];
            }

            $this->load->view("laporan/export-penjualan-barang", $data);
            // var_dump($data);

        }
    }
}



// <option value="Penjualan">Laporan Penjualan Keseluruhan</option>
// <option value="Pembelian">Laporan Pembelian Keseluruhan</option>
// <option value="Barang">Laporan Penjualan Barang</option>