<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link href="<?php echo base_url('assets/css/metro.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/metro-icons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/metro-responsive.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/metro.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/highmaps/highmaps.js'); ?>"></script>
    <script src="<?php echo base_url('assets/highmaps/exporting.js'); ?>"></script>
    <script src="<?php echo base_url('assets/highmaps/id-all.js'); ?>"></script>
    <style>
		#container {
		    height: 500px; 
		    min-width: 310px; 
		    max-width: 800px; 
		    margin: 0 auto; 
		}
		.loading {
		    margin-top: 10em;
		    text-align: center;
		    color: gray;
		}
    </style>
</head>
<body class="bg-steel">
<script type="text/javascript">

	$(function () {

    // Prepare demo data
    var data;

    $.getJSON("<?php echo base_url(); ?>index.php/Peta2/grafikDistribusi", function (data) {
        // Initiate the chart
        $('#container').highcharts('Map', {

            title : {
                text : 'Highmaps basic demo'
            },

            subtitle : {
                text : 'Source map: <a href="http://code.highcharts.com/mapdata/countries/id/id-all.js">Indonesia</a>'
            },

            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },

            colorAxis: {
                min: 0
            },

            series : [{
                data : data,
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

<div id="container"></div>