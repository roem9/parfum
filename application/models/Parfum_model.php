<?php
class Parfum_model extends CI_MODEL{
    // add
        public function add_bahan(){
            $data = [
                "nama_bahan" => $this->input->post("nama_bahan", TRUE),
                "satuan" => $this->input->post("satuan", TRUE),
                "harga_satuan" => $this->nominal($this->input->post("harga_satuan", TRUE)),
                "jenis" => $this->input->post("jenis", TRUE)
            ];

            $this->db->insert("bahan", $data);
        }

        public function add_parfum($id){
            $data = [
                "id_parfum" => $id,
                "nama_parfum" => $this->input->post("nama_parfum"),
                "harga" => $this->nominal($this->input->post("harga")),
                "status" => "aktif",
                "min_stok" => $this->input->post("min_stok", TRUE)
            ];

            $this->db->insert("parfum", $data);
        }

        public function add_bahan_parfum_by_id($id){
            $bahan = $this->input->post("id_bahan");
            $qty = $this->input->post("qty");

            foreach ($bahan as $i => $bahan) {
                $data = [
                    "id_bahan" => $bahan,
                    "qty" => $qty[$i],
                    "id_parfum" => $id
                ];

                $this->db->insert("bahan_parfum", $data);
            }
        }
        
        public function add_penjualan($data){
            $this->db->insert("penjualan", $data);
        }
        
        public function add_detail_penjualan_by_id($id){
            $parfum = $this->input->post("id_parfum");
            $qty = $this->input->post("qty");
            
            foreach ($parfum as $i => $parfum) {
                $detail = $this->get_parfum_by_id($parfum);
                if($detail){
                    $data = [
                        "id_parfum" => $parfum,
                        "qty" => $qty[$i],
                        "id_penjualan" => $id,
                        "harga" => $detail['harga']
                    ];
    
                    $this->db->insert("detail_penjualan", $data);
                }
            }
        }
        
        public function add_detail_penjualan_barang_by_id($id){
            $barang = $this->input->post("id_barang");
            $qty = $this->input->post("qty_barang");
            
            foreach ($barang as $i => $barang) {
                $detail = $this->get_barang_by_id($barang);
                if($detail){
                    $data = [
                        "id_barang" => $barang,
                        "qty" => $qty[$i],
                        "id_penjualan" => $id,
                        "harga" => $detail['harga']
                    ];
    
                    $this->db->insert("detail_penjualan_barang", $data);
                }
            }
        }

        public function add_pembelian($id){
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

            $this->db->insert("pembelian", $data);
        }
        
