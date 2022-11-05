<?php
include("include/connection.php");
include("include/session-check.php");

$tbl_name = $_POST['tbl_name'];
$UserName = $_POST['UserName'];
$Password = $_POST['Password'];
$DisplayName = $_POST['DisplayName'];
$cont_no = $_POST['cont_no'];
$Area	 = $_POST['Area'];
$msg      = $_GET['msg'];

if($_POST['Submit']!='')
{
    $Select = "select report_name from tbl_report where report_name='$tbl_name'";
    $Select_Query = mysqli_query($con,$Select);
    $Select_Res = mysqli_fetch_row($Select_Query); 
    
	
      
    if($Select_Res[0]=='')
    {
        $Ins = "insert into tbl_report set report_name='$tbl_name'";
        $Ins_Query = mysqli_query($con,$Ins);

        if($Ins_Query!='')
        {
            header("location: report-create.php?msg=succ");
        }
        else
        {
            header("location: report-create.php?msg=unsucc");
        }
    }
    else
    {
        header("location: report-create.php?msg=match");
    }
    
}



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
          <h1>Create Report<small></small></h1>
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
			 <?php if($msg=='succ') { ?><h4 class="alert_success">Report Added Successfuly</h4><?php } ?>
			 <?php if($msg=='unsucc') { ?><h4 class="alert_error">Report Not Save</h4><?php } ?>
                         
				  </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="frmuser" method="post"  >
                  <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputPassword1"> Report Name <font color="red">*</font></label>
                      <input name="tbl_name" value=""  type="text" class="form-control" id="tbl_name" placeholder="Report Name" required="">
                    </div>
                    
                    
                    
			

                    
                  </div><!-- /.box-body -->


                  <div class="box-footer">
                    <input type="submit" name="Submit" value="Save" class="btn btn-primary">
                  </div>
                </form>
              </div><!-- /.box -->
              <div class="box-body">
			<table class="table table-hover"> 
			<thead> 
				<tr> 
				<th>Sr No.</th>
				<th>Report Name</th>
                                <th>Action</th>
				</tr> 
			</thead> 
			<tbody> 
			 <?php 
			  $Select = "select * from tbl_report where active='1'";
			  $Query  = mysqli_query($con,$Select);
                          $srno =1;
			  while($Data = mysqli_fetch_array($Query))
			  {
			 ?> 
				<tr> 
				    <td><?php echo $srno++;?></td>
					<td><?php echo $Data['report_name'];?></td>
    				<td><a href="report-edit.php?DelId=<?php echo $Data['id'];?>">edit</a></td> 
				</tr> 
			  <?php } ?>
			</tbody> 
			</table>

                  </div><!-- /.box-body -->

			  </div>
			 </div>   <!-- /.row -->
        </section><!-- /.content -->  
		<div class="control-sidebar-bg"></div>
		
	</div>
</body>
</html>
<?php include("element/footer.php"); ?>