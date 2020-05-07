<?php
class Laporan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model("Parfum_model");
    }

    public function index(){
        $data['title'] = "List Laporan";
        
        $data['month'] = ["1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];

        $data['periode'] = $this->Parfum_model->get_periode();

        // var_dump($periode);

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("laporan/index", $data);
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
}