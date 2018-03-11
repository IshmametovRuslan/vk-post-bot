<?php

require_once( 'Vkontakte.php' );
require_once( 'functions.php' );

get_tameplate( 'header.php' );

error_reporting( E_ALL & ~E_NOTICE );
ini_set( 'error_reporting', E_ALL );

header( 'Content-type: text/html;charset=utf-8' );
session_start();

global $vk;

use \BW\Vkontakte as Vk;

$vkBotUri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$vk = new Vk( array(
		'client_id'     => '6390434',
		'client_secret' => 'PUISkLqTsYcqkTuo9S9T',
		'redirect_uri'  => $vkBotUri,
	)
);

if ( isset ( $_GET['code'] ) ) {
	$vk->authenticate();
	$_SESSION['access_token'] = $vk->getAccessToken();
	header( 'location: ' . $vkBotUri );
	die();
} else {
	if ( ! empty( $_SESSION['access_token'] ) ) {
		$vk->setAccessToken( $_SESSION['access_token'] );
		init();
	} else {
		?>
		<p><a href="<?php echo $vk->getLoginUrl(); ?>">Аутентификация</a></p>
		<?php
	}
}

