<?php
class PluginDeactivator {
    function deactivate() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'productss';
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
        delete_option("product_table_version");
    }
}
