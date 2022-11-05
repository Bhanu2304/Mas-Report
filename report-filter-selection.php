<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include("include/connection.php");
include("include/session-check.php");

$UserId  = $_SESSION['SESS_ID']; 
$report_id = $_GET['report_id'];
//$HistoryMsisdn = $msData[$MobileFiled]==''?$Msisdn:$msData[$MobileFiled];
//print_r($_POST);
if(!empty($_POST))
{
    $column_list = $_POST['colomn_list'];
    $report_id = $_POST['report_id'];
    //print_r($column_type_list);exit;
    $ins_arr = array();
    foreach($column_list as $cl)
    {
        $tbl_arr = explode("#",$cl);
        $tbl_id = $tbl_arr[0];
        $column_name = $tbl_arr[1];
        $sel_column_type = "SELECT column_type FROM `tbl_resultant` WHERE tbl_id='$tbl_id' AND column_name='$column_name' LIMIT 1";
        $rsc_query = mysqli_query($con,$sel_column_type);
        $col_type_arr = mysqli_fetch_assoc($rsc_query);
        $column_type = $col_type_arr['column_type'];
        $ins_arr[] = "('$report_id','$tbl_id','$column_name','$column_type')";
    }
    
    $delete = "delete  from tbl_report_filter where report_id='$report_id'";
    $Rscx_Del = mysqli_query($con,$delete);
    $ins_str = "insert into tbl_report_filter(report_id,tbl_id,column_name,column_type) values".implode(",",$ins_arr);   
    $Rscx = mysqli_query($con,$ins_str);
    

		if($Rscx)
		{
		
		header("location:report-filter-selection.php?msg=succ&report_id=".$report_id);
		$_SESSION['msg']= "Report Filter Updated successfully";
                exit;
                
                }
		else
		{	
		header("location:report-filter-selection.php?msg=unsucc&report_id=".$report_id);
                $_SESSION['msg']= "Report Filter Updation Failed";
                exit;
		}
	}
	
        
$sel_tbl = "SELECT * FROM tbl_used WHERE id IN (SELECT tbl_id FROM `tbl_report_field` WHERE  active='1')";
$rsc_tbl = mysqli_query($con,$sel_tbl);

$tbl_array = array();
$tbl_column_list = array();
$first_table_id = '';

while($tbl = mysqli_fetch_assoc($rsc_tbl))
{
    $tbl_id = $tbl['id'];
    $tbl_name = $tbl['tbl_name'];
    if(empty($first_table_id))
    {
        $first_table_id = $tbl_id;
    }
    $tbl_array[$tbl_id] = $tbl_name;
    $sel_column = "SELECT * FROM `tbl_resultant` WHERE tbl_id='$tbl_id' and column_type in ('date','datetime')";
    $rsc_column = mysqli_query($con,$sel_column);
    $tmp_column_arr = array();
    
    
    
    while($col = mysqli_fetch_assoc($rsc_column))
    {
        $tmp_column_arr[] =$col['column_name']; 
        
        
    }
    
    sort($tmp_column_arr);
    $tbl_column_list[$tbl_id] = $tmp_column_arr;
    
}


//print_r($tbl_column_list); exit;
$sel_rtbl = "SELECT tbl_id,column_name,column_type FROM tbl_report_filter where report_id='$report_id'";
$rsc_rtbl = mysqli_query($con,$sel_rtbl);
$report_column_list = array();
$report_column_type_list = array();
while($col = mysqli_fetch_assoc($rsc_rtbl))
{
    $report_column_list[$col['tbl_id']][] =$col['column_name']; 
    $report_column_type_list[$col['tbl_id']][$col['column_name']] =$col['column_type']; 
}

$Select_report = "select * from tbl_report where active='1'";
$rsc_report  = mysqli_query($con,$Select_report);


//print_r($report_column_type_list);exit;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title><?php echo $title;?></title>
    <?php include("element/css_js.php"); ?>
	<script src="js/datetimepicker_css.js"></script>
	<link href="css/date.css" rel="stylesheet" type="text/css" />
	
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<script>
function openTable(tblName) {
  var i;
  var x = document.getElementsByClassName("tbl");
  for (i = 0; i < <?php echo count($tbl_array);?>; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(tblName).style.display = "block";  
}

function change_report(report_id)
{
    window.location.href = 'report-filter-selection.php?report_id='+report_id;
}
</script>
<body class="hold-transition skin-blue sidebar-mini">
	<?php include("element/header.php"); ?>
	<!-- end of secondary bar -->
	<?php include("element/menu.php"); ?>

	    <div class="content-wrapper bgimg" >
        <section class="content-header" >
          <h1>
           Report Filter Selection
            <small>
			</small>
          </h1>
        </section>
                
                 <section class="content">
		  <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> <p style="color: green" ><?php echo  $_SESSION['msg']; unset( $_SESSION['msg']);  ?></p></h3>
                    
                        <form name="form11" id="form11" method="post"></form> 
                        <label for="inputEmail3" class="col-sm-1 control-label"> Report </label>
                        <div class="col-sm-2">
                        <select name="report_id" form="form11" onchange="change_report(this.value);" required="" class="form-control">
                            <option value="">Select</option>
                           <?php while($Data_report = mysqli_fetch_array($rsc_report))
                                 { ?>
                            <option value="<?php echo $Data_report['id']; ?>" <?php if($Data_report['id']==$report_id) echo 'selected'; ?>><?php echo $Data_report['report_name']; ?></option>
                           <?php      } ?>
                                  
                        </select>
                        </div>
                        
                    
                </div>
                  
<div class="box-body">
    <div class="w3-bar w3-black">
        <?php foreach($tbl_array as $tbl_id=>$tbl_value) { ?>
      <button class="w3-bar-item w3-button" onclick="openTable('<?php echo $tbl_id;?>')"><?php echo $tbl_value;?></button>
        <?php } ?>

    </div>

<?php foreach($tbl_array as $tbl_id=>$tbl_value) { ?>                  
<div id="<?php echo $tbl_id;?>" class="w3-container tbl">
  <h2><?php echo $tbl_value;?></h2>
  <div>
      <table class="table table-hover">
          <thead>
              <tr>
                  <th>Column 1</th>
                  <th>Column 2</th>
                  <th>Column 3</th>
                  <th>Column 4</th>
              </tr>
          </thead>
          <tbody>
              <tr>
              <?php  $srno=1;
              
              foreach($tbl_column_list[$tbl_id] as $column_name) 
                  { if($srno%4==1) 
                      {echo '</tr><tr>';} 
                    $key= "$tbl_id"."_"."$column_name"; ?>
              
                  
                  <td><u><?php  echo $srno++; ?> </u> 
                  
                      <?php echo $column_name;  ?>
                      <input type="checkbox" form="form11" name="colomn_list[]" 
                             value="<?php echo "$tbl_id"."#".$column_name; ?>" 
                            <?php if(in_array($column_name,$report_column_list[$tbl_id])) { echo 'checked';} ?>  />
                  </td>    
                  
            <?php } ?>    
              </tr>
          </tbody>
      </table>
  </div>
</div>
<?php } ?>
    <input type="hidden" form="form11" name="report_id" value="<?php echo $report_id; ?>" />
     <input type="submit" form="form11" value="save" name="save" class="btn btn-info" />
</div>
                  

			  
          </div>
                      
		  </div>
                 </section>
                    
            </div>
</body>
</html>
<script>
openTable('<?php echo $first_table_id;?>');
</script>