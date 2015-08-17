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
    <div class="flex-grid no-responsive-future" style="height: 100%;" >
        <div class="row">
            <div class="cell colspan2 sidebar">
            </div>
            <div class="cell colspan10 padding20 bg-white">
                <h1 class="text-light">Grafik Fluktuasi Harga Cabai <span class="mif-meter place-right"></span></h1>
                
                <hr class="thin bg-grayLighter">
                <?=form_open('fluktuasi_harga/index')?>
                <div class="grid">
                    <div class="row cells4">
                        <div class="cell">
                            <div class="input-control text full-size">
                                <h5>Filter:</h5>
                            </div>
                        </div>
                        <div class="cell">
                            <div class="input-control select full-size">
                                <select name="input-tahun" id="input-tahun" class="form-control">
                                    <option value="">Tahun</option>
                                    <?php foreach($tahun as $t): ?>
                                        <option value="<?=$t?>"><?=$t?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="cell colspan2">
                            <div class="input-control select full-size">
                                <select name="input-komoditas" id="input-komoditas" class="form-control">
                                    <option value="1">Jenis</option>
                                     <?php foreach($komoditas as $k): ?>
                                        <option value="<?=$k->id?>"><?=$k->komoditas?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="cell">
                            <div class="input-control full-size">
                                <button class="button primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?=form_close()?>
                <hr class="thin bg-grayLighter">
                
                <div id="grafik-cabai" ></div>
            </div>
        </div>
    </div>
</div>