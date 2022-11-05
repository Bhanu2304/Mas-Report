<?php
include("include/connection.php");
include("include/session-check.php");

if(!empty($_POST))
{
  $report_id = $_POST['report_id'];  
}


$Select_report = "select * from tbl_report where active='1'";
$rsc_report  = mysqli_query($con,$Select_report);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $title;?></title>
    <?php include("element/css_js.php"); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">

	<?php include("element/header.php"); ?>
	<!-- end of header bar -->
	<?php include("element/menu.php"); ?>
	<!-- end of sidebar -->
      <div class="content-wrapper bgimg">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Report
            <small>
			</small>
          </h1>
        </section>
	            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Report
				  <?php echo $MsgStr; ?>
				  </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
		<form name="frmreallocation" method="post"  class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label"> Report </label>
                        <div class="col-sm-2">
                        <select name="report_id"   required="" class="form-control">
                            <option value="">Select</option>
                           <?php while($Data_report = mysqli_fetch_array($rsc_report))
                                 { ?>
                            <option value="<?php echo $Data_report['id']; ?>" <?php if($Data_report['id']==$report_id) echo 'selected'; ?>><?php echo $Data_report['report_name']; ?></option>
                           <?php      } ?>
                                  
                        </select>
                        </div>
                        <!--
                        <label for="inputEmail3" class="col-sm-1 control-label"> Date Wise </label>
                        <div class="col-sm-2">
                            <select class="form-control" name="allocation" id = "allocation" required="">
                                <option value="">Select</option>
                                <option value="ImportDate"> Import Date Wise </option>
                                <option value="CallDate"> Call Date Wise </option>
                                <option value="AgentWise"> Agent Wise</option>
                      	</select>
                        </div>-->
			<label for="inputEmail3" class="col-sm-1 control-label"> Start Date </label>
                        <div class="col-sm-2">
                            <input type="text" name="start_date" id ="start_date" value="" onClick="displayDatePicker('start_date');" class="form-control" required>
                        </div>
			<label for="inputEmail3" class="col-sm-1 control-label"> End Date </label>
                        <div class="col-sm-2">
                            <input type="text" name="end_date" value="" id ="end_date" onClick="displayDatePicker('end_date');" class="form-control" required>
                        </div>
                    </div>
					
                    <div class="form-group">
                        
                        
			<label for="inputEmail3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-2">
                            <input type="button" name ="Submit" value = "Export" class="btn btn-info" onClick="ExportData1();">
                        </div>
                    </div>
                </div><!-- /.box-body -->
                  <!-- /.box-footer -->
                </form>
              </div><!-- /.box -->
          </div>
      </div>
</body>
</html>