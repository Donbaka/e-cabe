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
            chart.showLoading('Tidak ada data yang dapat ditampilkan.');
        }else{
            chart.hideLoading();
        }
    });
</script>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph">

            <div class="row x_title">
                <div class="col-md-6">
                    <h3>Grafik Fluktuasi Harga Cabai <small><?=$title?></small></h3>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>

            <div class="col-md-2 col-sm-2 col-xs-12 bg-white">
                <h5>Filter:</h5>
                <?php $this->load->view($form_filter) ?>
            </div>
            
            <div class="col-md-10 col-sm-10 col-xs-12">
                <div id="grafik-cabai" >
                    <div class="text-center">
                        <i class="fa fa-refresh fa-spin fa-2x"></i>
                        <p>Memuat grafik...</p>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

</div>