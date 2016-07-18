<?php
session_start(); //session start

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

      <?php /* <a href="<?php echo $authUrl; ?>" class="newlink">Link Account</a>  */ ?>
     
     
   <a href="javascript:poptastic('<?php echo $authUrl; ?>');">Link Account</a>
      
<?php } ?>

<script>

	  
  function poptastic(url) {
	  //url="return_gmail.php";
      var newWindow = window.open(url, 'name', 'height=550,width=1200');
      if (window.focus) {
        newWindow.focus();
		 
		 
      }
	  
	  
    }
</script>