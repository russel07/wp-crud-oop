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

        return rest_ensure_response( $this->items );
    }

    public function get_items_permission_check($request){
        return true;
    }

    public function create_item($request)
    {
        if(isset( $request['project_title'] ))
            return rest_ensure_response( [
                'project_title' => 'Here',
                'description' => 'Here',
                'price' => 'Here',
            ] );
        else
            return rest_ensure_response( [
                'project_title' => 'No Data',
                'description' => 'Here',
                'price' => 'Here',
            ] );
        $title = isset( $request['project_title'] ) ? sanitize_text_field( $request['project_title'] ): '';
        $description = isset( $request['project_description'] ) ? sanitize_text_field( $request['project_description'] ): '';
        $price = isset( $request['price'] ) ? sanitize_text_field( $request['price'] ): '';


    }

    public function create_item_permissions_check($request)
    {
        return true;
    }
}
