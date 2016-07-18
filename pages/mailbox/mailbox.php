<?php
 session_start();
 
 
require_once ('header.php');
require_once ('../../db.php');

 

 
 if(!isset($_SESSION['user_id'])){
	 
 	 header('Location: ../../login.php?chk_login=invalid');	
	 exit;
 } 
  
  // Create connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpassword,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 
 
  $sql_select = "select * from `amp_users_information` where `user_id`='".$_SESSION['user_id']."'";
  $selected_record = $conn->query($sql_select);
  
     $userinfo = array();
	if ($selected_record->num_rows > 0) {
       while($row = $selected_record->fetch_assoc()) {
		   $user_firstname = $row['user_firstname']; 
		   $user_email = $row['user_email']; 
 	   }
	}
	 
	  
 ?> 
<body class="hold-transition skin-blue sidebar-mini">	
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>All Mails</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>All Mails</b> </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    
 
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
	 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
          
        
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/avatar.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs initacap">
			  <?php echo $user_firstname; ?>
			  </span>
            </a>
            
          	
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/avatar.jpg" class="img-circle" alt="User Image">

                <p>
                 <?php  echo $user_firstname;  ?> 
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                  
                   <a href="#" id="add_more_accounts">Add Accounts</a> 
                    
                  
                  </div>                  
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo $base_url ?>logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  
 
   
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/avatar.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info initacap">
          <p><?php 		   
			    echo $user_firstname; 		  
		  ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->      	
        <ul class="sidebar-menu" id="menu_list"></ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mailbox
        <small>new messages</small>
      </h1>
      <ol class="breadcrumb">
       
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
    
       
       
         <li>  <?php 
		 
		       if(!isset($_GET['code']))
			   {
		     require_once ('gmail_authendicate_link.php'); 
			 
			   }?> </li>
         
         
      </ol>
       
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
       
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
               
              </div>
              <div class="table-responsive mailbox-messages">
                <?php /*<table class="table table-hover table-striped">
                  <tbody id="mail_list"> 
                  </tbody>
                </table>
                <!-- /.table --> */ ?>
                
				<?php 
				
				//echo 'userid=='.$_SESSION['user_id']; 
				
				 
				// require_once ('gmail_authendicated_allmails.php');
				
				?>
                
				
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
              
				
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    
    <strong>Copyright &copy; 2016-2017</strong> All rights reserved.
  </footer>
 
</div>
<!-- ./wrapper -->
 
 
 
<?php
$conn->close();
require_once ('footer.php');
?>