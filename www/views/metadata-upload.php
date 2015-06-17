<?php

$content .= '

		<h3>Step 2 of 4: Metadata Upload (optional)</h3>

';

//user chose to skip csv upload step
if(isset($_POST['csv_skip'])){
	$_SESSION['csv_complete'] = TRUE;
	header('Location: '.$REDIRECT_URI);
	exit;
}
//user uploaded file
else if(isset($_POST['csv_upload']) && isset($_FILES["file_csv"]["name"])){

	$target_file = $TARGET_DIR.basename($_FILES["file_csv"]["name"]);
	$file_type = pathinfo($target_file,PATHINFO_EXTENSION);
	if($file_type != 'csv'){
		$content .= '
		<p class="error">Only CSV files are accepted.</p>
		<a href="'.$REDIRECT_URI.'">RETRY</a>
		';
	}
	else if(file_exists($target_file)){
		$content .= '
		<p class="error">This file already has been uploaded.</p>
		<a href="'.$REDIRECT_URI.'">RETRY</a>
		';
	}
	else if(move_uploaded_file($_FILES['file_csv']['tmp_name'], $target_file)){
		$_SESSION['csv_file'] = $target_file;
		$_SESSION['csv_complete'] = TRUE;
		header('Location: '.$REDIRECT_URI);
		exit;
	}
	else{
		$content .= '
		<p class="error">There was a system error and the file could not be uploaded.</p>
		<a href="'.$REDIRECT_URI.'">RETRY</a>
			';
	}

}
//first time to this view
else {

$content .= '

		<form action="'.$REDIRECT_URI.'" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>CSV Upload (optional)</legend>
				<label for="file_csv">Select CSV file to upload:</label>
				<input type="file" name="file_csv" id="file_csv">
				<button type="submit" value="1" name="csv_upload">Upload</button>
				<button type="submit" value="1" name="csv_skip">Populate Manually</button>
			</fieldset>
		</form>
';

}





?>