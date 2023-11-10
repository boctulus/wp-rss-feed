<?php

use boctulus\SW\core\libs\Posts;
use boctulus\SW\core\libs\RSS;
use boctulus\SW\core\libs\Plugins;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (php_sapi_name() != "cli"){
	// return; 
}

require_once __DIR__ . '/app.php';

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', realpath(__DIR__ . '/../../..') . DIRECTORY_SEPARATOR);

	require_once ABSPATH . '/wp-config.php';
	require_once ABSPATH .'/wp-load.php';
}

/////////////////////////////////////////////////
	

dd(
	Posts::getPosts('post_title,post_date,guid', null, 'publish', null, null, [
		'_rss-perm-link' => 'https://latincloud.com/blog',
	], [
		'post_date' => 'DESC'
	])
);