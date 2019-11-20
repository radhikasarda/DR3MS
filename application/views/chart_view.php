<!DOCTYPE html>
<html>
<head>
  <title>ChartJS - bar</title>
  <!-- Latest CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="chart-container" style="50%">
    <div class="bar-chart-container" style="width: 30%;">
      <canvas id="bar-chart"></canvas>
    </div>
  </div>
 
  <!-- javascript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
</body>

<script>
  $(function(){
      //get the bar chart canvas
      var cData = JSON.parse(`<?php echo $chart_data; ?>`);
	  
      var ctx = $("#bar-chart");
 
      //bar chart data
      var data = {
        labels: cData.label,
        datasets: [
          {
            label: 'No of Assets',
            data: cData.data,
            backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
          },{
            label: 'No of Assets',
            data: cData.data,
            backgroundColor: '#000000',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
          }
        ]
      };
 
		//options
		var options = {
			scales: {
    xAxes: [{ stacked: true }],
    yAxes: [{ stacked: true }]
  }}
    
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
         options: options
      });
 
  });
</script>
</html>