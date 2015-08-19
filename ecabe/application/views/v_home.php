<script src="<?php echo base_url('assets/js/highmaps/highmaps.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/highmaps/exporting.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/highmaps/id-all.js'); ?>"></script>
<script type="text/javascript">

    $(function () {

        // Prepare demo data
        var data;

        $.getJSON("<?php echo base_url(); ?>index.php/Peta2/grafikDistribusi", function (data) {
            // Initiate the chart
            $('#container').highcharts('Map', {
                title: {
                    text: 'Highmaps basic demo'
                },
                subtitle: {
                    text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/id/id-all.js">Indonesia</a>'
                },
                mapNavigation: {
                    enabled: true,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },
                colorAxis: {
                    minColor: '#00FF00',
                    maxColor: '#FF0000',
                    stops: [
                        [0, '#00FF00'],
                        [0.5, '#FFFF00'],
                        [1, '#FF0000']
                    ]
                },
                series: [{
                        data: data,
                        mapData: Highcharts.maps['countries/id/id-all'],
                        joinBy: 'hc-key',
                        name: 'Random data',
                        states: {
                            hover: {
                                color: '#BADA55'
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }]
            });
        });

    });

</script>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title">eCabe</a>
        </div>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Dashboard</a>
                    <li><a><i class="fa fa-newspaper-o"></i> Berita</a>
                    </li>
                    <li><a><i class="fa fa-bar-chart"></i> Statistik <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="form.html">Statistik Harga Cabe</a></li>
                            <li><a href="form_advanced.html">Statistik per-Wilayah</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-shopping-cart"></i> Pasar</a></li>
                    <li><a><i class="fa fa-tree"></i> Komoditas <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="general_elements.html">Input Harga Komoditas</a></li>
                        </ul>
                    </li>                    
                    <li><a><i class="fa fa-question"></i> Tentang</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="right_col" role="main"> 
    <div class="">
        <div class="row top_tiles">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>New Sign ups</h3>
                                <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-comments-o"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>New Sign ups</h3>
                                <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>New Sign ups</h3>
                                <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-check-square-o"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>New Sign ups</h3>
                                <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                        </div>
                    </div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Peta Persebaran <small>Harga Komoditas Cabe Indonesia </small>
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Page title <small>Page subtile </small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a></li>
                                    <li><a href="#">Settings 2</a></li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <h1 class="text-light">Peta Persebaran Harga Cabe di Indonesia <span class="mif-drive-eta place-right"></span></h1>
                        <div id="container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<div class="page-content">
    <div class="flex-grid no-responsive-future" style="height: 100%;">
        <div class="row" style="height: 100%">
            <div class="cell size-x200" id="cell-sidebar">            
                <div class="tile bg-cyan fg-white" data-role="tile">
                    <div class="tile-content iconic">
                        <span class="icon mif-envelop"></span>
                        <span class="tile-badge bg-darkRed">5</span>
                        <span class="tile-label">Mail</span>
                    </div>
                </div>
                <div class="tile bg-cyan fg-white" data-role="tile">
                    <div class="tile-content iconic">
                        <span class="icon mif-envelop"></span>
                        <span class="tile-badge bg-darkRed">5</span>
                        <span class="tile-label">Mail</span>
                    </div>
                </div>   
                <div class="tile bg-cyan fg-white" data-role="tile">
                    <div class="tile-content iconic">
                        <span class="icon mif-envelop"></span>
                        <span class="tile-badge bg-darkRed">5</span>
                        <span class="tile-label">Mail</span>
                    </div>
                </div>                      
            </div>
            <div class="cell auto-size padding20 bg-white" id="cell-content">
                
                <div name="tes2">
                    <hr class="thin bg-grayLighter">
                    <button class="button primary" onclick="pushMessage('info')"><span class="mif-plus"></span> Create...</button>
                    <button class="button success" onclick="pushMessage('success')"><span class="mif-play"></span> Start</button>
                    <button class="button warning" onclick="pushMessage('warning')"><span class="mif-loop2"></span> Restart</button>
                    <button class="button alert" onclick="pushMessage('alert')">Stop all machines</button>
                    <hr class="thin bg-grayLighter">
                </div>
            </div>
        </div>
    </div>
</div>-->