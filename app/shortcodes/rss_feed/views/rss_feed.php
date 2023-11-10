<?php

$cfg  = include __DIR__ . '/../config/config.php';
// Get RSS Feed(s)
include_once(ABSPATH . WPINC . '/feed.php');
	
$feed       = 'https://latincloud.com/blog/feed/';
$item_limit = 3;


// Get a SimplePie feed object from the specified feed source.
$rss = fetch_feed( $feed );

if (is_wp_error($rss)){
  return;
}

// Figure out how many total items there are, and choose a limit 
$item_qty = $rss->get_item_quantity($item_limit); 

// Build an array of all the items, starting with element 0 (first element).
$rss_items = $rss->get_items( 0, $item_qty ); 
$perm_link = $rss->get_permalink();
$title     = $rss->get_title();

// Check items
if ( $item_qty == 0 ) {
  echo "No hay entradas";
  return;
} 

// Loop through each feed item and display each item as a hyperlink.
foreach ( $rss_items as $item ) 
{ 
  $post_date      = $item->get_date( get_option('date_format') );
  $post_perm_link = $item->get_permalink();
  $post_title     = $item->get_title();
  $post_content   = $item->get_content();
  
  dd($post_content, $post_title); 
}


?>


<script>
  jQuery(document).ready(function() {
    // ...
  });
</script>