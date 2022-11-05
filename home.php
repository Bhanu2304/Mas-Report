<?php 
include("include/connection.php");
include("include/session-check.php");

$UserId   = $_SESSION['SESS_ID'];


	
?>



<!doctype html>
<html lang="en">
<head>
<title><?php echo $title;?></title>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type='text/javascript'>
	  google.load('visualization', '1', {packages:['gauge']});
	  google.setOnLoadCallback(drawChart);
	  function drawChart() {
		var data = google.visualization.arrayToDataTable([
		  ['Label', 'Value'],
		  ['', <?php echo $ValueT;?>],
		]);
	
		var options = {
		  width: 400, height: 200,
		  greenFrom: 0, greenTo: 1,
		  yellowFrom: 1, yellowTo: 2,
		  redFrom:2, redTo: 3,
		  max :3,
		  amberColor:'#FFCC00',
		};
	
		var chart = new google.visualization.Gauge(document.getElementById('chart_div1'));
		chart.draw(data, options);
	  }
	</script>
        
        <style>
            .projection{
                left: -1%;
                position: relative;
                top: -72%;
            }
            .txt-des{
                position: relative;
                top: -80%;
            }
        </style>
	<?php		
 if($_SESSION['SESS_TYPE']=='Channel')
			{  ?>
<div id="boxes">
    <div  id="dialog" class="home-popup window" >
        <div class="popup-head">
            <img  src="bgimg/logo-icon-dark.png" class="head-logo">

            <span ><?php echo $viewtime;?></span>
            <span style="color:<?php echo "$color"; ?>"><?php echo $_SESSION['DisplayName'];?></span>
            (<span style="color:<?php echo "$color"; ?>"><?php echo $_SESSION['Session_Code'];?></span>)
        </div>
        <hr/>
	
        <div class="popup-content">
            <img  src="bgimg/7063521463462971TATA.png" class="contant-logo" >
            <div id="chart_div1" class="projection"  style="height: 300px;"></div>
            <p class="txt-des" style="color:<?php echo "$color"; ?>">Dear Channel Partner you have been classified as <?php echo $text;?> channel partner basis  your performance on quality of acquisition</p>
        </div>
	<hr/>
		
	<div class="form-group">
            <input type="submit" value="SKIP" id="skip" style="float:right;margin-right:10px;" class="btn btn-info">
        </div>
		
  <!-- <div style="top: 199.5px;background-color: <?php echo "$color"; ?>;color:#ffffff; left: 551.5px; display: none;font-size:25px;font-weight: bold;" id="dialog" class="window">Current Month Your Performance -->
   
        <!--
        <div id="lorem">
      <table class="table "> 
			<thead> 
				<tr> 
					<th rowspan="2" style="vertical-align:top">Channel</th>
					<th rowspan="2" style="vertical-align:top">Code</th>
					<th colspan="2">Activation</th>
					<th colspan="2">Reject</th>
					<th colspan="2">Avg Reject</th>
					<th rowspan="2" style="vertical-align:top">Classification</th>
				</tr> 
				<tr> 
					<th>May</th>
					<th>Average</th>
					<th>May</th>
					<th>Average</th>
					<th>May</th>
					<th>Average</th>
				</tr> 
			</thead> 
			<tbody> 
			<?php 
			 mysql_data_seek($RscC,0);
			while($DataC = mysql_fetch_array($RscC)) { ?>
				<tr> 
				   <td><?php echo $DataC['Chname'];?></td>
				   <td><?php echo $DataC['ChCode'];?></td>
				   <td><?php echo $DataC['Positive'];?></td>
				   <td><?php echo $DataC['Positive'];?></td>
				   <td><?php echo $DataC['Negative'];?></td>
				   <td><?php echo $DataC['Negative'];?></td>
				   <td><?php echo number_format(($DataC['Negative']/($DataC['Positive']+$DataC['Negative']))*100,0);?></td>
				   <td><?php echo number_format(($DataC['Negative']/($DataC['Positive']+$DataC['Negative']))*100,0);?></td>
				   <?php if(number_format(($DataC['Negative']/$DataC['Positive'])*100,0)<'15') { ?>
                                   <td><font color ="#ffffff">Green</font></td>
				   <?php } else if(number_format(($DataC['Negative']/($DataC['Negative']+$DataC['Positive']))*100,0)>='15' && number_format(($DataC['Negative']/($DataC['Negative']+$DataC['Positive']))*100,0)<='20')  { ?>
				   <td><font color ="#ffffff">Amber</font></td>
				   <?php } else { ?>
				    <td><font color ="#ffffff">Red</font></td>
				   <?php } ?>
				</tr> 
			<?php } ?>	
			</tbody> 
			</table>
    </div>
        -->
  </div>
  <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
</div>
<?php } ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
<script src="popup/main.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


    <?php include("element/css_js.php"); ?>
<link rel="stylesheet" href="popup/main.css">	
</head>
<body class="hold-transition skin-blue sidebar-mini bgimg"  >
	<?php include("element/header.php"); ?>
        
   
    
	<!-- end of header bar -->

	<!-- end of secondary bar -->
	<?php include("element/menu.php"); ?>
	<!-- end of sidebar -->
	
		<?php 
	if($_SESSION['SESS_TYPE']=='Channel')
			{
			header("location:dashboard-channel.php");
			}

	?>

</body>
</html>
<?php //include("element/footer.php"); ?>