<?php
session_start(); //session start

require_once ('header.php');
require_once ('../../db.php');

  // Create connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpassword,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 
  
require_once ('../../libraries/Google/autoload.php');
require_once ('../../libraries/Google/Client.php');
require_once ('../../libraries/Google/Service/Plus.php');
require_once ('../../libraries/Google/Service/Gmail.php');


//Insert your cient ID and secret 
//You can get it from : https://console.developers.google.com/

$client_id = '957942568921-452abmki4jvt9b41d54lcb44d99fgqt1.apps.googleusercontent.com'; 
$client_secret = 'I8mZaYXG2u9Wuvw9G3wvsG3b';
$redirect_uri = 'http://localhost:8771/newmails/pages/mailbox/return_gmail.php';

  

//incase of logout request, just unset the session var
if (isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
}

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setAccessType('offline');
$client->setApprovalPrompt('force');
$client->addScope("email");
$client->addScope("profile");
$client->addScope('https://mail.google.com');
$client->setScopes('https://www.googleapis.com/auth/userinfo.email');
$client->setIncludeGrantedScopes(true);
$client->revokeToken();



/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
 
$service = new Google_Service_Oauth2($client);

$servicegmail = new Google_Service_Gmail($client);

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
*/


 
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
 
  $_SESSION['access_token'] = $client->getAccessToken();
 header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;  
}
 


/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

if (isset($authUrl)){ ?>
  
 <?php /* <a href="<?php echo $authUrl; ?>" class="newlink">Link Account</a>*/ ?>  
  <?php }  else {  ?>
  
  
 <div class="returngmailcls">
 <?php
   $user = $service->userinfo->get(); //get user info 
    
  $userId = $user->id;
  $userEmail = $user->email;
  
   $sql_select = "select * from `users_gmail_accountinfo` where `user_gmail_email`='".$userEmail."'";
  $selected_record = $conn->query($sql_select);
  
   if ($selected_record->num_rows > 0) {  
   
   
    echo 'Go back by clicking below close button </br></br>';
      ?>
		  
		 <button type="button" name="submit" id="retunrbtn" onclick="RefreshParent();">Close</button>
			  
			<?php }else{
				
  $sql_user_insert = "insert into `users_gmail_accountinfo`(`user_gmail_id`, `user_gmail_email`) values ('".$userId."','".$userEmail."')";
		 	
  $selected_record = $conn->query($sql_user_insert);
  
  echo 'Go back by clicking below close button </br></br>';  ?>
  
  <button type="button" name="submit" id="retunrbtn" onclick="RefreshParent();">Close</button>
  
	<?php   }
	  
   }?>

</div>


 
 
 <script type="text/javascript">
        function RefreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
				 window.close();
            }
        }
       
		
</script>
<style>
body{
   background: #d2d6de;	
}
.returngmailcls{
	width:400px;
	margin:0 auto;
	padding: 100px 20px;
    font-size: 18px;
}
#retunrbtn{
    background-color: #3c8dbc;
    border-color: #367fa9; 
	padding:7px 15px;
	color:#fff;
	border:none;
}

</style>