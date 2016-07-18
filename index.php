<?php
require_once ('header.php');
require_once ('db.php');

// Create connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpassword,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>All Mails</b></a>
  </div>
  <div class="register-box-body">
      <p class="login-box-msg">Register a new membership</p>
    
    <p class="login-box-msg"><b>
    <?php
	   /* if(!empty($_GET['valemail'])){
			  if($_GET['valemail'] == 'true')
			  {
				   echo 'Email address already exist.'; 
			  }
		}*/
		
		 if(!empty($_GET['e'])){
			  if($_GET['e'] == '1')
			  {
				   echo 'Email address already exist.'; 
			  }
		}
	
	    
	 
	?>

     </b></p>     
     
    <form action="pages/chk_login.php" method="post" class="registerform">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="firstname" placeholder="First name" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="lgoinbxemail" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="loginbxpassword" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="loginbxrepassword" placeholder="Retype password" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      
     <?php /* <div class="form-group has-feedback">
         <select name="hostname" class="form-control" required>
         <?php
		 $sql_host_list = 'SELECT * FROM `ama_host_list` where `active_status`=1';
		 $selectresult = $conn->query($sql_host_list);
 		?>
         <option>Select Hostname</option> 
		 <?php
		if ($selectresult->num_rows > 0) {
		// output data of each row
		while($row = $selectresult->fetch_assoc()) {
			 ?>
			 <option value="<?php echo $row["id"]; ?>"><?php echo $row["host_name"]; ?></option>
			 <?php
			}
		}
		$conn->close();
		 ?> 
         </select>
      </div> */ ?>
      
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat" id="registerbtn">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    
    <?php /*
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat" id="gmailbtn"><i class="fa fa-google"></i> Sign up using gmail</a>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat" id="yahoobtn"><i class="fa fa-yahoo"></i> Sign up using yahoo</a>
    </div>
  */ ?>
    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
 
 
<?php
require_once ('footer.php');
?>