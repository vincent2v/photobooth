<?php

require_once('lib/config.php');
require_once('lib/db.php');

// Check if there is a request for the status of the database
if (isset($_GET['status'])){
	// Request for DB-Status,
	// Currently reports back the DB-Size to give the Client the ability
	// to detect changes
	$resp = array('dbsize'=>getDBSize());
	exit(json_encode($resp));
}

$images = getImagesFromDB();
$imagelist = ($config['newest_first'] === true) ? array_reverse($images) : $images;
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	<meta name="msapplication-TileColor" content="<?=$config['colors']['primary']?>">
	<meta name="theme-color" content="<?=$config['colors']['primary']?>">

	<title>Photobooth Gallery</title>

	<!-- Favicon + Android/iPhone Icons -->
	<link rel="apple-touch-icon" sizes="180x180" href="resources/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="resources/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="resources/img/favicon-16x16.png">
	<link rel="manifest" href="resources/img/site.webmanifest">
	<link rel="mask-icon" href="resources/img/safari-pinned-tab.svg" color="#5bbad5">

	<!-- Fullscreen Mode on old iOS-Devices when starting photobooth from homescreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />

	<link rel="stylesheet" href="node_modules/normalize.css/normalize.css" />
	<link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="vendor/PhotoSwipe/dist/photoswipe.css" />
	<link rel="stylesheet" href="vendor/PhotoSwipe/dist/default-skin/default-skin.css" />
	<link rel="stylesheet" href="resources/css/style.css" />
	<?php if ($config['gallery_bottom_bar']): ?>
	<link rel="stylesheet" href="resources/css/photoswipe-bottom.css" />
	<?php endif; ?>
	<?php if ($config['rounded_corners']): ?>
	<link rel="stylesheet" href="resources/css/rounded.css" />
	<?php endif; ?>
</head>

<body class="deselect">
	<div id="wrapper">
		<?php include('template/gallery.template.php'); ?>
	</div>

	<?php include('template/pswp.template.php'); ?>

	<div class="send-mail">
		<i class="fa fa-times" id="send-mail-close"></i>
		<p data-i18n="insertMail"></p>
		<form id="send-mail-form" style="margin: 0;">
			<input class="mail-form-input" size="35" type="email" name="sendTo">
			<input id="mail-form-image" type="hidden" name="image" value="">

			<?php if ($config['send_all_later']): ?>
				<input type="checkbox" id="mail-form-send-link" name="send-link" value="yes">
				<label data-i18n="sendAllMail" for="mail-form-send-link"></label>
			<?php endif; ?>

			<button class="mail-form-input btn" name="submit" type="submit" value="Send"><span data-i18n="send"></span></button>
		</form>

		<div id="mail-form-message" style="max-width: 75%"></div>
	</div>

	<div class="modal" id="print_mesg">
		<div class="modal__body"><span data-i18n="printing"></span></div>
	</div>

	<div id="adminsettings">
		<div style="position:absolute; bottom:0; right:0;">
			<img src="resources/img/spacer.png" alt="adminsettings" ondblclick="adminsettings()" />
		</div>
	</div>

	<script src="node_modules/whatwg-fetch/dist/fetch.umd.js"></script>
	<script type="text/javascript" src="api/config.php"></script>
	<script type="text/javascript" src="resources/js/adminshortcut.js"></script>
	<script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="vendor/PhotoSwipe/dist/photoswipe.min.js"></script>
	<script type="text/javascript" src="vendor/PhotoSwipe/dist/photoswipe-ui-default.min.js"></script>
	<script type="text/javascript" src="resources/js/photoinit.js"></script>
	<script type="text/javascript" src="resources/js/theme.js"></script>
	<script type="text/javascript" src="resources/js/core.js"></script>
	<script type="text/javascript" src="resources/js/gallery.js"></script>
	<?php if ($config['gallery_db_check_enabled']): ?>
	<script type="text/javascript" src="resources/js/gallery_updatecheck.js"></script>
	<?php endif; ?>
	<script src="node_modules/@andreasremdt/simple-translator/dist/umd/translator.min.js"></script>
	<script type="text/javascript" src="resources/js/i18n.js"></script>
</body>
</html>