<?php
require_once( 'Vkontakte.php' );
require_once( 'Vkontakte.php' );

error_reporting( E_ALL & ~E_NOTICE );
ini_set( 'error_reporting', E_ALL );

header( 'Content-type: text/html;charset=utf-8' );
session_start();

global $vk;

use \BW\Vkontakte as Vk;

$vkBotUri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$vk = new Vk( array(
		'client_id'     => '6390434',
		'client_secret' => '3VaaspeFS1PinQs3QHo0',
		'refirect_uri'  => $vkBotUri,
	)
);

if ( isset ( $_GET['code'] ) ) {
	$vk->authenticate();
	$_SESSION['acess_token'] = $vk->getAccessToken();
	header( 'location' . $vkBotUri );
}

