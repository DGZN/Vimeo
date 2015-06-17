<?php

/* GIANT CREDENTIALS */
$CLIENT_ID = '';
$CLIENT_SECRET = '';

/* VIMEO SETUP */
$REDIRECT_URI = 'http://www.bomberwebdevelopment.com/vimeo/';
$SCOPES = 'public private purchased create edit delete interact upload';
$_SESSION['STATE'] = (isset($_SESSION['STATE'])) ? $_SESSION['STATE'] : substr(md5(rand()), 0, 21);

/* UPLOADS SETUP */
$TARGET_DIR = 'uploads_csv/';

?>