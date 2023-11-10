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

?>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <!-- Card 1 -->
      <div class="col">
        
        <div class="card border-0">
          <img src="ruta_de_la_imagen.jpg" class="card-img-top" alt="Imagen">
          <div class="card-body">
            <h5 class="card-title">Título de la Card</h5>
            <p class="card-text">Contenido del cuerpo de la card.</p>
          </div>
          <div class="card-footer">
            Pie de la card
          </div>
        </div>

      </div>

      <!-- Card 2 -->
      <div class="col">
        <div class="card">
          <div class="card-header" id="heading2">
            <h5 class="mb-0">
              <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                Título de la Card 2
              </button>
            </h5>
          </div>
          <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordion">
            <div class="card-body">
              Contenido de la Card 2
            </div>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col">
        <div class="card">
          <div class="card-header" id="heading3">
            <h5 class="mb-0">
              <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                Título de la Card 3
              </button>
            </h5>
          </div>
          <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion">
            <div class="card-body">
              Contenido de la Card 3
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </div>


<script>
  jQuery(document).ready(function() {
    // ...
  });
</script>