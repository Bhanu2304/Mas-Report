<?php 
session_start();
$sel_typeuser=mysql_fetch_array(mysql_query("select * from user_type where User_Type='".$_SESSION['SESS_TYPE']."'"));
$usr_chk=explode(',',$sel_typeuser['page_access']);

$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$page = $parts[count($parts) - 1];

?>

<?php
    $qry = mysql_query("select * from sub_header_master");
    $num=mysql_num_rows($qry);
    $data = mysql_fetch_array($qry);    
?>
  
<div class="top-menu">
    <nav>
        <ul class="menu">
		
                <?php if($_SESSION['SESS_TYPE']=='Admin')
                { ?>
                <li class="treeview"><a href="#"><span class="fa fa-edit"></span>User Management</a>
				<ul>
							<?php if(in_array(2,$usr_chk)) { ?>
							<li><a href="add-user.php"><i class="fa fa-circle-o"></i> Add User</a></li>
							<?php } ?><?php if(in_array(3,$usr_chk)) { ?>
                      		<li><a href="view-user.php"><i class="fa fa-circle-o"></i> View Users </a></li>
                             <?php } ?><?php if(in_array(4,$usr_chk)) { ?>
							
							<?php } ?>
                    </ul>
                </li>
               
				<li class="treeview"><a href="#"><span class="fa fa-edit"></span>Data Management</a>
				<ul>
							<?php  if(in_array(6,$usr_chk)) { ?>
							<li><a href="voc.php"><i class="fa fa-circle-o"></i>Voc Creation</a></li>
                                                       
							<?php } ?> 
                                                        
                    </ul>
                </li>
				
				<li class="treeview"><a href="#"><span class="fa fa-edit"></span>Report</a>
				<ul>
                                    <?php if(in_array(11,$usr_chk)) { ?>
                                    <li><a href="report.php"><i class="fa fa-circle-o"></i>Data Report&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                    <li><a href="apr-report.php"><i class="fa fa-circle-o"></i>Apr Report&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                    
                                    <li><a href="Daily_unique.php"><i class="fa fa-circle-o"></i>Daily Mis Unique Complete</a></li>
                                      <li><a href="report-unique-app.php"><i class="fa fa-circle-o"></i>Daily Mis Unique Application </a></li>
                                       <li><a href="Attempte_wise.php"><i class="fa fa-circle-o"></i>Attemptwise Contact</a></li>
                                      <li><a href="Attempte_with_history.php"><i class="fa fa-circle-o"></i>Attempt Wise Previous history </a></li>
                                       <li><a href="Daily-multi.php"><i class="fa fa-circle-o"></i>Daily Mis Multiple Complete profile</a></li>
                                        <li><a href="Daily-multi-App.php"><i class="fa fa-circle-o"></i>Daily Mis Multiple Application </a></li>
                                         
                                         <li><a href="inboundgroup.php"><i class="fa fa-circle-o"></i>Inbound Group Report</a></li>
                                         <li><a href="VocReport.php"><i class="fa fa-circle-o"></i>Voc Report&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></li>
                                         <li><a href="call-back.php"><i class="fa fa-circle-o"></i>Call Back Report&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                         <li><a href="Inbound_voc.php"><i class="fa fa-circle-o"></i>Inbound Voc Report </a></li>
						 <li><a href="Daily-call-report.php"><i class="fa fa-circle-o"></i>Daily Calls Report </a></li>
						 <li><a href="Appled.php"><i class="fa fa-circle-o"></i>Applied data Report </a></li>
                                                 <li><a href="Doc_Close_Report.php"><i class="fa fa-circle-o"></i>Document Close Report </a></li>
                                                 <li><a href="student-data-sch.php"><i class="fa fa-circle-o"></i>Scholarship Wise Records </a></li>
                                                 <li><a href="report-unique.php"><i class="fa fa-circle-o"></i>Import Data Report </a></li>
                                                 <li><a href="report-profile-com.php"><i class="fa fa-circle-o"></i>Profile Complete Data </a></li> 
                                                 <li><a href="cdr_report.php"><i class="fa fa-circle-o"></i>CDR Report  </a></li> 

                                    <?php } ?>
                                </ul>
                                </li>
								
								<li class="treeview"><a href="#"><span class="fa fa-edit"></span>Rivigo</a>
				<ul>
							<li><a href="rivigo_report.php"><i class="fa fa-circle-o"></i>Rivigo Data</a></li>
                                                       
                                                        
                    </ul>
                </li>
                 <?php } else {  ?>
                	<li class="treeview"><a href="agent-login.php"><span class="fa fa-edit"></span>Outbound</a>
				
                </li>
                <li class="treeview"><a href="agent-inbound.php"><span class="fa fa-edit"></span>Inbound</a>
				
                </li>
                 <?php } ?>
				
   
        </ul>
        <div class="clearfix"></div>
        </nav>
</div>


<div class="add-sub-header">
    <?php if( isset($num) && $num > 0){?>
        <marquee direction="right"><span><?php echo $data[1];?></span></marquee>
    <?php }?>
</div>