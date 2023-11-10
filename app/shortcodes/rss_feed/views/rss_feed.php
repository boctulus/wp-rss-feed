<?php

use boctulus\SW\core\libs\RSS;

$cfg  = include __DIR__ . '/../config/config.php';
	
$feed_url   = 'https://latincloud.com/blog/feed';
$item_limit = 18; // 

$rss   = new RSS();

$feed  = $rss->getPosts($feed_url, $item_limit);
$posts = $feed['posts'];

foreach ($posts as $ix => $post) {
  $pattern = '/<img.*?src=["\'](.*?)["\'].*?>/i';

  if (preg_match($pattern, $post['content'], $matches)) {
    $posts[$ix]['img'] = $matches[1];
  }
}

?>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">

      <?php foreach ($posts as $ix => $post): ?>
        <?php
          $link = $post['perm_link'];
        ?>

        <!-- Card  -->
        <div class="col">
          
          <div class="card border-0">
            <img src="<?= $post['img'] ?>" class="card-img-top" alt="Imagen">
            <div class="card-body">
              <h5 class="card-title"><a href="<?= $link ?>" target="_blank"><?= $post['title'] ?></a></h5>
              <p class="card-text">
                <?= wp_html_excerpt($post['content'], 120) . ' [...]'; ?>
              </p>
              <p>
              <a href="<?= $link ?>" target="_blank">Continuar leyendo ⇨</a>
              </p>
            </div>
            <!--div class="card-footer">
              Pie de la card
            </div-->
          </div>

        </div>

    <?php endforeach; ?>
    
  </div>
</div>


<script>
  jQuery(document).ready(function() {
    // ...
  });
</script>