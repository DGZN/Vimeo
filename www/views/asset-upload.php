<?php

	$content .= '
			<h3>Step 4 of 4: Asset Upload</h3>
			
			<form action="'.$REDIRECT_URI.'" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Asset Uploads</legend>
					<label for="file_asset">Select video or image file to upload:</label>
					<input type="file" name="file_asset" id="file_asset">
					<button type="submit" value="1" name="asset_upload">Upload</button>
				</fieldset>
			</form>
	';
?>