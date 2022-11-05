<?php
include("include/connection.php");
include("include/session-check.php");

$DelId = $_GET['DelId'];
$ActId = $_GET['ActId'];
$msg   = $_GET['msg'];

if($DelId!='')
{
    $Update = "update user_master set UserStatus='0',DeactiveDate=now() where UserId='$DelId'";
    $Query  = mysql_query($Update);
    if($Query!='')
    {
     header("location: view-user.php?msg=Deactive");
    }
}
if($ActId!='')
{
    $Update = "update user_master set UserStatus='1' where UserId='$ActId'";
    $Query  = mysql_query($Update);
    if($Query!='')
    {
        header("location: view-user.php?msg=Active");
    }
}

?>
<!doctype html>
<html lang="en">
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
		        <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"> Details </h3>
                </div><!-- /.box-header -->
                <!-- form start -->                
                  <div class="box-body">
			<table class="table table-hover"> 
			<thead> 
				<tr> 
				    <th>User Id</th>
					<th>Display Name</th>
    				<th>User Name</th> 
					<th>Password</th> 
    				<th>User Type</th>
					<th>Area</th> 
    				<th>Created On</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
			 <?php 
			  $Select = "select * from user_master where UserStatus='1'";
			  $Query  = mysql_query($Select);

			  while($Data = mysql_fetch_array($Query))
			  {
			 ?> 
				<tr> 
				    <td><?php echo $Data['UserId'];?></td>
					<td><?php echo $Data['DisplayName'];?></td>
    				<td><?php echo $Data['UserName'];?></td> 
					<td><?php echo $Data['Password'];?></td> 
    				<td><?php echo $Data['UserType'];?></td> 
					<td><?php echo $Data['Area'];?></td>
    				<td><?php echo $Data['CreateDate'];?></td> 
    				<td><a href="view-user.php?DelId=<?php echo $Data['UserId'];?>">Deactive</a></td> 
				</tr> 
			  <?php } ?>
			</tbody> 
			</table>

                  </div><!-- /.box-body -->
         	</div><!-- /.box -->
			
			
	</div> 
         </div>
</body>
</html>
