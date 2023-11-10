<?php

/*
    @author  Pablo Bozzolo boctulus@gmail.com
*/

namespace boctulus\SW\core\libs;

use boctulus\SW\core\libs\Strings;
use boctulus\SW\core\libs\Arrays;

/*
    @author Pablo Bozzolo
*/
class RSS
{   
    function __construct(){
        include_once(ABSPATH . WPINC . '/feed.php');
    }

    function getPosts($feed_url, $maxitems) 
    {
        // Get a SimplePie feed object from the specified feed source.
        $rss = fetch_feed( $feed_url );

        if (is_wp_error($rss)){
            throw new \Exception(implode("\r\n", $rss->get_error_messages()));
        }

        // Figure out how many total items there are, and choose a limit 
        $item_qty = $rss->get_item_quantity($maxitems); 

        // Build an array of all the items, starting with element 0 (first element).
        $rss_items = $rss->get_items( 0, $item_qty ); 
        $perm_link = $rss->get_permalink();
        $title     = $rss->get_title();

        $ret       = [
            'title' => $title,
            'count' => $item_qty,
            'posts' => []
        ];

        // Check items
        if ( $item_qty == 0 ) {
            return $ret;
        } 

        // Loop through each feed item and display each item as a hyperlink.
        foreach ( $rss_items as $item ) 
        { 
            $post_date      = $item->get_date('U');
            $post_perm_link = $item->get_permalink();
            $post_title     = $item->get_title();
            $post_content   = $item->get_content();
        
            $ret['posts'][] = [
                'title'     => $post_title,
                'date'      => $post_date,
                'perm_link' => $post_perm_link,
                'content'   => $post_content
            ]; 
        }

        return $ret;
    }

    /*
        Se importan los posts del feed y se les agrega la categoria "RSS"
    */
    function importPosts($feed_url, $maxitems, $post_status = 'publish') {
        $feed  =  $this->getPosts($feed_url, $maxitems);
        $posts = $feed['posts'];

        foreach ( $posts as $post )
        {   
            // Evito crear dos veces el mismo post
            if (Posts::exists([
                '_rss-post-data' =>  $post['date']
            ], null) || Posts::exists([
                '_rss-post-data' =>  $post['date']
            ], null, 'trash')){
                continue;
            }

            $post_id = Posts::create($post['title'], $post['content'], $post_status);
            Posts::setMeta($post_id, 'rss_post_data', $post['date']);
            Posts::setCategory($post_id,'RSS');
        }

    }

}