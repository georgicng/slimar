<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "home";
//Sets last active time for forums [This is to check if the user is online or not]
if(!$in_perm['has_admin']){
	header("location: ../index.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<?php include "inc/head.php"; ?>
</head>

<body>
	<?php include "inc/header.php"; ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<?php
		$update = file_get_contents('http://slimar.org/user-update.php');
		$update2 = file_get_contents('http://slimar.org/user-update2.php');
		if($version < $update){
		echo '
		<div class="alert bg-info" role="alert">
			'.$update2.'
		</div>
		';
		}
		?>
				
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Welcome <?php echo $in['username']; ?></h1>
			</div>
		</div><!--/.row-->
		
		<div class="alert bg-primary" role="alert">
					<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg> Welcome to the administration dashboard
				</div>
		
		<div class="row">
		<?php 
			$sql2 = "SELECT COUNT(*) as count FROM games";
			$stm2 = $dbh->prepare($sql2);
			$stm2->execute();
			$count= $stm2->fetchColumn(); 
			?>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<i class="fa fa-users fa-4x" aria-hidden="true"></i>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $count; ?></div>
							<div class="text-muted">Total games</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php 
			$sql2 = "SELECT COUNT(*) as count FROM games_played";
			$stm2 = $dbh->prepare($sql2);
			$stm2->execute();
			$count= $stm2->fetchColumn(); 
			?>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<i class="fa fa-users fa-4x" aria-hidden="true"></i>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $count; ?></div>
							<div class="text-muted">Games played</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php 
			$sql2 = "SELECT COUNT(*) as count FROM users";
			$stm2 = $dbh->prepare($sql2);
			$stm2->execute();
			$count= $stm2->fetchColumn(); 
			?>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<i class="fa fa-user fa-4x" aria-hidden="true"></i>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $count; ?></div>
							<div class="text-muted">Members</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			$sql2 = "SELECT COUNT(*) as count FROM games_comments";
			$stm2 = $dbh->prepare($sql2);
			$stm2->execute();
			$count= $stm2->fetchColumn(); 
			?>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-navy panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-4 widget-left">
							<i class="fa fa-list fa-4x" aria-hidden="true"></i>
						</div>
						<div class="col-sm-9 col-lg-8 widget-right">
							<div class="large"><?php echo $count; ?></div>
							<div class="text-muted">Game comments</div>
						</div>
					</div>
				</div>
			</div>
			
			
			
		</div><!--/.row-->
		<div class="row">
		
		<div class="col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading">Monthly plays</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
			
			
		<div class="col-md-4">
			
				<div class="panel panel-blue">
					<div class="panel-heading dark-overlay">Latest registerations</div>
					<div class="panel-body">
						<table>
						<?php
	$sql = "SELECT * FROM users ORDER BY id desc LIMIT 4";
	$stm = $dbh->prepare($sql);	
	$stm->execute();
	$u = $stm->fetchAll();
	
	$count = 0;
	foreach ($u as $user) {
		//Gets user profile picture 
		if(get_gravatar($user['email']) && $user['gravatar'] == "1")
		{
			$profilepic = get_gravatar($user['email']);
		}else{
			$profilepic = $user['profilepic'];
		}
						
		//Gathers users permissions
		$stmt1 = $dbh->prepare("SELECT * FROM usergroups WHERE `rank` = :id"); 
		$stmt1->bindValue(':id', $user['usergroup']);
		$stmt1->execute(); 
		$in_perm2 = $stmt1->fetch();
	?>					
	<tr >
		<a href="profile.php?u=<?php echo $user['username']; ?>" target="_blank"><td>
			<a href="../profile.php?u=<?php echo $user['username']; ?>" style="color:white;" target="_blank"><img src="<?php echo $profilepic; ?>" style="margin-right:15px;margin-bottom:5px;height:52px;width:52px;" alt="..."></a>
		</td>
		<td >
			<a href="../profile.php?u=<?php echo $user['username']; ?>" style="color:white;" target="_blank"><?php echo $user['username']; ?></a>
		</td ></a>
	</tr>
	<?php } ?>
	
							<tr>
								<td>
								</td>
							</tr>
							<tr>
								<td>
								</td>
							</tr>
						</table>
					</div>
					
				</div>
								
			</div><!--/.col-->
		
		</div>
							
			
			
		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
	
	var lineChartData = {
		<?php
		$first  = strtotime('first day this month');


		$months = [];
		$count = 0;
		$lastmonth = date("F", strtotime("last day of previous month"));
		
		if($count = 1){
				$sql2 = "SELECT COUNT(*) as count FROM games_played WHERE month_played = '".$lastmonth."'";
				$stm2 = $dbh->prepare($sql2);
				$stm2->execute();
				$lastcount= $stm2->fetchColumn();
			}
			
			
		for ($x=1; $x < 6; $x++) {

			$time = mktime(0, 0, 0, $x, 1);
			$key = date('m', $time);
			$name =  ucfirst(strftime('%B', $time));
			$months[(int)$key] = $name;
			$count = $count + 1;
			
			if($count = 1){
				$sql2 = "SELECT COUNT(*) as count FROM games_played WHERE month_played = '".$months[1]."'";
				$stm2 = $dbh->prepare($sql2);
				$stm2->execute();
				$count1= $stm2->fetchColumn();
			}
			if($count = 2){
				$sql2 = "SELECT COUNT(*) as count FROM games_played WHERE month_played = '".$months[2]."'";
				$stm2 = $dbh->prepare($sql2);
				$stm2->execute();
				$count2= $stm2->fetchColumn();
			}
			if($count = 3){
				$sql2 = "SELECT COUNT(*) as count FROM games_played WHERE month_played = '".$months[3]."'";
				$stm2 = $dbh->prepare($sql2);
				$stm2->execute();
				$count3= $stm2->fetchColumn();
			}
			if($count = 4){
				$sql2 = "SELECT COUNT(*) as count FROM games_played WHERE month_played = '".$months[4]."'";
				$stm2 = $dbh->prepare($sql2);
				$stm2->execute();
				$count4= $stm2->fetchColumn();
			}
			if($count = 5){
				$sql2 = "SELECT COUNT(*) as count FROM games_played WHERE month_played = '".$months[5]."'";
				$stm2 = $dbh->prepare($sql2);
				$stm2->execute();
				$count5= $stm2->fetchColumn();
			}
			if($count = 6){
				$sql2 = "SELECT COUNT(*) as count FROM games_played WHERE month_played = '".$months[6]."'";
				$stm2 = $dbh->prepare($sql2);
				$stm2->execute();
				$count6= $stm2->fetchColumn();
			}
		}
		?>
			labels : ["<?php echo $lastmonth; ?>",<?php foreach ($months as $value) { echo '"'.$value.'",';} ?>],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [<?php echo "".$lastcount.",".$count1.", ".$count2.", ".$count3.", ".$count4.", ".$count5.", ".$count6.""; ?>]
				},
				
			]

		}
		
	var barChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,0.8)",
					highlightFill: "rgba(220,220,220,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				},
				{
					fillColor : "rgba(48, 164, 255, 0.2)",
					strokeColor : "rgba(48, 164, 255, 0.8)",
					highlightFill : "rgba(48, 164, 255, 0.75)",
					highlightStroke : "rgba(48, 164, 255, 1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]
	
		}

	var pieData = [
				{
					value: 300,
					color:"#30a5ff",
					highlight: "#62b9fb",
					label: "Blue"
				},
				{
					value: 50,
					color: "#ffb53e",
					highlight: "#fac878",
					label: "Orange"
				},
				{
					value: 100,
					color: "#1ebfae",
					highlight: "#3cdfce",
					label: "Teal"
				},
				{
					value: 120,
					color: "#f9243f",
					highlight: "#f6495f",
					label: "Red"
				}

			];
			
	var doughnutData = [
					{
						value: 300,
						color:"#30a5ff",
						highlight: "#62b9fb",
						label: "Blue"
					},
					{
						value: 50,
						color: "#ffb53e",
						highlight: "#fac878",
						label: "Orange"
					},
					{
						value: 100,
						color: "#1ebfae",
						highlight: "#3cdfce",
						label: "Teal"
					},
					{
						value: 120,
						color: "#f9243f",
						highlight: "#f6495f",
						label: "Red"
					}
	
				];

window.onload = function(){
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
		responsive: true
	});
	var chart2 = document.getElementById("bar-chart").getContext("2d");
	window.myBar = new Chart(chart2).Bar(barChartData, {
		responsive : true
	});
	var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true
	});
	var chart4 = document.getElementById("pie-chart").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData, {responsive : true
	});
	
};
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
