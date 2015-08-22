<script src="<?php echo base_url('assets/js/highcharts/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/highmaps/exporting.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/highmaps/map.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/highmaps/id-all.js'); ?>"></script>
<script type="text/javascript">

    $(function () {

        // Prepare demo data
        var data;

        $.getJSON("<?php echo base_url(); ?>index.php/Home/grafikDistribusi", function (data) {
            // Initiate the chart
            $('#container').highcharts('Map', {
                title: {
                    text: 'Persebaran Harga Cabe'
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
<script type="text/javascript">
    var options = {
        chart: {
            renderTo: 'grafik',
            type: 'line'
        },
        title: {
            text: '',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
//            categories: ['May'],
            crosshair: true,
            type: 'datetime',
            dateTimeLabelFormats: {// don't display the dummy year
                day: '%e %B %Y'
            },
            title: {
                text: ''
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah (Rp)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: []
    };

    $.getJSON("<?= $url ?>", function (resp) {
        options.title.text = resp.title;
        options.subtitle.text = resp.subtitle;
        options.xAxis.title.text = resp.satuan;

        $.each(resp.data, function (i, datap) {
            var value = [];
            var legend = datap.name;
            $.each(datap.data, function (j, titik) {
                var date = Date.UTC(resp.tahun, titik.bulan - 1, titik.tanggal);
                var harga = titik.harga;
                value.push([date, harga]);
            });

            options.series.push({
                name: legend,
                data: value
            });
        });
        chart = new Highcharts.Chart(options);

        if (resp.data.length == 0) {
            chart.showLoading('Tidak ada data yang dapat ditampilkan.');
        } else {
            chart.hideLoading();
        }
    });
</script>
<div class="row">
    <div class="row tile_count">
        <div class="animated flipInY col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-user"></i> Kenaikan Tertinggi</span>
                <div class="count"><?php echo "Rp. ".number_format($kenaikanTertinggi); ?></div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo number_format ($persentasekenaikan, 2, ',', ''); ?>% </i> Dari Hari Sebelumnya</span>
            </div>
        </div>
        <div class="animated flipInY col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-clock-o"></i> Penurunan Tertinggi</span>
                <div class="count"><?php echo "Rp. ".number_format($penurunanTertinggi); ?></div>
                <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?php echo number_format ($persentasepenurunan, 2, ',', ''); ?>% </i> Dari Hari Sebelumnya</span>
            </div>
        </div>
        <div class="animated flipInY col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-user"></i> Harga Terendah</span>
                <div class="count green"><?php echo "Rp. ".number_format($hargaterendah); ?></div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php echo number_format ($persentasetertinggi, 2, ',', ''); ?>% </i> Dari Hari Sebelumnya</span>
            </div>
        </div>
        <div class="animated flipInY col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
                <span class="count_top"><i class="fa fa-user"></i> Harga Tertinggi</span>
                <div class="count red"><?php echo "Rp. ".number_format($hargatertinggi); ?></div>
                <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?php echo number_format ($persentaseterendah, 2, ',', ''); ?>% </i> Dari Hari Sebelumnya</span>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-9">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    Peta Persebaran <small>Harga Komoditas Cabe Indonesia </small>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Daftar Komoditas <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Cabe Merah</a></li>
                            <li><a href="#">Cabe Merah Keriting</a></li>
                            <li><a href="#">Cabe Rawit</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="container"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="animated flipInY">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                </div>
                <div class="count"><?php echo $pasar; ?></div>

                <h3>Titik Distribusi</h3>
                <p>Jumlah Titik Distribusi Terdaftar</p>
            </div>
        </div>
        <div class="animated flipInY">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-comments-o"></i>
                </div>
                <div class="count">179</div>

                <h3>Laporan</h3>
                <p>Jumlah Laporan Diterima</p>
            </div>
        </div>
        <div class="animated flipInY">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                </div>
                <div class="count">179</div>

                <h3>User</h3>
                <p>Jumlah User Terdaftar</p>
            </div>
        </div>
        <div class="animated flipInY">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i>
                </div>
                <div class="count">179</div>

                <h3>Petani</h3>
                <p>Jumlah Petani Terdaftar</p>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div id="grafik">
    <div class="x_panel">
        <div class="x_title"></div>
        <div class="x_content">
            <i class="fa fa-refresh fa-spin fa-2x"></i>
            <p>Memuat grafik...</p>
        </div>
    </div>
</div>