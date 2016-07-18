<?php 
 
require_once ('../db.php');
 
  session_start();
  
if(isset($_POST['submit'])){

// Create connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpassword,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['fromlogin']))
{ 
	  $lgoinbxemail = $_POST['lgoinbxemail'];
	  $loginbxpassword =$_POST['loginbxpassword'];
	  
	  $sql_select = "select * from `amp_users_information` where `user_email`='".$lgoinbxemail."'";
	  $selected_record = $conn->query($sql_select);
	 
	   if ($selected_record->num_rows > 0) {
          while($row = $selected_record->fetch_assoc()) {
	  
	        if($lgoinbxemail == $row['user_email'] && $loginbxpassword == $row['user_password']){
			  
			   $_SESSION['user_id'] = $row['user_id'];
			     			   
			   header('Location: '.$base_url.'pages/mailbox/mailbox.php');
			   exit;
			   
		      }else{
				  
				header('Location: '.$base_url.'login.php?login=false');
			    exit;
			}
		  
	}
}	 
	  
	
	 
}else{
	
	$user_firstname = $_POST['firstname'];
	$user_email = $_POST['lgoinbxemail'];
	$user_password = $_POST['loginbxpassword'];
	$user_registered_date = date('Y-m-d H:i:s');
	
	
	
	
	 $sql_select = "select * from `amp_users_information` where `user_email`='".$user_email."'";
	 $selected_record = $conn->query($sql_select);
 
	 
	 
	 if ($selected_record->num_rows > 0) { 
		  
			  	header('Location: '.$base_url.'?e=1');
				exit;
			  
		 
			  
			}else{
				$sql_user_insert = "insert into `amp_users_information`(`user_firstname`, `user_email`, `user_password`,`user_registered_date`) values ('".$user_firstname."','".$user_email."','".$user_password."','".$user_registered_date."')";
		 	
			  $selected_record = $conn->query($sql_user_insert);
 			  $user_id = $conn->insert_id;
			  
			    $_SESSION['first_name'] = $user_firstname;
				  $_SESSION['user_id'] = $user_id;
				  
				  
			 header('Location: '.$base_url.'pages/mailbox/mailbox.php');
			   exit;
			
			}
	  
 
 
}

}
?>
