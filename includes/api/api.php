<?php
require_once plugin_dir_path(PLUGIN_FILE_URL) . '/includes/api/route.php';

class CrudAPI extends WP_REST_Controller{
    /**
     * Construct Function
     */
    /*public function __construct() {
        add_action( 'rest_api_init', [ $this, 'register_routes' ] );
    }*/

    /**
     * Register API routes
     */
    /*public function register_routes() {
        ( new Route() )->register_routes();
    }*/

    function my_awesome_func( $data ) {
        ( new Route() )->register_routes();
    }

}
