<?php
/*
  Plugin Name: Shaka Player
  Plugin URI: https://github.com/Trifoia/wordpress-shaka-player
  description: Adds shortcodes that only display content when the user is logged in / out
  Version: 0.1.0
  Author: Trifoia
  Author URI: https://trifoia.com
*/

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
include( PLUGIN_PATH . 'php/embed-html-factory.php');

/**
 * Shortcode used for embedding the Shaka Player
 */
function shaka_player_shortcode($atts) {
  $a = shortcode_atts( array(
    'source' => NULL,
    'width' => NULL,
    'poster' => '//shaka-player-demo.appspot.com/assets/poster.jpg',
    'attributes' => NULL
  ), $atts );

  if ( $a['source'] === NULL ) {
    print( 'Shaka Player Shortcode Error: No video source provided' );
    return;
  }

  // Enqueue scripts
  // Shaka player libraries
  wp_enqueue_script( 'compiled-shaka-player', 'https://dzkzesh9fdnvq.cloudfront.net/shaka-player/shaka-player.compiled.js' );

  // Initialization script
  wp_enqueue_script( 'init-shaka-player-js', plugin_dir_url(__FILE__) . 'js/init-shaka-player.js' );

  // Return the generated embed code
  return embed_html_factory($a);
}
add_shortcode('shaka_player', 'shaka_player_shortcode');
