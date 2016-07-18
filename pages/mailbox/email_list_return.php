<?php

require_once ('../../db.php');

session_start();

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword,$dbname);
$hostname = "";
$username="";
$password="";
$sql_account_details = 'SELECT h1.imap_url,h1.host_name, a1.n_account_email, a1.n_account_password,m1.param_val FROM `ama_host_list` as h1 inner join `ama_user_mapped_accounts` as a1 on h1.id=a1.host_id inner join `ama_mail_type` as m1 on m1.host_id= a1.host_id where a1.id='.$_POST["account_id"].' and a1.account_status=1 and m1.id='.$_POST["mail_type"].'';
$selectresult = $conn->query($sql_account_details); 
 
 
 $_SESSION['mail_type_id'] = $_POST["mail_type"];
 $_SESSION['account_id'] = $_POST["account_id"];
if ($selectresult->num_rows > 0) {
		// output data of each row
		while($row = $selectresult->fetch_assoc()) {
			$hostname = "{".$row["imap_url"]."}".$row["param_val"]."";
			$username=$row["n_account_email"];
			$password=$row["n_account_password"];
			$real_host_name = $row["host_name"];
		}
}
$conn->close();

$imap = imap_open($hostname,$username,$password,NULL,1) or die('Cannot connect to '.$real_host_name.': ' . print_r(imap_errors()));
$allemails = imap_search($imap,'All'); 
$alloutput ='';
$numMessages = imap_num_msg($imap);
 		 if($allemails){
			 	for ($i = $numMessages; $i > ($numMessages - 20); $i--) {
					$header = imap_header($imap, $i);
				
					$fromInfo = $header->from[0];
					$replyInfo = $header->reply_to[0];
				
					$details = array(
						"fromAddr" => (isset($fromInfo->mailbox) && isset($fromInfo->host))
							? $fromInfo->mailbox . "@" . $fromInfo->host : "",
						"fromName" => (isset($fromInfo->personal))
							? $fromInfo->personal : "",
						"replyAddr" => (isset($replyInfo->mailbox) && isset($replyInfo->host))
							? $replyInfo->mailbox . "@" . $replyInfo->host : "",
						"replyName" => (isset($replyTo->personal))
							? $replyto->personal : "",
						"subject" => (isset($header->subject))
							? $header->subject : "",
						"date" => (isset($header->date))
							? $header->date : ""
					);
					
				 		  date_default_timezone_set('Asia/Kolkata');
					  $date = $details["date"];
	                  $month = substr(date('F', strtotime($date)), 0,3);
		              $day = date('d', strtotime($date));
					$uid = imap_uid($imap, $i);
				
					$alloutput .= "<tr>";
					$alloutput .= "<td><input type='checkbox'></td><td class='mailbox-name'>" . $details["fromName"];
					$alloutput .= "</td>";
					$alloutput .= "<td class='mailbox-subject'>" . $details["subject"] . "</td>";
					$alloutput .= "<td class='mailbox-date'>".$month .' '.$day."</td>";
					//$alloutput .= '<td><a href="mail.php?folder=&uid=' . $uid . '&func=read">Read</a>';
					//$alloutput .= " | ";
					//$alloutput .= '<a href="mail.php?folder=&uid=' . $uid . '&func=delete">Delete</a></td>';
					$alloutput .= "</tr>";
					
					if($i<=1)
						 break;	
				}
				/*  foreach($allemails as $allmail) {
    
                 	  $headerInfo = imap_headerinfo($inbox,$allmail);				 
					  date_default_timezone_set('Asia/Kolkata');			 
					  $date = $headerInfo->date;
	                  $month = substr(date('F', strtotime($date)), 0,3);
		              $day = date('d', strtotime($date));
					  
     
                 $alloutput .="<tr><td><input type='checkbox'></td><td class='mailbox-star'><a href='#'><i class='fa fa-star text-yellow'></i></a></td><td class='mailbox-name'><a href='#'>".$headerInfo->fromaddress."</a></td><td class='mailbox-subject'><b>".$headerInfo->subject."</b></td> <td class='mailbox-date'>".$month .' '.$day."</td></tr>";
  
				  } */
				  
				  
		}else {
			$alloutput = 'No emails found!';
		}  
		imap_close($imap);
				  echo $alloutput;
				exit;		 
				 
				 
?>			  