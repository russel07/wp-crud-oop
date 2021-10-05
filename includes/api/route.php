<?php

class Route extends WP_REST_Controller {
    protected $namespace;
    protected $rest_base;

    public function __construct() {
        $this->namespace = 'crudAPI/v1';
        $this->rest_base = 'products';
    }

    public function register_routes() {
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_items' ],
                    'permission_callback' => [ $this, 'get_items_permission_check' ],
                    'args'                => $this->get_collection_params()
                ],
                [
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => [ $this, 'create_item' ],
                    'permission_callback' => [ $this, 'create_item_permissions_check' ],
                    'args'                => $this->get_endpoint_args_for_item_schema(true )
                ]
            ]
        );
    }

    public function get_items($request)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . PRODUCT_TABLE;
        $this->items = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

        $response = [
            'id' => get_option('id', true),
            'product_title' => get_option('product_title', true),
            'product_description' => get_option('product_description', true)
        ];

        return rest_ensure_response( $this->items );
    }

    public function get_items_permission_check($request){
        return true;
    }

    public function create_item($request)
    {

    }

    public function create_item_permissions_check($request)
    {
        return true;
    }
}
