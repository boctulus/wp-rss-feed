<?php

// SHORTCODE

enqueue(function(){   
    css_file('third_party/bootstrap/5.x/bootstrap.min.css');
    css_file('third_party/bootstrap/5.x/normalize.css');
    js_file('third_party/bootstrap/5.x/bootstrap.min.js');
        
    css_file(__DIR__ . '/assets/css/styles.css');

    js_file(__DIR__ . '/assets/js/jquery.min.js', true);
});

// shortcode
function rss_feed($args = [])
{   
    $mode = $args['mode'] ?? null;

    /*
        Settings
    */

    $cfg = config(); 
    // ...

    $debug = false;
    if (isset($_GET['debug']) && in_array($_GET['debug'], ['true', '1'])){
        $debug = true;
    } 

    // ...

    ?>    
    
    <!-- HTML --> 
    <?php 

        return get_view(SHORTCODES_PATH . 'rss_feed/views/rss_feed.php'); 

    ?>
 
    <?php
}

add_shortcode('rss-feed', 'rss_feed');
