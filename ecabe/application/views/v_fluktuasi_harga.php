<script src="<?php echo base_url('assets/js/highcharts/exporting.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/highcharts/highcharts.js'); ?>"></script>
<script type="text/javascript">
    var options = {
        chart: {
            renderTo: 'grafik-cabai',
            type: 'line'
        },
        title: {
            text: 'Grafik Fluktuasi Harga Cabai di Indonesia',
            x: -20 //center
        },
        subtitle: {
            text: 'Perbandingan Rata-rata Harga Cabai per-Provinsi Tahun <?=$p_tahun;?>',
            x: -20
        },
        xAxis: {
//            categories: [],
            crosshair: true,
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Bulan'
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

    $.getJSON("<?php echo base_url(); ?>index.php/fluktuasi_harga/grafik/<?=$p_komoditas?>/<?=$p_tahun?>", function (resp) {
//        {
    //        tahun: 2015,
    //        data: [
        //        {
            //        name: "Aceh",
            //        data: [
                //        {
                //        harga: 14845,
                //        bulan: 5
                //        },
            //        ]
            //    },
            
        $.each(resp.data, function(i, prov){
            var value = [];           
            var legend = prov.name;
            $.each(prov.data, function(j, titik){
               var date = Date.UTC(resp.tahun, titik.bulan);
               var harga = titik.harga;
               value.push([date, harga]);
            });
            
            options.series.push({
                name: legend,
                data: value
            });
        });
        chart = new Highcharts.Chart(options);
    });
</script>

<div class="page-content">
<!--    <div class="flex-grid no-responsive-future" style="height: 100%;">
        <div class="row" style="height: 100%">
            <div class="cell size-x200" id="cell-sidebar" style="background-color: #71b1d1; height: 100%">
                <ul class="sidebar">
                    <li class="active">
                        <a href="#">
                            <span class="mif-drive-eta icon"></span>
                            <span class="title">Data Fluktuasi Harga</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="cell auto-size padding20 bg-white" id="cell-content">
                <section class="content">
                    <div class="row">                
                        <section class="col-lg-3">
                             Map box 
                            <div class="box box-solid bg-light-blue-gradient">
                                <div class="box-header">
                                     tools box 
                                    <h3 class="box-title">
                                        Navigasi Data
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <?=form_open('fluktuasi_harga'); ?>                                
                                    <div class="form-group">                                    
                                        <label>Pilih Jenis Cabai</label>
                                        <select name="inputCabai" id="inputCabai" class="form-control">
                                            <option value="">Pilih Provinsi</option>
                                            
                                        </select>                              
                                    </div>
                                    <div class="form-group">
                                        <label>Pilih Tahun</label>
                                        <select name="inputTahun" class="form-control">
                                            <option value="">Pilih Tahun</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pilih Bulan</label>
                                        <select name="inputBulan" class="form-control">
                                            <option value="">Pilih Bulan</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <center><button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button></center>
                                    </div>
                                    </form>
                                </div> /.box-body
                            </div>
                             /.box 
                            <div class="callout callout-success">
                                <center>
                                    <h4>Sudahkah harga cabai di daerah anda dilaporkan disini?</h4>
                                    <a href="<?php echo base_url(); ?>index.php/InputHarga" class="small-box-footer">Mari laporkan harga cabai di daerah anda disini! <i class="fa fa-arrow-circle-right"></i></a>
                                </center>
                            </div>
                        </section>
                        <section class="col-lg-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right ui-sortable-handle">
                                    <li class="active"><a href="#grafik-kota" data-toggle="tab" aria-expanded="true">Kota</a></li>
                                    <li><a href="#grafik-bulan" data-toggle="tab" aria-expanded="false">Bulan</a></li>
                                    <li><a href="#grafik-minggu" data-toggle="tab" aria-expanded="false">Minggu</a></li>
                                    <li><a href="#grafik-verified" data-toggle="tab" aria-expanded="false">Verified Data</a></li>
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> Grafik Fluktuasi Harga Cabai</li>
                                </ul>-->
                                <div class="tab-content no-padding">
                                    <div class="chart tab-pane active" id="grafik-cabai" style="position: relative; width:100%; height: 400px;"></div>
                                    <div class="chart tab-pane" id="grafik-bulan" style="position: relative; width:72.5%; height: 400px;"></div>
                                    <div class="chart tab-pane" id="grafik-minggu" style="position: relative; width:72.5%; height: 400px;"></div>
                                    <div class="chart tab-pane" id="grafik-verified" style="position: relative; width:72.5%; height: 400px;"></div>
                                </div>
<!--                            </div>
                        </section>
                    </div>
                </section>
            </div>
    </div>
</div>-->