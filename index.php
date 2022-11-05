<?php 

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include("include/connection.php");
include("include/function.php");
session_start();

// username and password sent from form 



// date("Y-m-d","23-Oct-2015");



// To protect MySQL injection (more detail about MySQL injection)



if($_POST['Login']!='')
 {
    $myusername=trim($_POST['frmname']); 
$mypassword=trim($_POST['frmPassword']); 
$ipAddress = $_SERVER['REMOTE_ADDR'];
$myusername = addslashes($myusername);
$mypassword = addslashes($mypassword);

	$qry="SELECT * FROM tbl_user WHERE user='$myusername' AND pass='$mypassword'";
	$result=mysqli_query($con,$qry);

		if(mysqli_num_rows($result) > 0) 
	    {    
			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_ID']       = $member['id'];
			$_SESSION['SESS_TYPE']     = $member['UserType'];
			$_SESSION['SESS_NAME']     = $member['user'];
			
			$flag = false;
			$msg = '';
			
			header("location: home.php");
			
		} 
		else 
		{
    	header("location: index.php?msg=unsucc");
		}
		
 }
?>

<?php
$qry = mysqli_query($con,"select * from background_image_master where status='1'");
$imgdata = mysqli_fetch_array($qry);
?>
<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8"/>
	<title><?php echo $title;?></title>
    <?php include("element/css_js.php"); ?>
</head>
<body class="hold-transition" >
    <div class="main-wrap">
        <div class="top-header">
            <div class="header-left-logo">
                
                <span class="h-text" >
                    
                    
                   
                </span>	
            </div>
        </div>
        <div class="main-content">
            <div class="content-hed-text"><marquee direction="right" style="width:725px;" ><span class="lgo">Welcome To Mas Callnet</span></marquee>
</div>
            <div class="left-div">
                <div class="lrdiv-header">
                    <div class="lrdiv-logo">
                        
                        <span class="lr-text" >MAS CALLNET</span>	
                    </div>
                    
                </div>
            </div>
            <div class="right-div">
                <div class="lrdiv-header">
                    <div class="lrdiv-logo">
                        <span class="lr-text" >Login Panel</span>	
                    </div>
                    <div class="login-form">
                        
                        <!--
                        <img class="login-img-logo" src="bgimg/white-logo.png" style="background-color: green">
				-->		
                        <?php if($_GET['msg']=='unsucc') { ?>
                            <div style="margin-left: 70px;color:red;margin-bottom:5px;">Invalid user name or password.</div>
                        <?php } ?>
                        <form name="frm" method="post" action="" class="form-horizontal login-form-class" >                         
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="frmname" value="" class="form-control" placeholder="User Name" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" placeholder="Password" name="frmPassword" value="" >
                                </div>
                            </div>
                            
                            

                            <input type="submit" value="Login" name="Login"  class="btn btn-info btn-class">
                            <input type="reset"  name ="reset"  value = "Reset"  class="btn btn-info btn-next-class">
                             
                        </form>
                        <div class="hr-line" ><hr></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' 
        });
      });
    </script>
</body>
</html>
