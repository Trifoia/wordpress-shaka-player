<?php
/*
  Plugin Name: Shaka Player
  Plugin URI: https://github.com/Trifoia/wordpress-shaka-player
  description: WordPress plugin that allows embedding of the Shaka player via shortcode
  Version: 1.0.0
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
    'attributes' => NULL,
    'subtitles' => 'true'
  ), $atts );
  $a['subtitles'] = filter_var($a['subtitles'], FILTER_VALIDATE_BOOLEAN);

  if ( $a['source'] === NULL ) {
    print( 'Shaka Player Shortcode Error: No video source provided' );
    return;
  }

  // Enqueue scripts
  // Shaka player libraries
  wp_enqueue_script( 'compiled-shaka-player', get_option('shaka_player_url') );

  // Video initialization script
  wp_enqueue_script( 'init-shaka-player-js', plugin_dir_url(__FILE__) . 'js/init-shaka-player.js' );

  // Return the generated embed code
  return embed_html_factory( $a );
}
add_shortcode( 'shaka_player', 'shaka_player_shortcode' );
