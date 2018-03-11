<?php

function get_tameplate($page) {
	include $page;
}

function init() {
	get_tameplate('post.php');
}