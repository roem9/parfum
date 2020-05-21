<?php
class Parfum_model extends CI_MODEL{
    public function __construct(){
        parent::__construct();
        $this->load->model("Main_model");
    }
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
        
        public function get_bahan_parfum_by_id_parfum($id){
            $this->db->from("bahan_parfum as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("id_parfum", $id);
            return $this->db->get()->result_array();
        }
        
        public function get_detail_penjualan_by_id_penjualan($id){
            $this->db->select("*, a.id_parfum, a.harga");
            $this->db->from("detail_penjualan as a");
            $this->db->join("parfum as b", "a.id_parfum = b.id_parfum");
            $this->db->where("id_penjualan", $id);
            return $this->db->get()->result_array();
        }
        
        public function get_detail_pembelian_by_id_pembelian($id){
            $this->db->select("*, a.id_bahan");
            $this->db->from("detail_pembelian as a");
            $this->db->join("bahan as b", "a.id_bahan = b.id_bahan");
            $this->db->where("id_pembelian", $id);
            return $this->db->get()->result_array();
        }

        public function get_pembelian_bahan_by_jenis_by_periode($jenis, $bulan, $tahun){
            $this->db->select("SUM(harga) as total");
            $this->db->from("pembelian_bahan");
            $this->db->where("MONTH(tgl_pembelian)", $bulan);
            $this->db->where("YEAR(tgl_pembelian)", $tahun);
            $this->db->where("jenis", $jenis);
            $this->db->group_by("id_pembelian");
            return $this->db->get()->result_array();
        }

        public function get_persediaan_bahan_baku_awal($bulan, $tahun){
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
                $date = $this->Main_model->get_one("pembelian", ["id_pembelian" => $pembelian['id_pembelian']]);
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
                $date = $this->Main_model->get_one("pembelian", ["id_pembelian" => $pembelian['id_pembelian']]);
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
            
            return $total_beli - $total_jual;
        }
        
        public function get_persediaan_bahan_baku_akhir($bulan, $tahun){
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
                $date = $this->Main_model->get_one("pembelian", ["id_pembelian" => $pembelian['id_pembelian']]);
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
                $date = $this->Main_model->get_one("pembelian", ["id_pembelian" => $pembelian['id_pembelian']]);
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
            return $total_beli - $total_jual;
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
        
        public function get_history_barang_by_id($id){
            $this->db->select("*, b.harga as harga, a.harga as n_harga");
            $this->db->from("barang as a");
            $this->db->join("history_barang as b", "a.id_barang = b.id_barang", "left");
            $this->db->where("a.id_barang", $id);
            $this->db->order_by("id", "DESC");
            return $this->db->get()->result_array();
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
    // get get by id
    
    // other function
        public function nominal($data){
            $data = str_replace("Rp. ", "", $data);
            $data = str_replace(".", "", $data);
            return $data;
        }
    // other function
}