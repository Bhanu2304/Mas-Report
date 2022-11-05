<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include("include/connection.php");
include("include/session-check.php");

$UserId  = $_SESSION['SESS_ID']; 
//$HistoryMsisdn = $msData[$MobileFiled]==''?$Msisdn:$msData[$MobileFiled];
//print_r($_POST);
if(!empty($_POST))
{
    $column_list = $_POST['colomn_list'];
    //print_r($column_list);exit;
    $ins_arr = array();
    foreach($column_list as $cl)
    {
        $tbl_arr = explode("#",$cl);
        $tbl_id = $tbl_arr[0];
        $column_name = $tbl_arr[1];
        $column_type = addslashes($tbl_arr[2]);
        $ins_arr[] = "('$tbl_id','$column_name','$column_type')";
        
        
        
    }
    
    $delete = "delete  from tbl_resultant";
    $Rscx_Del = mysqli_query($con,$delete);
    $ins_str = "insert into tbl_resultant(tbl_id,column_name,column_type) values".implode(",",$ins_arr);  
    
	
    
    $Rscx = mysqli_query($con,$ins_str);
    

		if($Rscx)
		{
		
		header("location:tbl_field_selection.php?msg=succ");
		$_SESSION['msg']= "Data Columns Updated successfully";
                exit;
                
                }
		else
		{	
		header("location:tbl_field_selection.php?msg=unsucc");
                $_SESSION['msg']= "Data Columns Updation Failed";
                exit;
		}
	}
	
        
$sel_tbl = "select * from tbl_used where active='1'";
$rsc_tbl = mysqli_query($con,$sel_tbl);

$tbl_array = array();
$tbl_column_list = array();
$tbl_type_list = array();
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
    $sel_column = "SHOW COLUMNS FROM $tbl_name";
    $rsc_column = mysqli_query($dialer,$sel_column);
    $tmp_column_arr = array();
    $tmp_type_arr = array();
    while($col = mysqli_fetch_assoc($rsc_column))
    {
        $tmp_column_arr[] =$col['Field']; 
        $tmp_type_arr[$col['Field']] =$col['Type']; 
    }
    
    sort($tmp_column_arr);
    
    $tbl_column_list[$tbl_id] = $tmp_column_arr;
    $tbl_type_list[$tbl_id] = $tmp_type_arr;
}


//print_r($tbl_column_list); exit;
$sel_rtbl = "SELECT tbl_id,column_name FROM tbl_resultant";
$rsc_rtbl = mysqli_query($con,$sel_rtbl);
$tbl_result_list = array();
while($col = mysqli_fetch_assoc($rsc_rtbl))
{
    $tbl_result_list[$col['tbl_id']][] =$col['column_name']; 
}

//print_r($tbl_result_list);exit;
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


</script>
<body class="hold-transition skin-blue sidebar-mini">
	<?php include("element/header.php"); ?>
	<!-- end of secondary bar -->
	<?php include("element/menu.php"); ?>

	    <div class="content-wrapper bgimg" >
        <section class="content-header" >
          <h1>
           Report Field Selection
            <small>
			</small>
          </h1>
        </section>
                
                 <section class="content">
		  <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> <p style="color: green" ><?php echo  $_SESSION['msg']; unset( $_SESSION['msg']);  ?></p></h3>
                    <div class="box-tools pull-right">
                        <form name="form11" id="form11" method="post"><input type="submit" value="save" name="save" class="btn btn-info" /></form>  
                        
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
              <tr><th>Column 1</th><th>Column 2</th><th>Column 3</th><th>Column 4</th></tr>
          </thead>
          <tbody>
              <tr>
              <?php  $srno=1;
              
              foreach($tbl_column_list[$tbl_id] as $column_name) 
                  { if($srno%4==1) echo '</tr><tr>'; ?>
              
                  
                  <td><u><?php echo $srno++; ?></u> 
                      <?php echo $column_name;  ?>
                      <input type="checkbox" form="form11" name="colomn_list[]" 
                             value="<?php echo "$tbl_id"."#".$column_name.'#'.$tbl_type_list[$tbl_id][$column_name]; ?>" 
                            <?php if(in_array($column_name,$tbl_result_list[$tbl_id])) { echo 'checked';} ?>  />
                  </td>
            <?php } ?>    
              </tr>
          </tbody>
      </table>
  </div>
</div>
<?php } ?>
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