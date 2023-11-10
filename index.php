<?php

use boctulus\SW\core\Router;
use boctulus\SW\core\FrontController;
use boctulus\SW\core\libs\Files;

/*
	Plugin Name: WP RSS FEED
	Description: Posts from feeds 
	Version: 0.0.1
	Domain Path:  /languages
	Text Domain: wp-rss-feed
	Author: Pablo Bozzolo <boctulus@gmail.com>

	Code:

	@author Pablo Bozzolo
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! defined( 'CURRENT_PLUGIN_INDEX_FILE' ) ) {
	define( 'CURRENT_PLUGIN_INDEX_FILE', __FILE__ );
}		

require_once __DIR__ . '/app.php';


register_activation_hook( __FILE__, function(){
	$log_dir = __DIR__ . '/logs';
	
	if (is_dir($log_dir)){
		Files::globDelete($log_dir);
	} else {
		Files::mkdir($log_dir);
	}

	include_once __DIR__ . '/on_activation.php';
});

db_errors(false);

require_once __DIR__ . '/main.php';


/*
	Cargo traducciones
*/

if (is_cli()){
	add_action( 'init', function() {
		$domain = get_text_domain(); 
		load_plugin_textdomain( $domain, false, basename( dirname( __FILE__ ) ) . "/languages/" );
	} );
} else {	
	$domain = get_text_domain();
	load_plugin_textdomain( $domain, false, basename( dirname( __FILE__ ) ) . "/languages/" );
}


/*
    Con esto puedo hacer endpoints donde podre acceder a funciones de WooCommerce directa o indirectamente

    Ej:

    get_header()
	get_footer()
*/

$cfg = config();

add_action('wp_loaded', function() use ($cfg) {
	$wc_active = is_plugin_active('woocommerce/woocommerce.php');

    if  (!$wc_active || ($wc_active && defined('WC_ABSPATH') && !is_admin()))
	{
       	/*
			Router
		*/

		$routes = include __DIR__ . '/config/routes.php';
		
		if ($cfg['router'] ?? true){ 
			Router::routes($routes);
			Router::getInstance();
		}

		/*
			Front controller
		*/

		if ($cfg['front_controller'] ?? false){        
			FrontController::resolve();
		} 
    }    
});	 	 


if (isset($_GET['credits'])){
    add_action('wp_footer', function(){ 
		$app_name = config()['app_name'] ?? 'Plugin development';
        ?>
            <div id="dev-credits" style="
            height: 60px;
            text-align: center; margin: auto;
            width: 100%;
            padding-top: 20px;
            padding-bottom: 20px;
            background-color: #f0ad4e; ">
            <strong><?= $app_name ?></strong> by <b>Pablo Bozzolo</b> < boctulus@gmail.com >
            </div>

			<script>
				document.addEventListener('DOMContentLoaded', function() {
					if (window.location.href.includes('credits')) {
						var creditsElement = document.getElementById('dev-credits');
						if (creditsElement) {
							creditsElement.scrollIntoView({ behavior: 'smooth' });
						}
					}
				});
			</script>
        <?php    
    }); 
}



