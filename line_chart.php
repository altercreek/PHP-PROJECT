<?php
//session_start();
// ============
include("my_class.php");
$obj=new my_class();

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Volume', 'High', 'Low','Open','Close'],
		  <?php 
				$dataTable = "stock_market_data LIMIT 5";
				foreach($obj->View_All($dataTable) AS $value1){
				extract($value1);
				
						$dt = $value1['date'];
						$trd_code = $value1['trade_code'];
						$high = $value1['high'];
						$low = $value1['low'];
						$open = $value1['open'];
						$close = $value1['close'];
						$volume = $value1['volume'];
		  
		  ?>
			['<?php echo $volume;?>', <?php echo $high; ?>,<?php echo $low; ?>,<?php echo $open; ?>,<?php echo $close;?>],
				<?php }?> 
				
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>
