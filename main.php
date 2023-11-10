<?php

use boctulus\SW\core\libs\RSS;
use boctulus\SW\core\libs\Url;
use boctulus\SW\core\libs\Templates;

/*
    By boctulus
*/

// Templates::set('astra');


// Shortcodes
require_once __DIR__ . '/app/shortcodes/rss_feed/rss_feed.php';


register_activation_hook(__FILE__, 'my_activation');
 
function my_activation() {
    if (! wp_next_scheduled ( 'my_hourly_event' )) {
        wp_schedule_event(time(), 'hourly', 'my_hourly_event');
    }
}
 
add_action('my_hourly_event', 'do_this_hourly');
 
function do_this_hourly() {    
    $feed       = 'https://latincloud.com/blog/feed/';
    $item_limit = 3;

    $rss  = new RSS();

    $rss->importPosts($feed, $item_limit, 'publish', 'RSS');
}

