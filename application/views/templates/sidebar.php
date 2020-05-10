    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <i class="fas fa-wine-bottle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dehiz Parfum</div>
      </a>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Dehiz Parfum
      </div>

      
      <li class="nav-item" id="agen">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#droptwo" aria-expanded="true" aria-controls="droptwo">
          <i class="fas fa-user"></i>
          <span>Agen & Sales</span>
        </a>
        <div id="droptwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Agen & Sales</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>admin/agen">Agen</a>
            <a class="collapse-item text-light" href="<?= base_url()?>admin/sales">Sales</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item" id="bahan">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropone" aria-expanded="true" aria-controls="dropone">
          <i class="fas fa-prescription-bottle"></i>
          <span>Bahan</span>
        </a>
        <div id="dropone" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Bahan</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>admin/bahanbaku">Bahan Baku</a>
            <a class="collapse-item text-light" href="<?= base_url()?>admin/bahanpembantu">Bahan Pembantu</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item" id="parfum">
        <a class="nav-link collapsed" href="<?= base_url()?>admin/parfum">
          <i class="fas fa-fw fa-wine-bottle"></i>
          <span>Parfum</span>
        </a>
      </li>
      
      <li class="nav-item" id="barang">
        <a class="nav-link collapsed" href="<?= base_url()?>admin/barang">
          <i class="fas fa-fw fa-box"></i>
          <span>Barang</span>
        </a>
      </li>
      
      <li class="nav-item" id="overhead">
        <a class="nav-link collapsed" href="<?= base_url()?>admin/overhead">
          <i class="fas fa-fw fa-industry"></i>
          <span>Overhead</span>
        </a>
      </li>

      <!-- <li class="nav-item" id="pembelian">
        <a class="nav-link collapsed" href="<?= base_url()?>produksi/pembelian">
          <i class="fas fa-fw fa-truck-loading"></i>
          <span>Pembelian</span>
        </a>
      </li> -->

      <li class="nav-item" id="pembelian">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#droptiga" aria-expanded="true" aria-controls="droptiga">
          <i class="fas fa-truck-loading"></i>
          <span>Pengeluaran</span>
        </a>
        <div id="droptiga" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Pengeluaran</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>produksi/pembelian">Pembelian</a>
            <a class="collapse-item text-light" href="<?= base_url()?>admin/pengeluaran">Lain-Lain</a>
          </div>
        </div>
      </li>

      <li class="nav-item" id="pemasukan">
        <a class="nav-link collapsed" href="<?= base_url()?>admin/pemasukan">
          <i class="fas fa-fw fa-money-check"></i>
          <span>Pemasukan</span>
        </a>
      </li>
      
      <li class="nav-item" id="penyetokan">
        <a class="nav-link collapsed" href="<?= base_url()?>admin/penyetokan">
          <i class="fas fa-fw fa-boxes"></i>
          <span>Penyetokan</span>
        </a>
      </li>
      
      
      <li class="nav-item" id="penjualan">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropthree" aria-expanded="true" aria-controls="dropthree">
          <i class="fas fa-truck"></i>
          <span>Penjualan</span>
        </a>
        <div id="dropthree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Penjualan</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>kasir/penjualanagen">Penjualan Agen</a>
            <a class="collapse-item text-light" href="<?= base_url()?>kasir/penjualansales">Penjualan Sales</a>
          </div>
        </div>
      </li>

      <!-- <li class="nav-item" id="penjualan">
        <a class="nav-link collapsed" href="<?= base_url()?>kasir/penjualan">
          <i class="fas fa-fw fa-truck"></i>
          <span>Penjualan</span>
        </a>
      </li> -->
      
      <li class="nav-item" id="laporan">
        <a class="nav-link collapsed" href="<?= base_url()?>laporan/">
          <i class="fas fa-fw fa-flag"></i>
          <span>Laporan</span>
        </a>
      </li>
      
      <li class="nav-item" id="Peserta">
        <a class="nav-link" href="<?= base_url()?>login/logout">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span></a>
      </li>
    </ul>
    <!-- End of Sidebar -->
