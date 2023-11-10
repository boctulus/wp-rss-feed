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
	
/*
	[0] => ID
    [1] => post_author
    [2] => post_date
    [3] => post_date_gmt
    [4] => post_content
    [5] => post_title
    [6] => post_excerpt
    [7] => post_status
    [8] => comment_status
    [9] => ping_status
    [10] => post_password
    [11] => post_name
    [12] => to_ping
    [13] => pinged
    [14] => post_modified
    [15] => post_modified_gmt
    [16] => post_content_filtered
    [17] => post_parent
    [18] => guid
    [19] => menu_order
    [20] => post_type
    [21] => post_mime_type
    [22] => comment_count
*/
$posts =Posts::getPosts('*', null, 'publish', null, null, [
	'_rss-perm-link' => 'https://latincloud.com/blog',
]);

dd(
	array_keys($posts[0])	
);