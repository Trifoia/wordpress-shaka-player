<?php
class Settings {
  public function __construct() {
    // Hook into the admin menu
    add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
  }

  public function create_plugin_settings_page() {
    // Add the menu item and page
    $page_title = 'Shaka Player Settings';
    $menu_title = 'Shaka Player';
    $capability = 'manage_options';
    $slug = 'shaka_player';
    $callback = array( $this, 'plugin_settings_page_content' );
    $icon = 'dashicons-admin-plugins';
    $position = 100;

    add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
  }

  public function plugin_settings_page_content() {
    echo 'Hello World!';
  }
}
new Settings();
