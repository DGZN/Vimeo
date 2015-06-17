<?php

if(isset($_POST['meta_approved'])){
	$_SESSION['meta_approved'] = TRUE;
	header('Location: '.$REDIRECT_URI);
	exit;
}

$content .= '
			<h3>Step 3 of 4: Metadata Review/Edit</h3>
';

$csv = array();
if(isset($_SESSION['csv_file'])){
	$csv = array_map('str_getcsv', file($_SESSION['csv_file']));
	//iconv("UTF-8","UTF-8//IGNORE",$csv[8][2])
	//print_r($csv);
}

//map and clean up csv strings
$field['title'] = (isset($csv[6][2])) ? $csv[6][2] : '';
$field['category_type'] = (isset($csv[7][2])) ? strtolower($csv[7][2]) : '';
$field['asset_type'] = '';
$field['description'] = (isset($csv[8][2])) ? $csv[8][2] : '';
$field['year'] = (isset($csv[20][2])) ? $csv[20][2] : '';
$field['genre1'] = (isset($csv[9][2])) ? $csv[9][2] : '';
$field['genre2'] = (isset($csv[10][2])) ? $csv[10][2] : '';
$field['rating1'] = (isset($csv[11][2])) ? $csv[11][2] : '';
$field['rating2'] = (isset($csv[12][2])) ? $csv[12][2] : '';
$field['rating3'] = (isset($csv[13][2])) ? $csv[13][2] : '';
$field['rating4'] = (isset($csv[14][2])) ? $csv[14][2] : '';
$field['regions'] = (isset($csv[15][2])) ? $csv[15][2] : '';
$field['countries'] = (isset($csv[16][2])) ? $csv[16][2] : '';
$field['price_rent'] = (isset($csv[24][2])) ? $csv[24][2] : '';
$field['rent_period'] = (isset($csv[26][2])) ? $csv[26][2] : '';

$content .= '

			<form action="'.$REDIRECT_URI.'" method="post">
				<fieldset>
					<legend>General</legend>
					<label for="title">Title</label>
						<input id="title" type="text" value="'.$field['title'].'">
					<label for="category_type">Category Type</label>
						<select id="category_type">
							<option value="Film"'.((($field['category_type']) == 'film')? 'selected="selected"' : '').'>Film</option>
							<option value="Series"'.((($field['category_type']) == 'series')? 'selected="selected"' : '').'>Series</option>
						</select>
					<label for="asset_type">Asset Type</label>
						<select id="asset_type">
							<option value="main">Main</option>
							<option value="trailer">Trailer</option>
							<option value="extra">Extra</option>
						</select>
					<label for="description">Description</label>
						<textarea id="description" cols="10" rows="5">'.$field['description'].'</textarea>
					<label for="year">Release Year</label>
						<input id="year" type="text" value="'.$field['year'].'">
				</fieldset>
				
				<fieldset>
					<legend>Distribution</legend>
					<label for="regions">Regions</label>
						<input id="regions" type="text" value="'.$field['regions'].'">
					<label for="countries">Countries</label>
						<input id="countries" type="text" value="'.$field['countries'].'">
					<label for="price_rent">Rental Price (USD)</label>
						<input id="price_rent" type="text" value="'.$field['price_rent'].'">
					<label for="price_rent">Rental Period (Days)</label>
						<input id="rent_period" type="text" value="'.$field['rent_period'].'">
				</fieldset>
				
				<fieldset>
					<legend>Content Ratings</legend>
					<label for="rating1">Rating 1</label>
						<input id="rating1" type="text" value="'.$field['rating1'].'">
					<label for="rating2">Rating 2</label>
						<input id="rating2" type="text" value="'.$field['rating2'].'">
					<label for="rating3">Rating 3</label>
						<input id="rating3" type="text" value="'.$field['rating3'].'">
					<label for="rating4">Rating 4</label>
						<input id="rating4" type="text" value="'.$field['rating4'].'">
				</fieldset>

				<fieldset>
					<legend>Genres</legend>
					<label for="genre1">Genre 1</label>
						<input id="genre1" type="text" value="'.$field['genre1'].'">
					<label for="genre2">Genre 2</label>
						<input id="genre2" type="text" value="'.$field['genre2'].'">
				</fieldset>

				<br>
				<button class="standalone" type="submit" value="1" name="meta_approved">Continue</button>
			</form>
';

?>