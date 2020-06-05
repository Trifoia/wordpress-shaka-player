<?php

include( PLUGIN_PATH . 'php/determine-manifest-type.php' );

function embed_html_factory($atts) {
  $id = 'id=video '; // ID is always video
  $source = 'manifestUri=' . get_option('shaka_manifest_base') . $atts['source'] . '/' . determine_manifest_type() . ' '; // A source must always be present

  $width = $atts['width'] ? 'width=' . $atts['width'] . ' ' : '';
  $poster = $atts['poster'] ? 'poster=' . $atts['poster'] . ' ' : '';
  $attributes = $atts['attributes'] ?: '';

  $embedHtml = '<video ' . $id . $source . $width . $poster . $attributes . ' controls autoplay></video>';

  return $embedHtml;
}
