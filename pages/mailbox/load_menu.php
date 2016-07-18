<?php
require_once ('../../db.php');

 session_start();
$conn = mysqli_connect($dbhost, $dbuser, $dbpassword,$dbname);
		
		 	 $sql_account_list = 'SELECT * FROM `ama_user_mapped_accounts` where `user_id`='.$_SESSION['user_id'].' and account_status=1';
			 $selectresult = $conn->query($sql_account_list); 
		
		$menu_list=""; 
		 
		if ($selectresult->num_rows > 0) {
		// output data of each row
		while($row = $selectresult->fetch_assoc()) {
			$active_class="";
			if($row["id"]==$_SESSION['account_id']){
				$active_class=" active";
			}
			 
		
			$sql_menu_list = 'SELECT * FROM `ama_mail_type` where `host_id`='.$row["host_id"].' and active_status=1 order by list_order asc';
			$selectMenus = $conn->query($sql_menu_list);
			
		$menu_list .='<li class="treeview '.$active_class.'"><a href="#"><i class="fa fa-envelope"></i><span>'.$row["n_account_email"].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a><ul class="treeview-menu">';
			 
		while($menu_row = $selectMenus->fetch_assoc()) {
			$active_class_in = "";
			if($menu_row["id"]==$_SESSION['mail_type_id']){
				$active_class_in=" active";
			}
						
		$menu_list .= '<li class="'.$active_class_in.'" ><a href="javascript:load_email_list('.$row["id"].','.$menu_row["id"].')">'.$menu_row["mail_type_name"].'</a></li>';	
		
		}
		
		$menu_list .= "</ul></li>";
		
		
			} // $selectresult While End			
		} // $selectresult If End
		$conn->close(); 
 		echo $menu_list;
		exit;
      
?>