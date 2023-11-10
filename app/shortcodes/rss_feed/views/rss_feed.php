<?php

use boctulus\SW\core\libs\Posts;

$cfg  = include __DIR__ . '/../config/config.php';
	
$blog       = 'https://latincloud.com/blog';
$item_limit = 3; // colocar 6

$posts = Posts::getPosts('post_title,post_content,guid', null, 'publish', null, null, [
  '_rss-perm-link' => 'https://latincloud.com/blog',
], [
  'post_date' => 'DESC'
]);

foreach ($posts as $ix => $post) {
  $pattern = '/<img.*?src=["\'](.*?)["\'].*?>/i';

  if (preg_match($pattern, $post['post_content'], $matches)) {
    $posts[$ix]['post_img'] = $matches[1];
  }
}

?>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">

      <?php foreach ($posts as $ix => $post): ?>

        <!-- Card  -->
        <div class="col">
          
          <div class="card border-0">
            <img src="<?= $post['post_img'] ?>" class="card-img-top" alt="Imagen">
            <div class="card-body">
              <h5 class="card-title"><?= $post['post_title'] ?></h5>
              <p class="card-text">
                <?= wp_html_excerpt($post['post_content'], 120) . ' [...]'; ?>
              </p>
            </div>
            <div class="card-footer">
              Pie de la card
            </div>
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