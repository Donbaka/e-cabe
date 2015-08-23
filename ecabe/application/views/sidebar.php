<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title">eCabe</a>
        </div>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="<?=site_url()?>"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li><a href="<?=site_url('pasar')?>"><i class="fa fa-shopping-cart"></i> Pasar</a></li>
                    <li><a><i class="fa fa-tree"></i> Komoditas <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?=site_url('inputHarga')?>">Input Harga Komoditas</a></li>

                        </ul>
                    </li>                    
                    <li><a><i class="fa fa-bar-chart"></i> Fluktuasi Harga <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="<?=site_url('fluktuasi_harga/index')?>">Seluruh Indonesia</a></li>
                            <li><a href="<?=site_url('fluktuasi_harga/index_provinsi')?>">Per Provinsi</a></li>
                            <li><a href="<?=site_url('fluktuasi_harga/index_kota')?>">Per Kota</a></li>
                            <li><a href="<?=site_url('fluktuasi_harga/index_titik')?>">Per Titik</a></li>
                            <li><a href="<?=site_url('fluktuasi_harga/gap')?>">Gap antar sentra</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?=site_url('dapur/masyarakat/rank')?>"><i class="fa fa-users"></i> Masyarakat</a>
                    </li>
                    <li><a href="#"><i class="fa fa-question"></i> Tentang</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="right_col" role="main"> 