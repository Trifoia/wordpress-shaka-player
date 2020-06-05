<?php
/*
  Plugin Name: Shaka Player
  Plugin URI: https://github.com/Trifoia/wordpress-shaka-player
  description: Adds shortcodes that only display content when the user is logged in / out
  Version: 0.2.1
  Author: Trifoia
  Author URI: https://trifoia.com
*/

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
include( PLUGIN_PATH . 'php/embed-html-factory.php' );
include( PLUGIN_PATH . 'settings.php' );

/**
 * Shortcode used for embedding the Shaka Player
 */
function shaka_player_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'source' => NULL,
    'width' => NULL,
    'poster' => get_option('shaka_default_poster_url'),
    'attributes' => NULL
  ), $atts );

  if ( $a['source'] === NULL ) {
    print( 'Shaka Player Shortcode Error: No video source provided' );
    return;
  }

  // Enqueue scripts
  // Shaka player libraries
  wp_enqueue_script( 'compiled-shaka-player', get_option('shaka_player_url') );

  // Initialization script
  wp_enqueue_script( 'init-shaka-player-js', plugin_dir_url(__FILE__) . 'js/init-shaka-player.js' );

  // Return the generated embed code
  return embed_html_factory( $a );
}
add_shortcode( 'shaka_player', 'shaka_player_shortcode' );
