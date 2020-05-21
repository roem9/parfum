<?php
class Laporan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
        $this->load->model("Main_model");
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
    }

    public function index(){
        $data['title'] = "Cetak Laporan";
        
        $data['month'] = ["1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];
        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("laporan/form-laporan", $data);
        $this->load->view("templates/footer");
    }

    public function cetak_laporan(){
        $month = ["1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];
        $laporan = $this->input->post("laporan", TRUE);

        if($laporan == "Laporan Penjualan Transfer"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $data['title'] = $month[$bulan] ." " . $tahun;
            
            $filename = "Penjualan_Transfer_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $data['bca'] = [];

            // penjualan transfer ke bca by periode
            $where = ["MONTH(tgl_penjualan)" => $bulan, "YEAR(tgl_penjualan)" => $tahun, "metode" => "transfer", "rekening" => "BCA"];
            $penjualan = $this->Main_model->get_all("penjualan", $where);
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
            }
            
            $data['bri'] = [];
            // penjualan transfer ke bri by periode
            $where = ["MONTH(tgl_penjualan)" => $bulan, "YEAR(tgl_penjualan)" => $tahun, "metode" => "transfer", "rekening" => "BRI"];
            $penjualan = $this->Main_model->get_all("penjualan", $where);
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
            }
            
            $data['mandiri'] = [];
            // penjualan transfer ke mandiri by periode
            $where = ["MONTH(tgl_penjualan)" => $bulan, "YEAR(tgl_penjualan)" => $tahun, "metode" => "transfer", "rekening" => "Mandiri"];
            $penjualan = $this->Main_model->get_all("penjualan", $where);
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
            }
            $this->load->view("laporan/export-penjualan-transfer", $data);

        } else if($laporan == "Laporan Penjualan Keseluruhan"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $filename = "Penjualan_Keseluruhan_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $data['title'] = "Laporan Penjualan " . $month[$bulan] ." " . $tahun;

            $data['data'] = [];

            // penjualan by periode
            $penjualan = $this->Main_model->get_all("penjualan", ["MONTH(tgl_penjualan)" => $bulan, "YEAR(tgl_penjualan)" => $tahun]);
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
            }
            // pemasukan dari shopee per periode
            $data['shopee'] = $this->Main_model->get_all("pemasukan", ["MONTH(tgl_pemasukan)" => $bulan, "YEAR(tgl_pemasukan)" => $tahun, "keterangan" => "Shopee"]);
            // pemasukan dari agen per periode
            $data['agen'] = $this->Main_model->get_all("pemasukan", ["MONTH(tgl_pemasukan)" => $bulan, "YEAR(tgl_pemasukan)" => $tahun, "keterangan" => "Agen"]);

            $this->load->view("laporan/export-penjualan", $data);
        } else if($laporan == "Laporan Penjualan Sales"){
            $data['agen_sales'] = "Sales";
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $data['title'] = "Laporan Penjualan Sales " . $month[$bulan] . " " . $tahun;
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
            $data['agen_sales'] = "Agen";
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $filename = "Penjualan_Agen_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');
            $data['title'] = "Laporan Penjualan Agen " . $month[$bulan] . " " . $tahun;
            
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

            $data['title'] = "Laporan Pembelian " . $month[$bulan] ." " . $tahun;
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
            $this->load->view("laporan/export-pembelian", $data);
        } else if($laporan == "Laporan Pembelian Barang Transfer"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            
            $filename = "Pembelian_Transfer_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $data['title'] = "Laporan Pembelian " . $month[$bulan] ." " . $tahun;

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
            }
            $this->load->view("laporan/export-pembelian-transfer", $data);
        } else if($laporan == "Laporan Penjualan Barang"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            
            $data['title'] = "Laporan Penjualan Barang " .$month[$bulan] ." " . $tahun;

            $filename = "Penjualan_Barang_" . $bulan . "_" . $tahun;
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $penjualan = $this->Parfum_model->get_penjualan_barang_by_periode($bulan, $tahun);
            $data['barang'] = [];
            foreach ($penjualan as $i => $penjualan) {
                $data['barang'][$i] = $this->Main_model->get_one("barang", ["id_barang" => $penjualan['id_barang']]);
                $data['barang'][$i]['total'] = $penjualan['total'];
            }
            
            $penjualan = $this->Parfum_model->get_penjualan_parfum_by_periode($bulan, $tahun);
            $data['parfum'] = [];
            foreach ($penjualan as $i => $penjualan) {
                $data['parfum'][$i] = $this->Main_model->get_one("parfum", ["id_parfum" => $penjualan['id_parfum']]);
                $data['parfum'][$i]['total'] = $penjualan['total'];
            }
            
            $penjualan = $this->Parfum_model->get_penjualan_tambahan_by_periode($bulan, $tahun);
            $data['tambahan'] = [];
            foreach ($penjualan as $i => $penjualan) {
                $data['tambahan'][$i] = $this->Main_model->get_one("bahan", ["id_bahan" => $penjualan['id_bahan']]);
                $data['tambahan'][$i]['total'] = $penjualan['total'];
            }

            $this->load->view("laporan/export-penjualan-barang", $data);
        } else if($laporan == "Laporan HPP"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $filename = "Laporan_HPP_" . $bulan . "_" . $tahun;
            
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $data['title'] = "Laporan HPP " . $month[$bulan] ." " . $tahun;

            $data['bahan_baku_awal'] = $this->Parfum_model->get_persediaan_bahan_baku_awal($bulan, $tahun);
            $data['bahan_pembantu_awal'] = $this->Parfum_model->get_persediaan_bahan_pembantu_awal($bulan, $tahun);

            $data['pembelian_bahan_baku'] = $this->Parfum_model->get_pembelian_bahan_by_jenis_by_periode("Baku", $bulan, $tahun);

            $data['pembelian_bahan_pembantu'] = $this->Parfum_model->get_pembelian_bahan_by_jenis_by_periode("Pembantu", $bulan, $tahun);

            $data['bahan_baku_akhir'] = $this->Parfum_model->get_persediaan_bahan_baku_akhir($bulan, $tahun);
            $data['bahan_pembantu_akhir'] = $this->Parfum_model->get_persediaan_bahan_pembantu_akhir($bulan, $tahun);

            // biaya overhead gaji per periode
            $data['biaya_kerja'] = $this->Main_model->get_all("biaya_overhead", ["MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun, "jenis" => "Gaji"]);
            // biaya overhead selain gaji per periode
            $data['biaya_overhead'] = $this->Main_model->get_all("biaya_overhead", ["MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun, "jenis != " => "Gaji"]);

            $this->load->view("laporan/export-hpp", $data);
        } else if($laporan == "Laporan Pengeluaran"){
            
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $filename = "Laporan_Pengeluaran_" . $bulan . "_" . $tahun;
            
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $data['title'] = "Laporan Pengeluaran Lain-Lain " . $month[$bulan] ." " . $tahun;

            $data['pengeluaran'] = $this->Main_model->get_all("pengeluaran", ["MONTH(tgl_pengeluaran)" => $bulan, "YEAR(tgl_pengeluaran)" => $tahun]);

            $this->load->view("laporan/export-pengeluaran", $data);
        } else if($laporan == "Laporan Laba Rugi"){
            $bulan = $this->input->post("bulan", TRUE);
            $tahun = $this->input->post("tahun", TRUE);
            $filename = "Laporan_Pengeluaran_" . $bulan . "_" . $tahun;
            
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename='.$filename.'xls');

            $data['title'] = "Laporan Laba Rugi " . $month[$bulan] ." " . $tahun;

            // penjualan diskon dan penjualan
                $data['penjualan'] = 0;
                $data['diskon'] = 0;
                $penjualan = $this->Main_model->get_all("penjualan", ["MONTH(tgl_penjualan)" => $bulan, "YEAR(tgl_penjualan)" => $tahun]);
                foreach ($penjualan as $i => $penjualan) {
                    $data['diskon'] += $penjualan['diskon'];
                    
                    $parfum = $this->Parfum_model->get_detail_penjualan_by_id_penjualan($penjualan['id_penjualan']);
                    $data['data'][$i]['detail']['parfum'] = [];
                    foreach ($parfum as $j => $parfum) {
                        $data['penjualan'] += $parfum['harga'] * $parfum['qty'];
                    }
                    
                    $barang = $this->Parfum_model->get_detail_penjualan_barang_by_id_penjualan($penjualan['id_penjualan']);
                    $data['data'][$i]['detail']['barang'] = [];
                    foreach ($barang as $j => $barang) {
                        $data['penjualan'] += $barang['harga'] * $barang['qty'];
                    }
                    
                    $tambahan = $this->Parfum_model->get_detail_tambahan_by_id_penjualan($penjualan['id_penjualan']);
                    $data['data'][$i]['detail']['tambahan'] = [];
                    foreach ($tambahan as $j => $tambahan) {
                        $data['penjualan'] += $tambahan['harga'] * $tambahan['qty'];
                    }
                }
            // penjualan
            
            // hpp
                $bahan_baku_awal = 0;
                $bahan_baku_awal = $this->Parfum_model->get_persediaan_bahan_baku_awal($bulan, $tahun);

                $bahan_pembantu_awal = 0;
                $bahan_pembantu_awal = $this->Parfum_model->get_persediaan_bahan_pembantu_awal($bulan, $tahun);

                $total_pembelian = 0;
                $pembelian_bahan_baku = $this->Parfum_model->get_pembelian_bahan_by_jenis_by_periode("Baku", $bulan, $tahun);
                foreach ($pembelian_bahan_baku as $i => $cek) {
                    $total_pembelian += $cek['total'];
                }

                $total_pembelian_pembantu = 0;
                $pembelian_bahan_pembantu = $this->Parfum_model->get_pembelian_bahan_by_jenis_by_periode("Pembantu", $bulan, $tahun);
                foreach ($pembelian_bahan_pembantu as $i => $cek) {
                    $total_pembelian_pembantu += $cek['total'];
                }

                $bahan_baku_akhir = 0;
                $bahan_baku_akhir = $this->Parfum_model->get_persediaan_bahan_baku_akhir($bulan, $tahun);
                $bahan_pembantu_akhir = 0;
                $bahan_pembantu_akhir = $this->Parfum_model->get_persediaan_bahan_pembantu_akhir($bulan, $tahun);

                $total_kerja = 0;
                $biaya_kerja = $this->Main_model->get_all("biaya_overhead", ["MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun, "jenis" => "Gaji"]);
                foreach ($biaya_kerja as $kerja) {
                    $total_kerja += $kerja['nominal'];
                }
                
                $total_overhead = 0;
                $biaya_overhead = $this->Main_model->get_all("biaya_overhead", ["MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun, "jenis !=" => "Gaji"]);
                foreach ($biaya_overhead as $overhead) {
                    $total_overhead += $overhead['nominal'];
                }

                $data['hpp'] = 0;
                $data['hpp'] = $total_pembelian + $bahan_baku_awal - $bahan_baku_akhir + $total_pembelian_pembantu + $bahan_pembantu_awal - $bahan_pembantu_akhir + $total_kerja + $total_overhead;
            // hpp

            // beban
                $data['beban'] = $this->Main_model->get_all("pengeluaran", ["MONTH(tgl_pengeluaran)" => $bulan, "YEAR(tgl_pengeluaran)" => $tahun]);
            // beban

            $this->load->view("laporan/export-laba-rugi", $data);
        }
    }
}