<?php

function get_tameplate($page) {
	include $page;
}

function init() {
	get_tameplate('post.php');
}
function get_code() {
	if (isset ($_GET['code'])) {
		echo 'hello';
	}
}