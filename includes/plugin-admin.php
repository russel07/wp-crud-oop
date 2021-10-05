<?php
class PluginAdmin {
    private  $name;
    private  $version;
    protected $views = array();

    public function __construct($name, $version)
    {
        $this->name = $name;
        $this->version = $version;
    }

    public function load_view() {
        $current_views = $this->views[current_filter()];
        include(dirname(PLUGIN_FILE_URL).'/views/'.$current_views.'.php');
    }

    function products_admin_menu() {
        $view_hook_name = add_menu_page( 'Manage Product',
            'Manage Product',
            'manage_options',
            'products',
            array(&$this, 'load_view')
        );
        $this->views[$view_hook_name] = 'products';
    }

    public function enqueue_style(){
        //wp_register_style('custom_crud_asset', plugins_url('/rus-wp-crud-plugin/public/css/custom_crud_style.css'));
        //wp_enqueue_style('custom_crud_asset');
        wp_enqueue_style( $this->name, plugin_dir_url( PLUGIN_FILE_URL ) . 'css/style.css', array(), $this->version, 'all' );
    }

    public function enqueue_scripts(){
        wp_enqueue_script( $this->name, plugin_dir_url( PLUGIN_FILE_URL ) . 'js/main.js', array(), $this->version, 'all' );
    }
}
