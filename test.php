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
	

$html_string = '<img fetchpriority="high" decoding="async" width="948" height="506" src="https://latincloud.com/blog/wp-content/uploads/2023/11/word-image-20258-1-jpg.webp" alt="" class="wp-image-20259" srcset="https://latincloud.com/blog/wp-content/uploads/2023/11/word-image-20258-1-jpg.webp 948w, https://latincloud.com/blog/wp-content/uploads/2023/11/word-image-20258-1-300x160.webp 300w, https://latincloud.com/blog/wp-content/uploads/2023/11/word-image-20258-1-768x410.webp 768w" sizes="(max-width: 948px) 100vw, 948px" />';

$pattern = '/<img.*?src=["\'](.*?)["\'].*?>/i';

if (preg_match($pattern, $html_string, $matches)) {
    $src = $matches[1];
}