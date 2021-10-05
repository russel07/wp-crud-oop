<?php

class OOPCrud
{
    protected $loader;
    protected $plugin_name;
    protected $version;
    static $instance = false;


    public function __construct()
    {
        if (defined('RUSCRUDOOP_VERSION')) {
            $this->version = RUSCRUDOOP_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'wp-crud';

        $this->load_dependencies();
        $this->activate_me();
        $this->deactivate_me();
        $this->define_admin_hooks();
        //$this->define_public_hooks();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function load_dependencies()
    {
        require_once plugin_dir_path(PLUGIN_FILE_URL) . '/includes/plugin-activator.php';
        require_once plugin_dir_path(PLUGIN_FILE_URL) . '/includes/plugin-deactivator.php';
        require_once plugin_dir_path(PLUGIN_FILE_URL) . '/includes/plugin-loader.php';
        $this->loader = new PluginLoader();
    }

    public function activate_me(){
        $activate = new PluginActivator();
        $this->loader->add_action( 'activate_wp-crud-oop/index.php', $activate, 'product_table_install' );
    }

    public function deactivate_me(){
        $deactivate = new PluginDeactivator();
        $this->loader->add_action( 'deactivate_wp-crud-oop/index.php', $deactivate, 'deactivate' );
    }

    public function define_admin_hooks(){
        $admin_menu = new PluginActivator();
        $this->loader->add_action( 'admin_menu', $admin_menu, 'products_admin_menu' );
    }

    public function run(){
        $this->loader->run();
    }

    public function getLoader()
    {
        return $this->loader;
    }

    public function getPluginName()
    {
        return $this->plugin_name;
    }

    public function getVersion()
    {
        return $this->version;
    }
}
