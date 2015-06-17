<?php

require 'vendor/autoload.php';
$lib = new \Vimeo\Vimeo($CLIENT_ID, $CLIENT_SECRET);
$content .= '
		<h3>Step 1 of 4: Authentication Required</h3>
';

//user logged into vimeo account but chose to not accept scopes required for uploader tool to work
if(isset($_GET['error'])){
	$content .= '
		<p class="error">'.$_GET['error'].'</p>
	';
}
//user logged into vimeo account and has accepted scopes
//more error handling should be built in in case user accepts scopes but alters GET parameters, for example
else if(isset($_GET['code']) && isset($_GET['redirect_uri']) && $_GET['redirect_uri'] == $REDIRECT_URI){

	$token = $lib->accessToken($code, $REDIRECT_URI);
	$lib->setToken($token->access_token);
	$_SESSION['authenticated'] = TRUE;
	header('Location: '.$REDIRECT_URI);
	exit;

}
//user first time here or some other uncaught type of error occured
else{

	$url = $lib->buildAuthorizationEndpoint($REDIRECT_URI, $SCOPES, $_SESSION['STATE']);
	$content .= '
		<p><a href="'.$url.'">LOG IN</a> to continue.</p>
	';

}

$content .= '<p><br><br><br><a href="'.$REDIRECT_URI.'?skip_auth=true">skip auth</a></p>';

?>