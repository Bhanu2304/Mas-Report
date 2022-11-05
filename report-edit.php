<?php
include("include/connection.php");
include("include/session-check.php");

$DelId = $_GET['DelId'];
$tbl_name = $_POST['tbl_name'];
$status = $_POST['status'];

$msg      = $_POST['msg'];

if(!empty($_POST))
{
    $DelId = $_GET['DelId'];
    $Select = "select report_name from tbl_report where report_name='$tbl_name'";
    $Select_Query = mysqli_query($con,$Select);
    $Select_Res = mysqli_fetch_row($Select_Query); 


        if($Select_Res[0]=='')
        {
             $Ins = "update  tbl_report set  report_name='$tbl_name',active='$status' where id='$DelId'"; 
            $Ins_Query = mysqli_query($con,$Ins);

            if($Ins_Query!='')
            {
                header("location: report-edit.php?msg=succ&DelId=".$DelId);
            }
            else
            {
                header("location: report-edit.php?msg=unsucc&DelId=".$DelId);
            }
        }
        else
        {
            header("location: report-edit.php?msg=match&DelId=".$DelId);
        }
    
}

 $Select = "select * from tbl_report where id='$DelId'  limit 1"; 
$Query  = mysqli_query($con,$Select);
$data2 = mysqli_fetch_assoc($Query);

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
	<!-- end of secondary bar -->
	<?php include("element/menu.php"); ?>
	<!-- end of sidebar -->
      <div class="content-wrapper bgimg">

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Edit Report<small></small></h1>
        </section>
		        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">
			 <?php if($msg=='match') { ?><h4 class="alert_error">Report Name Allready Exists</h4><?php } ?>
			 <?php if($msg=='succ') { ?><h4 class="alert_success">Report Updated Successfuly</h4><?php } ?>
			 <?php if($msg=='unsucc') { ?><h4 class="alert_error">Report Not Save</h4><?php } ?>
                         <?php if($msg=='notable') { ?><h4 class="alert_error">Report Not Exist in DB Vicidial</h4><?php } ?>
				  </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="frmuser" method="post"  >
                  <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputPassword1"> Report Name <font color="red">*</font></label>
                      <input name="tbl_name"   type="text" class="form-control" value="<?php echo $data2['report_name']; ?>" id="tbl_name" placeholder="Report Name" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Status <font color="red">*</font></label>
                        <select name="status" class="form-control" id="status" required="">
                            <option value="1" <?php if($data2['active']=='1'){ echo 'selected';} ?>>Active</option>
                            <option value="0" <?php if($data2['active']=='0'){ echo 'selected';} ?>>De-Active</option>
                        </select>
                      
                    </div>
                    
                    
			

                    
                  </div><!-- /.box-body -->


                  <div class="box-footer">
                      <input type="hidden" name="DelId" value="<?php echo $DelId; ?>" required="" />
                    <input type="submit" name="Submit" value="Update" class="btn btn-primary">
                    <a href="report-create.php" class="btn btn-primary">Back</a>
                  </div>
                </form>
              </div><!-- /.box -->
              

			  </div>
			 </div>   <!-- /.row -->
        </section><!-- /.content -->  
		<div class="control-sidebar-bg"></div>
		
	</div>
</body>
</html>
<?php include("element/footer.php"); ?>