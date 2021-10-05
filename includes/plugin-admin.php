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
        wp_enqueue_style( $this->name, plugin_dir_url( PLUGIN_FILE_URL ) . 'css/style.css', array(), $this->version, 'all' );
    }

    public function enqueue_scripts(){
        wp_register_script($this->name.'vue', 'https://cdn.jsdelivr.net/npm/vue@2.6.14', array(), $this->version, 'all' );
        wp_register_script($this->name.'vue-router', 'https://unpkg.com/vue-router@2.0.0/dist/vue-router.js', array(), $this->version, 'all' );
        wp_register_script($this->name.'axios', 'https://unpkg.com/axios/dist/axios.min.js', array(), $this->version, 'all' );
        wp_register_script($this->name.'main', plugin_dir_url( PLUGIN_FILE_URL ) . 'js/main.js', array(), $this->version, 'all' );

        wp_enqueue_script( $this->name.'vue' );
        wp_enqueue_script( $this->name.'vue-router' );
        wp_enqueue_script( $this->name.'axios' );
        wp_enqueue_script( $this->name.'main' );

    }

    public function add_type_attribute($tag, $handle, $src) {
        if ( $this->name.'main' !== $handle ) {
            return $tag;
        }
        $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
        return $tag;
    }
}
