<?php
require_once ('header.php');
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>All Mails</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
     
    <p class="login-box-msg">
      <?php
	   
		 if(!empty($_GET['login'])){
			  if($_GET['login'] == 'false')
			  {
				   echo 'Please check your login details.'; 
			  }
		}
  	?>
    
    </p>

    <form action="pages/chk_login.php" method="post" class="loginform">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="lgoinbxemail" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="loginbxpassword" placeholder="Password" required>
        <input type="hidden" name="fromlogin" value="1">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat" id="loginbtn">Sign In</button>
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
    <!--<a href="#">I forgot my password</a><br>-->
    <a href="index.php" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<div class="usersignupbox" id="userpopup" data-popup="popup-1">
 
 <div class="popup-inner">
 
  <form action="pages/chk_login.php" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="lgoinbxemail" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="loginbxpassword" placeholder="Password" required>
        <input type="hidden" name="fromlogin" value="1">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form> 
   
 <a class="popup-close" id="userpopupclose" data-popup-close="popup-1" href="#">x</a>
 </div><!-- popup-inner ends here -->
 
</div><!-- usersignupbox ends here --> 

<?php
require_once ('footer.php');
?>