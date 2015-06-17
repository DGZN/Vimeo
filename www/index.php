<?php

session_start();
require 'config.php';
$content = NULL;

//start controller type stuff -> all views load the $content variable to output below after logic completed

//log out user
if(isset($_GET['logout'])) include 'views/logout.php';

//temporary bypass ability until upload aproval received
else if(isset($_GET['skip_auth'])){
	$_SESSION['authenticated'] = TRUE;
	header('Location: '.$REDIRECT_URI);
	exit;
}

// step 1 : check if user has already authenticated with Vimeo
else if(!isset($_SESSION['authenticated'])) include 'views/authenticate.php';

//step 2 : user authenticated, so now need to upload CSV or go to form to manually upload
else if(!isset($_SESSION['csv_complete'])) include 'views/metadata-upload.php';

//step 3 : user authenticated, so now need to upload CSV or go to form to manually upload
else if(!isset($_SESSION['meta_approved'])) include 'views/metadata-review.php';

//step 3 : user authenticated, so now need to upload CSV or go to form to manually upload
else include 'views/asset-upload.php';



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Vimeo Upload Tool</title>
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="shortcut icon" href="assets/images/favicon.ico">
	</head>

	<body>
		<section>
			<h1><img src="assets/images/logo_giant_interactive.png" alt="Giant Interactive"></h1>
			<h2>Vimeo Upload Tool</h2>
			<a id="logout" href="<?php echo $REDIRECT_URI; ?>?logout=true">LOGOUT</a>

<?php

echo $content;

?>

		</section>
	</body>

</html>
