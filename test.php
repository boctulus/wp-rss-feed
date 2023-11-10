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


// dd(
// 	Posts::getMetasByID(48)
// );

// dd(Posts::exists([
// 	'_rss-post-data' => 1699543293
// ],
// [
// 	'category' => 'RSS'
// ], 'trash'));

// exit;

	
$feed = 'https://latincloud.com/blog/feed/';

$rss  = new RSS();

// dd(
// 	$rss->getPosts($feed, 3)
// );

$rss->importPosts($feed, 3);