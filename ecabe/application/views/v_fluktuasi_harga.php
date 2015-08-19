<script src="<?php echo base_url('assets/js/highcharts/exporting.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/highcharts/highcharts.js'); ?>"></script>


<script type="text/javascript">
    var options = {
        chart: {
            renderTo: 'grafik-cabai',
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
//            categories: [],
            crosshair: true,
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
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

    $.getJSON("<?=$url?>", function (resp) {
//    {
//    tahun: 2015,
//    data: [
//    {
//        name: "Aceh",
//        data: [
//            {
//            harga: 14845,
//            bulan: 5
//            },
//        ]
//    },

        options.title.text = resp.title;
        options.subtitle.text = resp.subtitle;
        options.xAxis.title.text = resp.satuan;
        
        $.each(resp.data, function(i, datap){
            var value = [];           
            var legend = datap.name;
            $.each(datap.data, function(j, titik){
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
        
        if(resp.data.length ==0 ){
            chart.showLoading('Tidak ada data yang bisa ditampilkan.');
        }else{
            chart.hideLoading();
        }
    });
</script>

<div class="page-content bg-white">
    <div class="flex-grid no-responsive-future" style="height: 100%;" >
        <div class="row">
            <div class="cell colspan2 bg-grayLighter">
                <ul class="sidebar2 ">
                    <li class="title">Grafik Harga</li>
                    <li class="stick bg-red"><a href="<?=site_url('fluktuasi_harga/index')?>"><span class="mif-apps icon"></span>Keseluruhan</a></li>
                    <li class="stick bg-red"><a href="<?=site_url('fluktuasi_harga/index_provinsi')?>"><span class="mif-layers icon"></span>Per Provinsi</a></li>
                    <li class="stick bg-red"><a href="#"><span class="mif-layers icon"></span>Per Kota</a></li>
                    <li class="stick bg-red"><a href="#"><span class="mif-layers icon"></span>Per Titik</a></li>
                </ul>
            </div>
            <div class="cell colspan10 padding20 bg-white">
                <h1 class="text-light"><?=$title?></h1>
                
                <hr class="thin bg-grayLighter">
                <?php $this->load->view($form_filter) ?>
                <hr class="thin bg-grayLighter">
                
                <div id="grafik-cabai" ></div>
            </div>
        </div>
    </div>
</div>