<?php
    set_time_limit(300);
    function rupiah($angka){
        
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href="<?= base_url()?>assets/img/parfum.png">
  <title><?= $title?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  
  <!-- Custom styles for data tables -->
  <link href="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- modal plugins css -->
  <!-- <link rel="stylesheet" href="<?= base_url()?>assets/css/jquery.modal.min.css"> -->

  <!-- customku -->
  <link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
  
    <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url()?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url()?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url()?>assets/js/demo/datatables-demo.js"></script>

  <!-- modal plugin -->
  <!-- <script src="<?= base_url()?>assets/js/jquery.modal.min.js"></script> -->

  <!-- sweet alert -->
  
  <script src="<?= base_url()?>assets/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body id="page-top">
  <div id="wrapper">
