<?php


error_reporting( E_ALL & ~E_NOTICE );
ini_set( 'error_reporting', E_ALL );

header( 'Content-type: text/html;charset=utf-8' );
session_start();

require_once( 'Vkontakte.php' );
require_once( 'functions.php' );

get_tameplate( 'header.php' );

global $vk;

use \BW\Vkontakte as Vk;

$vkBotUri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$VkBlank  = 'https://oauth.vk.com/blank.html';

$vk = new Vk( array(
		'client_id'     => '6390434',
		'client_secret' => 'PUISkLqTsYcqkTuo9S9T',
		'response_type' => 'code',
		'scope'         => array( 'groups,offline,wall' ),
		'redirect_uri'  => $VkBlank,

	)
);

if ( isset ( $_GET['code'] ) ) {
	echo 'hello';
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
		<p>Для получения токена сначала необходимо нажать <a href="<?php echo $vk->getLoginUrl(); ?>">ПОЛУЧИТЬ
				КОД</a></br> и с адресной строки, скопировать всё после "#code=", а затем перейти на
			http://localhost/index.php </br>
			и ввести этот код в поле ввода. </p>
		<form action="" method="get">
			<input type="text" name="code">
			<input type="submit" value="ОК">
		</form>
		<?php
	}
}

