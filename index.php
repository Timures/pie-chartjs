<?php
/* Database connection settings */
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'chart';

try {
	$dbcon = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ex){
	die($ex->getMessage());
}
$stmt=$dbcon->prepare("SELECT * FROM chart_data");
$stmt->execute();
$labels= []; // legenda
$amounts= []; // данные
while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	extract($row);
	$labels[]= $mylabel;//echo $mylabel;
	$amounts[]= (float)$myvalue;//echo $myvalue;
}
	// echo json_encode($json);
	// echo json_encode($json2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Pie chart</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
</head>
<body>
	<div class="chart" style="max-width:400px">
		<canvas id="myChart" width="400" height="400"></canvas>
	</div>

	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

	<script type="text/javascript">
	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'pie',

		// The data for our dataset
		data: {
			labels: <?php echo json_encode($labels); ?>,
			datasets: [{
				label: 'My First dataset',
				backgroundColor: ['rgb(35, 151, 135)','rgba(255, 99, 132, 0.6)',
        			'rgba(54, 162, 235, 0.6)'],
				borderColor: 'rgb(255, 99, 132)',
				data: <?php echo json_encode($amounts); ?>
			}]
		},

		// Configuration options go here
		options: {}
	});
	
	</script>
</body>
</html>