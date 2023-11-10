<?php

namespace boctulus\SW\controllers;

use boctulus\SW\core\libs\DB;
use boctulus\SW\core\libs\RSS;
use boctulus\SW\core\libs\Strings;

class TestController
{
    function rss(){
        $feed       = 'https://latincloud.com/blog/feed/';
        $item_limit = 12;

        $rss  = new RSS();

        $rss->importPosts($feed, $item_limit, 'publish', 'RSS');
    }

}
