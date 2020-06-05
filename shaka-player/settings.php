<?php
/**
 * This class is based off these wonderful instructions by Matthew Ray:
 * https://www.smashingmagazine.com/2016/04/three-approaches-to-adding-configurable-fields-to-your-plugin/#top
 */
class Shaka_Player_Settings {
  public function __construct() {
    // Hook into the admin menu
    add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
    add_action( 'admin_init', array( $this, 'setup_sections' ) );
    add_action( 'admin_init', array( $this, 'setup_fields' ) );
  }

  public function create_plugin_settings_page() {
    // Add the menu item and page
    $page_title = 'Shaka Player Settings';
    $menu_title = 'Shaka Player';
    $capability = 'manage_options';
    $slug = 'shaka_player_fields';
    $callback = array( $this, 'plugin_settings_page_content' );

    add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback );
  }

  public function plugin_settings_page_content() { ?>
    <div class="wrap">
        <h2>Shaka Player Settings</h2>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'shaka_player_fields' );
                do_settings_sections( 'shaka_player_fields' );
                submit_button();
            ?>
        </form>
    </div> <?php
  }

  public function setup_sections() {
    add_settings_section( 'general_settings', 'General Settings', false, 'shaka_player_fields' );
  }

  public function setup_fields() {
    $fields = array(
      array(
        'uid' => 'shaka_player_url',
        'label' => 'Player URL',
        'section' => 'general_settings',
        'type' => 'text',
        'options' => false,
        'placeholder' => 'https://shakaplayerurl.com/shaka-player.compiled.js',
        'helper' => 'REQUIRED',
        'supplemental' => 'A URL pointing to a "shaka-player.compiled.js" file',
        'default' => ''
      ),
      array(
        'uid' => 'shaka_manifest_base',
        'label' => 'Manifest URL',
        'section' => 'general_settings',
        'type' => 'text',
        'options' => false,
        'placeholder' => 'https://shakamanifestbase.com',
        'helper' => 'REQUIRED',
        'supplemental' => 'Base to use when constructing the manifest url',
        'default' => ''
      )
    );
    foreach( $fields as $field ) {
      add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'shaka_player_fields', $field['section'], $field );
      register_setting( 'shaka_player_fields', $field['uid'] );
    }
  }

  public function field_callback( $arguments ) {
    $value = get_option( $arguments['uid'] ); // Get the current value, if there is one
    if( ! $value ) { // If no value exists
      $value = $arguments['default']; // Set to our default
    }

    // Check which type of field we want
    switch( $arguments['type'] ){
      case 'text': // If it is a text field
        printf( '<input style="width: 40em;" name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
        break;
    }

    // If there is help text
    if( $helper = $arguments['helper'] ){
      printf( '<span class="helper"> %s</span>', $helper ); // Show it
    }

    // If there is supplemental text
    if( $supplemental = $arguments['supplemental'] ){
      printf( '<p class="description">%s</p>', $supplemental ); // Show it
    }
  }
}
new Shaka_Player_Settings();