        public function add_detail_pembelian_by_id($id){
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
    
                    $this->db->insert("detail_pembelian", $data);
                }
            }
        }
        
        public function add_bahan_tambahan_by_id($id){
            $bahan = $this->input->post("id_bahan");
            $qty = $this->input->post("qty_tambahan");

            foreach ($bahan as $i => $bahan) {
                $bhn = $this->get_bahan_by_id($bahan);
                if($bhn){
                    $data = [
                        "id_bahan" => $bahan,
                        "harga" => $bhn['harga_satuan'],
                        "qty" => $qty[$i],
                        "id_penjualan" => $id
                    ];
    
                    $this->db->insert("penggunaan_bahan_tambahan", $data);
                }
            }
        }

        public function add_barang(){
            $data = [
                "nama_barang" => $this->input->post("nama_barang", TRUE),
                "harga" => $this->nominal($this->input->post("harga", TRUE)),
                "status" => "aktif"
            ];

            $this->db->insert("barang", $data);
        }
        
        public function add_penyetokan($id){
            $data = [
                "id_penyetokan" => $id,
                "tgl_penyetokan" => $this->input->post("tgl_penyetokan", TRUE)
            ];

            $this->db->insert("penyetokan", $data);
        }
        
        public function add_detail_penyetokan_by_id($id){
            $parfum = $this->input->post("id_parfum");
            $qty = $this->input->post("qty");
            
            $id_detail = $this->get_last_id_detail_penyetokan();
            
            foreach ($parfum as $i => $parfum) {
                $detail = $this->get_parfum_by_id($parfum);

                $data = [
                    "id_detail" => $id_detail,
                    "id_parfum" => $parfum,
                    "qty" => $qty[$i],
                    "id_penyetokan" => $id
                ];

                $this->db->insert("detail_penyetokan", $data);

                $bahan = $this->get_bahan_parfum_by_id_parfum($detail['id_parfum']);

                foreach ($bahan as $bahan) {
                    $data = [
                        "id_detail" => $id_detail,
                        "id_bahan" => $bahan['id_bahan'],
                        "qty" => $bahan['qty'],
                        "harga_satuan" => $bahan['harga_satuan']
                    ];
                    
                    $this->db->insert("penggunaan_bahan", $data);
                }

                $id_detail++;
            }
        }
        
        public function add_detail_pembelian_barang_by_id($id){
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
    
                    $this->db->insert("detail_pembelian_barang", $data);
                }
            }
        }

        public function add_overhead(){
            $data = [
                "tgl" => $this->input->post("tgl", TRUE),
                "jenis" => $this->input->post("jenis", TRUE),
                "nominal" => $this->nominal($this->input->post("nominal", TRUE))
            ];

            $this->db->insert("biaya_overhead", $data);
        }

        public function add_agen($data){
            $this->db->insert("agen", $data);
            return $this->db->insert_id();
        }
        
        public function add_sales($data){
            $this->db->insert("sales", $data);
            return $this->db->insert_id();
        }

        public function add_penjualan_agen($data){
            $this->db->insert("penjualan_agen", $data);
        }
        
        public function add_penjualan_sales($data){
            $this->db->insert("penjualan_sales", $data);
        }

        public function add_pengeluaran($data){
            $this->db->insert("pengeluaran", $data);
            return $this->db->insert_id();
        }
        
        public function add_pemasukan($data){
            $this->db->insert("pemasukan", $data);
            return $this->db->insert_id();
        }
    // add

    // get last id
        public function get_last_id_parfum(){
            $this->db->from("parfum");
            $this->db->order_by("id_parfum", "DESC");
            $data = $this->db->get()->row_array();
            $id = $data['id_parfum'] + 1;
            return $id;
        }
        
        public function get_last_id_penjualan(){
            $this->db->from("penjualan");
            $this->db->order_by("id_penjualan", "DESC");
            $data = $this->db->get()->row_array();
            $id = $data['id_penjualan'] + 1;
            return $id;
        }
        
        public function get_last_id_pembelian(){
            $this->db->from("pembelian");
            $this->db->order_by("id_pembelian", "DESC");
            $data = $this->db->get()->row_array();
            $id = $data['id_pembelian'] + 1;
            return $id;
        }
        
        public function get_last_id_detail_penjualan(){
            $this->db->from("detail_penjualan");
            $this->db->order_by("id_detail", "DESC");
            $data = $this->db->get()->row_array();
            $id = $data['id_detail'] + 1;
            return $id;
        }
        
        public function get_last_id_penyetokan(){
            $this->db->from("penyetokan");
            $this->db->order_by("id_penyetokan", "DESC");
            $data = $this->db->get()->row_array();
            $id = $data['id_penyetokan'] + 1;
            return $id;
        }

        public function get_last_id_detail_penyetokan(){
            $this->db->from("detail_penyetokan");
            $this->db->order_by("id_detail", "DESC");
            $data = $this->db->get()->row_array();
            $id = $data['id_detail'] + 1;
            return $id;
        }
    // get last id

    // get by id
        public function get_bahan_by_id($id){
            $this->db->from("bahan");
            $this->db->where("id_bahan", $id);
            return $this->db->get()->row_array();
        }

        public function get_ketersediaan_bahan_by_id($id){
            $this->db->select("sum(qty) as pembelian");
            $this->db->from("detail_pembelian");
            $this->db->where("id_bahan", $id);
            $this->db->group_by("id_bahan");
            $data = $this->db->get()->row_array();
            $sedia = $data['pembelian'];

            $this->db->select("(a.qty * sum(b.qty)) as total");
            $this->db->from("penggunaan_bahan as a");
            $this->db->join("detail_penjualan as b", "a.id_detail = b.id_detail");
            $this->db->where("id_bahan", $id);
            $this->db->group_by("id_bahan");
            $data = $this->db->get()->row_array();
            $terjual = $data['total'];
            
            $this->db->select("sum(qty) as total");
            $this->db->from("penggunaan_bahan_tambahan");
            $this->db->where("id_bahan", $id);
            $this->db->group_by("id_bahan");
            $data = $this->db->get()->row_array();
            $tambahan = $data['total'];
            
            return $sedia - $terjual - $tambahan;
        }
        
        public function get_parfum_by_id($id){
            $this->db->from("parfum");
            $this->db->where("id_parfum", $id);
            return $this->db->get()->row_array();
        }
        
        public function get_bahan_parfum_by_id_parfum($id){
            $this->db->from("bahan_parfum as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("id_parfum", $id);
            return $this->db->get()->result_array();
        }
        
        public function get_penjualan_by_id($id){
            $this->db->from("penjualan");
            $this->db->where("id_penjualan", $id);
            return $this->db->get()->row_array();
        }
        
        public function get_detail_penjualan_by_id_penjualan($id){
            $this->db->select("*, a.id_parfum, a.harga");
            $this->db->from("detail_penjualan as a");
            $this->db->join("parfum as b", "a.id_parfum = b.id_parfum");
            $this->db->where("id_penjualan", $id);
            return $this->db->get()->result_array();
        }
        
        public function get_pembelian_by_id($id){
            $this->db->from("pembelian");
            $this->db->where("id_pembelian", $id);
            return $this->db->get()->row_array();
        }
        
        public function get_detail_pembelian_by_id_pembelian($id){
            $this->db->select("*, a.id_bahan");
            $this->db->from("detail_pembelian as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("id_pembelian", $id);
            return $this->db->get()->result_array();
        }

        public function get_biaya_bahan_by_id($id){
            $this->db->select("(qty*harga_satuan) as perbahan");
            $this->db->from("bahan_parfum as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("id_parfum", $id);
            $data = $this->db->get()->result_array();
            
            $total = 0;
            
            foreach ($data as $data) {
                $total += $data['perbahan'];
            }

            return $total;
        }

        // hapus?
        // public function get_pembelian_by_periode($periode){
        //     // var_dump($periode);
        //     $data = explode("%20", $periode);

        //     $bulan = $data[0];
        //     $tahun = $data[1];

        //     $this->db->select("*, SUM(harga) as total");
        //     $this->db->from("pembelian as a");
        //     $this->db->join("detail_pembelian as b", "a.id_pembelian = b.id_pembelian");
        //     $this->db->where("MONTH(tgl_pembelian)", $bulan);
        //     $this->db->where("YEAR(tgl_pembelian)", $tahun);
        //     $this->db->group_by("a.id_pembelian");
        //     return $this->db->get()->result_array();
        // }

        public function get_pembelian_bahan_by_jenis_by_periode($jenis, $bulan, $tahun){
            // $data = explode("%20", $periode);
            // $bulan = $data[0];
            // $tahun = $data[1];

            $this->db->select("SUM(harga) as total");
            $this->db->from("pembelian_bahan");
            $this->db->where("MONTH(tgl_pembelian)", $bulan);
            $this->db->where("YEAR(tgl_pembelian)", $tahun);
            $this->db->where("jenis", $jenis);
            $this->db->group_by("id_pembelian");
            return $this->db->get()->result_array();
        }

        public function get_persediaan_bahan_baku_awal($bulan, $tahun){
            // var_dump($periode);
            // $data = explode("%20", $periode);

            // $bulan = $data[0];
            // $tahun = $data[1];
            $tgl = "{$tahun}-{$bulan}-01";

            $total_beli = 0;
            $total_penyetokan = 0;

            $this->db->select("sum(harga) as pembelian, id_pembelian");
            $this->db->from("detail_pembelian as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("jenis", "Baku");
            $this->db->group_by("a.id_pembelian");
            $pembelian = $this->db->get()->result_array();
            foreach ($pembelian as $pembelian) {
                $date = $this->get_pembelian_by_id($pembelian['id_pembelian']);
                if(strtotime($date['tgl_pembelian']) < strtotime($tgl)){
                    $total_beli += $pembelian['pembelian'];
                }
            }
            
            $this->db->select("(b.qty * (a.qty * a.harga_satuan)) as penyetokan");
            $this->db->from("penggunaan_bahan as a");
            $this->db->join("detail_penyetokan as b", "a.id_detail = b.id_detail");
            $this->db->join("penyetokan as c", "c.id_penyetokan = b.id_penyetokan");
            $this->db->where("tgl_penyetokan < ", $tgl);
            $this->db->group_by("c.id_penyetokan");
            $penyetokan = $this->db->get()->result_array();
            foreach ($penyetokan as $penyetokan) {
                $total_penyetokan += $penyetokan['penyetokan'];
            }
            
            return $total_beli - $total_penyetokan;
        }
        
        public function get_persediaan_bahan_pembantu_awal($bulan, $tahun){
            // var_dump($periode);
            // $data = explode("%20", $periode);

            // $bulan = $data[0];
            // $tahun = $data[1];
            $tgl = "{$tahun}-{$bulan}-01";

            $total_beli = 0;
            $total_jual = 0;

            $this->db->select("sum(harga) as pembelian, id_pembelian");
            $this->db->from("detail_pembelian as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("jenis", "Pembantu");
            $this->db->group_by("a.id_pembelian");
            $pembelian = $this->db->get()->result_array();
            foreach ($pembelian as $pembelian) {
                $date = $this->get_pembelian_by_id($pembelian['id_pembelian']);
                if(strtotime($date['tgl_pembelian']) < strtotime($tgl)){
                    $total_beli += $pembelian['pembelian'];
                }
            }
            
            $this->db->select("(a.qty * a.harga) as penjualan");
            $this->db->from("penggunaan_bahan_tambahan as a");
            $this->db->join("penjualan as b", "a.id_penjualan = b.id_penjualan");
            $this->db->where("tgl_penjualan < ", $tgl);
            $this->db->group_by("b.id_penjualan");
            $penjualan = $this->db->get()->result_array();
            foreach ($penjualan as $penjualan) {
                $total_jual += $penjualan['penjualan'];
            }
            
            // $data['pembelian'] = $total_beli;
            // $data['penjualan'] = $total_jual;
            return $total_beli - $total_jual;
        }
        
        public function get_persediaan_bahan_baku_akhir($bulan, $tahun){
            // var_dump($periode);
            // $data = explode("%20", $periode);

            // $bulan = $data[0];
            // $tahun = $data[1];
            if($bulan == 12){
                $bulan = 1;
                $tahun = $tahun - 1;
            } else {
                $bulan = $bulan + 1;
                $tahun = $tahun;
            }

            $tgl = "{$tahun}-{$bulan}-01";

            $total_beli = 0;
            $total_penyetokan = 0;

            $this->db->select("sum(harga) as pembelian, id_pembelian");
            $this->db->from("detail_pembelian as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("jenis", "Baku");
            $this->db->group_by("a.id_pembelian");
            $pembelian = $this->db->get()->result_array();
            foreach ($pembelian as $pembelian) {
                $date = $this->get_pembelian_by_id($pembelian['id_pembelian']);
                if(strtotime($date['tgl_pembelian']) < strtotime($tgl)){
                    $total_beli += $pembelian['pembelian'];
                }
            }
            
            $this->db->select("(b.qty * (a.qty * a.harga_satuan)) as penyetokan");
            $this->db->from("penggunaan_bahan as a");
            $this->db->join("detail_penyetokan as b", "a.id_detail = b.id_detail");
            $this->db->join("penyetokan as c", "c.id_penyetokan = b.id_penyetokan");
            $this->db->where("tgl_penyetokan < ", $tgl);
            $this->db->group_by("c.id_penyetokan");
            $penyetokan = $this->db->get()->result_array();
            foreach ($penyetokan as $penyetokan) {
                $total_penyetokan += $penyetokan['penyetokan'];
            }
            
            return $total_beli - $total_penyetokan;
        }
        
        public function get_persediaan_bahan_pembantu_akhir($bulan, $tahun){
            // var_dump($periode);
            // $data = explode("%20", $periode);

            // $bulan = $data[0];
            // $tahun = $data[1];
            
            if($bulan == 12){
                $bulan = 1;
                $tahun = $tahun - 1;
            } else {
                $bulan = $bulan + 1;
                $tahun = $tahun;
            }

            $tgl = "{$tahun}-{$bulan}-01";

            $total_beli = 0;
            $total_jual = 0;

            $this->db->select("sum(harga) as pembelian, id_pembelian");
            $this->db->from("detail_pembelian as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("jenis", "Pembantu");
            $this->db->group_by("a.id_pembelian");
            $pembelian = $this->db->get()->result_array();
            foreach ($pembelian as $pembelian) {
                $date = $this->get_pembelian_by_id($pembelian['id_pembelian']);
                if(strtotime($date['tgl_pembelian']) < strtotime($tgl)){
                    $total_beli += $pembelian['pembelian'];
                }
            }
            
            $this->db->select("(a.qty * a.harga) as penjualan");
            $this->db->from("penggunaan_bahan_tambahan as a");
            $this->db->join("penjualan as b", "a.id_penjualan = b.id_penjualan");
            $this->db->where("tgl_penjualan < ", $tgl);
            $this->db->group_by("b.id_penjualan");
            $penjualan = $this->db->get()->result_array();
            foreach ($penjualan as $penjualan) {
                $total_jual += $penjualan['penjualan'];
            }
            
            // $data['pembelian'] = $total_beli;
            // $data['penjualan'] = $total_jual;
            return $total_beli - $total_jual;
        }

        public function get_biaya_kerja_by_periode($bulan, $tahun){
            // var_dump($periode);
            // $data = explode("%20", $periode);

            // $bulan = $data[0];
            // $tahun = $data[1];

            $this->db->from("biaya_overhead");
            $this->db->where("MONTH(tgl)", $bulan);
            $this->db->where("YEAR(tgl)", $tahun);
            $this->db->where("jenis", "Gaji");
            return $this->db->get()->result_array();
        }
        
        public function get_biaya_overhead_by_periode($bulan, $tahun){
            // var_dump($periode);
            // $data = explode("%20", $periode);

            // $bulan = $data[0];
            // $tahun = $data[1];

            $this->db->from("biaya_overhead");
            $this->db->where("MONTH(tgl)", $bulan);
            $this->db->where("YEAR(tgl)", $tahun);
            $this->db->where("jenis !=", "Gaji");
            return $this->db->get()->result_array();
        }
        
        // get harga total barang tambahan pada tabel penggunaan bahan tambahan
        public function get_total_tambahan_by_id_penjualan($id){
            $this->db->select("SUM(harga*qty) as total");
            $this->db->from("penggunaan_bahan_tambahan");
            $this->db->where("id_penjualan", $id);
            return $this->db->get()->row_array();
        }

        public function get_detail_tambahan_by_id_penjualan($id){
            $this->db->from("penggunaan_bahan_tambahan as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("id_penjualan", $id);
            return $this->db->get()->result_array();
        }

        public function get_total_barang_by_id_penjualan($id){
            $this->db->select("SUM(harga*qty) as total");
            $this->db->from("detail_penjualan_barang");
            $this->db->where("id_penjualan", $id);
            return $this->db->get()->row_array();
        }
        
        public function get_tambahan_by_id_penjualan($id){
            $this->db->from("penggunaan_bahan_tambahan as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("id_penjualan", $id);
            return $this->db->get()->result_array();
        }

        public function get_history_bahan_by_id($id){
            $this->db->select("*, b.harga_satuan, a.harga_satuan as harga");
            $this->db->from("bahan as a");
            $this->db->join("history_bahan as b", "a.id_bahan = b.id_bahan", "left");
            $this->db->where("a.id_bahan", $id);
            $this->db->order_by("id", "DESC");
            return $this->db->get()->result_array();
        }
        
        public function get_history_parfum_by_id($id){
            $this->db->select("*, b.harga as harga, a.harga as n_harga, a.min_stok as n_min_stok");
            $this->db->from("parfum as a");
            $this->db->join("history_parfum as b", "a.id_parfum = b.id_parfum", "left");
            $this->db->where("a.id_parfum", $id);
            $this->db->order_by("id", "DESC");
            return $this->db->get()->result_array();
        }

        public function get_barang_by_id($id){
            $this->db->from("barang");
            $this->db->where("id_barang", $id);
            return $this->db->get()->row_array();
        }
        
        public function get_history_barang_by_id($id){
            $this->db->select("*, b.harga as harga, a.harga as n_harga");
            $this->db->from("barang as a");
            $this->db->join("history_barang as b", "a.id_barang = b.id_barang", "left");
            $this->db->where("a.id_barang", $id);
            $this->db->order_by("id", "DESC");
            return $this->db->get()->result_array();
        }

        public function get_penyetokan_by_id($id){
            $this->db->from("penyetokan");
            $this->db->where("id_penyetokan", $id);
            return $this->db->get()->row_array();
        }

        public function get_detail_penyetokan_by_id_penyetokan($id){
            $this->db->select("*, a.id_parfum");
            $this->db->from("detail_penyetokan as a");
            $this->db->join("parfum as b", "a.id_parfum = b.id_parfum");
            $this->db->where("id_penyetokan", $id);
            return $this->db->get()->result_array();
        }

        public function get_stok_penyetokan_by_id_penyetokan($id){
            $this->db->select("SUM(qty) as stok");
            $this->db->from("detail_penyetokan");
            $this->db->where("id_penyetokan", $id);
            $this->db->group_by("id_penyetokan");
            return $this->db->get()->row_array();
        }

        public function get_total_bahan_by_id_pembelian($id){
            $this->db->select("sum(harga) as total");
            $this->db->from("detail_pembelian");
            $this->db->where("id_pembelian", $id);
            $this->db->group_by("id_pembelian");
            return $this->db->get()->row_array();
        }
        
        public function get_total_barang_by_id_pembelian($id){
            $this->db->select("sum(harga) as total");
            $this->db->from("detail_pembelian_barang");
            $this->db->where("id_pembelian", $id);
            $this->db->group_by("id_pembelian");
            return $this->db->get()->row_array();
        }
        
        public function get_detail_pembelian_barang_by_id_pembelian($id){
            $this->db->select("*, a.id_barang, a.harga");
            $this->db->from("detail_pembelian_barang as a");
            $this->db->join("barang as b", "a.id_barang = b.id_barang");
            $this->db->where("id_pembelian", $id);
            return $this->db->get()->result_array();
        }
        
        public function get_detail_penjualan_barang_by_id_penjualan($id){
            $this->db->select("*, a.id_barang, a.harga");
            $this->db->from("detail_penjualan_barang as a");
            $this->db->join("barang as b", "a.id_barang = b.id_barang");
            $this->db->where("id_penjualan", $id);
            return $this->db->get()->result_array();
        }

        public function get_stok_parfum_by_id($id){
            $this->db->select("sum(qty) as total");
            $this->db->from("detail_penyetokan");
            $this->db->where("id_parfum", $id);
            $this->db->group_by("id_parfum");
            $stok = $this->db->get()->row_array();

            $this->db->select("sum(qty) as total");
            $this->db->from("detail_penjualan");
            $this->db->where("id_parfum", $id);
            $this->db->group_by("id_parfum");
            $jual = $this->db->get()->row_array();

            return $stok['total'] - $jual['total'];
        }

        public function get_stok_barang_by_id($id){
            $this->db->select("sum(qty) as total");
            $this->db->from("detail_pembelian_barang");
            $this->db->where("id_barang", $id);
            $this->db->group_by("id_barang");
            $stok = $this->db->get()->row_array();

            $this->db->select("sum(qty) as total");
            $this->db->from("detail_penjualan_barang");
            $this->db->where("id_barang", $id);
            $this->db->group_by("id_barang");
            $jual = $this->db->get()->row_array();

            return $stok['total'] - $jual['total'];
        }
        
        public function get_overhead_by_id($id){
            $this->db->from("biaya_overhead");
            $this->db->where("id", $id);
            return $this->db->get()->row_array();
        }

        public function get_agen_by_id($id){
            $this->db->where("id_agen", $id);
            $this->db->from("agen");
            return $this->db->get()->row_array();
        }
        
        public function get_sales_by_id($id){
            $this->db->where("id_sales", $id);
            $this->db->from("sales");
            return $this->db->get()->row_array();
        }

        public function get_all_penjualan_by_tipe($tipe){
            if($tipe == "Agen")
                $this->db->select("a.id_penjualan, tgl_penjualan, nama, no_hp, alamat, metode, SUM(harga*qty) as total, nama_agen, diskon");
            else
                $this->db->select("a.id_penjualan, tgl_penjualan, nama, no_hp, alamat, metode, SUM(harga*qty) as total, nama_sales, diskon");

            $this->db->from("penjualan as a");
            $this->db->join("detail_penjualan as b", "a.id_penjualan = b.id_penjualan", "left");
            if($tipe == "Agen"){
                $this->db->join("penjualan_agen as c", "a.id_penjualan = c.id_penjualan");
                $this->db->join("agen as d", "d.id_agen = c.id_agen");
            } else {
                $this->db->join("penjualan_sales as c", "a.id_penjualan = c.id_penjualan");
                $this->db->join("sales as d", "d.id_sales = c.id_sales");
            }
            $this->db->group_by("b.id_penjualan");
            $this->db->order_by("tgl_penjualan", "DESC");
            return $this->db->get()->result_array();
        }

        public function get_id_agen_by_id_penjualan($id){
            $this->db->from("penjualan as a");
            $this->db->join("penjualan_agen as b", "a.id_penjualan = b.id_penjualan");
            $this->db->where("a.id_penjualan", $id);
            return $this->db->get()->row_array();
        }
        
        public function get_id_sales_by_id_penjualan($id){
            $this->db->from("penjualan as a");
            $this->db->join("penjualan_sales as b", "a.id_penjualan = b.id_penjualan");
            $this->db->where("a.id_penjualan", $id);
            return $this->db->get()->row_array();
        }

        public function get_penjualan_by_periode($bulan, $tahun){
            $this->db->from("penjualan as a");
            $this->db->where("MONTH(tgl_penjualan)", $bulan);
            $this->db->where("YEAR(tgl_penjualan)", $tahun);
            return $this->db->get()->result_array();
        }
        
        public function get_penjualan_transfer_by_periode($bulan, $tahun, $rek){
            $this->db->from("penjualan as a");
            $this->db->where("MONTH(tgl_penjualan)", $bulan);
            $this->db->where("YEAR(tgl_penjualan)", $tahun);
            $this->db->where("metode", "transfer");
            $this->db->where("rekening", $rek);
            return $this->db->get()->result_array();
        }

        public function get_sales_by_periode($bulan, $tahun){
            $this->db->from("penjualan as a");
            $this->db->join("penjualan_sales as b", "a.id_penjualan = b.id_penjualan");
            $this->db->join("sales as c", "b.id_sales = c.id_sales");
            $this->db->where("MONTH(tgl_penjualan)", $bulan);
            $this->db->where("YEAR(tgl_penjualan)", $tahun);
            $this->db->group_by("b.id_sales");
            return $this->db->get()->result_array();
        }

        public function get_penjualan_sales_by_periode($bulan, $tahun, $id_sales){
            $this->db->from("penjualan as a");
            $this->db->join("penjualan_sales as b", "a.id_penjualan = b.id_penjualan");
            $this->db->join("sales as c", "b.id_sales = c.id_sales");
            $this->db->where("MONTH(tgl_penjualan)", $bulan);
            $this->db->where("YEAR(tgl_penjualan)", $tahun);
            $this->db->where("b.id_sales", $id_sales);
            return $this->db->get()->result_array();
        }
        
        public function get_agen_by_periode($bulan, $tahun){
            $this->db->from("penjualan as a");
            $this->db->join("penjualan_agen as b", "a.id_penjualan = b.id_penjualan");
            $this->db->join("agen as c", "b.id_agen = c.id_agen");
            $this->db->where("MONTH(tgl_penjualan)", $bulan);
            $this->db->where("YEAR(tgl_penjualan)", $tahun);
            $this->db->group_by("b.id_agen");
            return $this->db->get()->result_array();
        }

        public function get_penjualan_agen_by_periode($bulan, $tahun, $id_agen){
            $this->db->from("penjualan as a");
            $this->db->join("penjualan_agen as b", "a.id_penjualan = b.id_penjualan");
            $this->db->join("agen as c", "b.id_agen = c.id_agen");
            $this->db->where("MONTH(tgl_penjualan)", $bulan);
            $this->db->where("YEAR(tgl_penjualan)", $tahun);
            $this->db->where("b.id_agen", $id_agen);
            return $this->db->get()->result_array();
        }
        
        public function get_pembelian_by_periode($bulan, $tahun){
            $this->db->from("pembelian as a");
            $this->db->where("MONTH(tgl_pembelian)", $bulan);
            $this->db->where("YEAR(tgl_pembelian)", $tahun);
            return $this->db->get()->result_array();
        }
        
        public function get_pembelian_transfer_by_periode($bulan, $tahun, $rek){
            $this->db->from("pembelian as a");
            $this->db->where("MONTH(tgl_pembelian)", $bulan);
            $this->db->where("YEAR(tgl_pembelian)", $tahun);
            $this->db->where("metode", "transfer");
            $this->db->where("rekening", $rek);
            return $this->db->get()->result_array();
        }

        public function get_penjualan_barang_by_periode($bulan, $tahun){
            $this->db->select("id_barang, SUM(qty) as total");
            $this->db->from("penjualan as a");
            $this->db->join("detail_penjualan_barang as b", "a.id_penjualan = b.id_penjualan");
            $this->db->where("MONTH(tgl_penjualan)", $bulan);
            $this->db->where("YEAR(tgl_penjualan)", $tahun);
            $this->db->group_by("id_barang");
            return $this->db->get()->result_array();
        }
        
        public function get_penjualan_parfum_by_periode($bulan, $tahun){
            $this->db->select("id_parfum, SUM(qty) as total");
            $this->db->from("penjualan as a");
            $this->db->join("detail_penjualan as b", "a.id_penjualan = b.id_penjualan");
            $this->db->where("MONTH(tgl_penjualan)", $bulan);
            $this->db->where("YEAR(tgl_penjualan)", $tahun);
            $this->db->group_by("id_parfum");
            return $this->db->get()->result_array();
        }
        
        public function get_penjualan_tambahan_by_periode($bulan, $tahun){
            $this->db->select("id_bahan, SUM(qty) as total");
            $this->db->from("penjualan as a");
            $this->db->join("penggunaan_bahan_tambahan as b", "a.id_penjualan = b.id_penjualan");
            $this->db->where("MONTH(tgl_penjualan)", $bulan);
            $this->db->where("YEAR(tgl_penjualan)", $tahun);
            $this->db->group_by("id_bahan");
            return $this->db->get()->result_array();
        }

        public function get_pengeluaran_by_id($id){
            $this->db->where("id_pengeluaran", $id);
            $this->db->from("pengeluaran");
            return $this->db->get()->row_array();
        }
        
        public function get_pemasukan_by_id($id){
            $this->db->where("id_pemasukan", $id);
            $this->db->from("pemasukan");
            return $this->db->get()->row_array();
        }

        public function get_pemasukan_by_periode_by_keterangan($bulan, $tahun, $ket){
            $this->db->where("MONTH(tgl_pemasukan)", $bulan);
            $this->db->where("YEAR(tgl_pemasukan)", $tahun);
            $this->db->where("keterangan", $ket);
            $this->db->from("pemasukan");
            return $this->db->get()->result_array();
        }
        
        public function get_pengeluaran_by_periode($bulan, $tahun){
            $this->db->where("MONTH(tgl_pengeluaran)", $bulan);
            $this->db->where("YEAR(tgl_pengeluaran)", $tahun);
            $this->db->from("pengeluaran");
            return $this->db->get()->result_array();
        }


    // get get by id

    // get all
        public function get_all_bahan(){
            $this->db->from("bahan");
            $this->db->order_by("nama_bahan", "ASC");
            return $this->db->get()->result_array();
        }
        
        public function get_all_bahan_by_jenis($jenis){
            $this->db->from("bahan");
            $this->db->where("jenis", $jenis);
            $this->db->order_by("nama_bahan", "ASC");
            return $this->db->get()->result_array();
        }

        public function get_all_parfum(){
            $this->db->from("parfum");
            $this->db->order_by("nama_parfum", "ASC");
            return $this->db->get()->result_array();
        }
        
        public function get_all_penjualan(){
            $this->db->select("a.id_penjualan, tgl_penjualan, nama, no_hp, alamat, metode, SUM(harga*qty) as total");
            $this->db->from("penjualan as a");
            $this->db->join("detail_penjualan as b", "a.id_penjualan = b.id_penjualan", "left");
            $this->db->group_by("b.id_penjualan");
            $this->db->order_by("tgl_penjualan", "DESC");
            return $this->db->get()->result_array();
        }
        
        public function get_all_pembelian(){
            $this->db->from("pembelian");
            $this->db->order_by("tgl_pembelian", "DESC");
            return $this->db->get()->result_array();
        }

        public function get_periode(){
            $this->db->select("concat(MONTH(tgl_pembelian), ' ', YEAR(tgl_pembelian)) as periode");
            $this->db->from("pembelian");
            $this->db->group_by('periode');
            $this->db->order_by("tgl_pembelian", "desc");
            $pembelian = $this->db->get()->result_array();
            
            $this->db->select("concat(MONTH(tgl_penjualan), ' ', YEAR(tgl_penjualan)) as periode");
            $this->db->from("penjualan");
            $this->db->group_by('periode');
            $this->db->order_by("tgl_penjualan", "desc");
            $penjualan = $this->db->get()->result_array();
            
            $periode = array_unique(array_merge($penjualan,$pembelian), SORT_REGULAR);
            return $periode;
        }

        public function get_all_barang(){
            $this->db->from("barang");
            return $this->db->get()->result_array();
        }

        public function get_all_penyetokan(){
            $this->db->from("penyetokan");
            $this->db->order_by("tgl_penyetokan", "DESC");
            return $this->db->get()->result_array();
        }

        public function get_all_overhead(){
            $this->db->from("biaya_overhead");
            return $this->db->get()->result_array();
        }

        public function get_all_agen(){
            $this->db->from("agen");
            return $this->db->get()->result_array();
        }
        
        public function get_all_sales(){
            $this->db->from("sales");
            return $this->db->get()->result_array();
        }

        public function get_all_pengeluaran(){
            $this->db->from("pengeluaran");
            return $this->db->get()->result_array();
        }
        
        public function get_all_pemasukan(){
            $this->db->from("pemasukan");
            return $this->db->get()->result_array();
        }
    // get all

    // edit
        public function edit_bahan_by_id($id){
            $bahan = $this->get_bahan_by_id($id);

            if($bahan['harga_satuan'] != $this->nominal($this->input->post("harga_satuan", TRUE))){
                $data = [
                    "tgl" => date("Y-m-d"),
                    "id_bahan" => $bahan['id_bahan'],
                    "harga_satuan" => $bahan['harga_satuan']
                ];

                $this->db->insert("history_bahan", $data);
            }

            $this->db->where("id_bahan", $id);

            $data = [
                "nama_bahan" => $this->input->post("nama_bahan", TRUE),
                "satuan" => $this->input->post("satuan", TRUE),
                "harga_satuan" => $this->nominal($this->input->post("harga_satuan", TRUE)),
                "jenis" => $this->nominal($this->input->post("jenis", TRUE))
            ];

            $this->db->update("bahan", $data);
        }
        
        public function edit_parfum_by_id($id){
            $parfum = $this->get_parfum_by_id($id);

            if($parfum['harga'] != $this->nominal($this->input->post("harga", TRUE)) || $parfum['min_stok'] != $this->input->post("min_stok", TRUE)){
                $data = [
                    "tgl" => date("Y-m-d"),
                    "id_parfum" => $parfum['id_parfum'],
                    "harga" => $parfum['harga'],
                    "min_stok" => $parfum['min_stok']
                ];

                $this->db->insert("history_parfum", $data);
            }

            $this->db->where("id_parfum", $id);
            
            $data = [
                "nama_parfum" => $this->input->post("nama_parfum"),
                "harga" => $this->nominal($this->input->post("harga")),
                "status" => $this->input->post("status"),
                "min_stok" => $this->input->post("min_stok", TRUE)
            ];

            $this->db->update("parfum", $data);
        }
        
        public function edit_penjualan_by_id($id, $data){
            $this->db->where("id_penjualan", $id);
            $this->db->update("penjualan", $data);
        }
        
        public function edit_pembelian_by_id($id){
            $this->db->where("id_pembelian", $id);
            
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

            $this->db->update("pembelian", $data);
        }
        
        public function edit_barang_by_id($id){
            
            $barang = $this->get_barang_by_id($id);
            
            if($barang['harga'] != $this->nominal($this->input->post("harga", TRUE))){
                $data = [
                    "tgl" => date("Y-m-d"),
                    "id_barang" => $barang['id_barang'],
                    "harga" => $barang['harga']
                ];

                $this->db->insert("history_barang", $data);
            }
            
            $this->db->where("id_barang", $id);
            $data = [
                "nama_barang" => $this->input->post("nama_barang", TRUE),
                "status" => $this->input->post("status"),
                "harga" => $this->nominal($this->input->post("harga", TRUE))
            ];

            $this->db->update("barang", $data);
        }
        
        public function edit_penyetokan_by_id($id){
            $this->db->where("id_penyetokan", $id);
            $this->db->update("penyetokan", ["tgl_penyetokan" => $this->input->post("tgl_penyetokan")]);
        }

        public function edit_overhead_by_id($id){
            $data = [
                "tgl" => $this->input->post("tgl", TRUE),
                "jenis" => $this->input->post("jenis", TRUE),
                "nominal" => $this->nominal($this->input->post("nominal", TRUE))
            ];
            $this->db->where("id", $id);

            $this->db->update("biaya_overhead", $data);
        }

        public function edit_agen_by_id($id, $data){
            $this->db->where("id_agen", $id);
            $this->db->update("agen", $data);
            return $this->db->affected_rows();
        }
        
        public function edit_sales_by_id($id, $data){
            $this->db->where("id_sales", $id);
            $this->db->update("sales", $data);
            return $this->db->affected_rows();
        }

        public function edit_penjualan_agen_sales_by_id_penjualan($tipe, $id, $data){
            $this->db->where("id_penjualan", $id);
            
            if($tipe == "Agen")
                $this->db->update("penjualan_agen", $data);
            else
                $this->db->update("penjualan_sales", $data);
        }
        
        public function edit_pengeluaran_by_id($id, $data){
            $this->db->where("id_pengeluaran", $id);
            $this->db->update("pengeluaran", $data);
            return $this->db->affected_rows();
        }
        
        public function edit_pemasukan_by_id($id, $data){
            $this->db->where("id_pemasukan", $id);
            $this->db->update("pemasukan", $data);
            return $this->db->affected_rows();
        }
    // edit

    // delete
        public function delete_detail_penjualan_by_id(){
            $id_detail = $this->input->post("id_detail", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id_detail", $id);
                $this->db->delete("detail_penjualan");
            }
        }
        
        public function delete_detail_pembelian_by_id(){
            $id_detail = $this->input->post("id_detail", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id", $id);
                $this->db->delete("detail_pembelian");
            }
        }
        
        public function delete_bahan_parfum_by_id(){
            $id_detail = $this->input->post("id", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id", $id);
                $this->db->delete("bahan_parfum");
            }
        }

        public function delete_tambahan_penjualan_by_id(){
            $id_detail = $this->input->post("id", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id", $id);
                $this->db->delete("penggunaan_bahan_tambahan");
            }
        }

        public function delete_history_bahan_by_id(){
            $id_detail = $this->input->post("id", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id", $id);
                $this->db->delete("history_bahan");
            }
        }

        public function delete_history_parfum_by_id(){
            $id_detail = $this->input->post("id", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id", $id);
                $this->db->delete("history_parfum");
            }
        }

        public function delete_history_barang_by_id(){
            $id_detail = $this->input->post("id", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id", $id);
                $this->db->delete("history_barang");
            }
        }
        
        public function delete_detail_penyetokan_by_id(){
            $id_detail = $this->input->post("id", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id_detail", $id);
                $this->db->delete("penggunaan_bahan");

                $this->db->where("id_detail", $id);
                $this->db->delete("detail_penyetokan");
            }
        }
        
        public function delete_detail_pembelian_barang_by_id(){
            $id_detail = $this->input->post("id_detail", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id_detail", $id);
                $this->db->delete("detail_pembelian_barang");
            }
        }
        
        public function delete_detail_penjualan_barang_by_id(){
            $id_detail = $this->input->post("id_detail", TRUE);

            foreach ($id_detail as $id) {
                $this->db->where("id_detail", $id);
                $this->db->delete("detail_penjualan_barang");
            }
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