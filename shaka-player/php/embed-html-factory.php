<?php

include( PLUGIN_PATH . 'php/determine-manifest-type.php' );

function embed_html_factory($atts) {
  $id = 'id=video '; // ID is always video
  $uriBase = get_option('shaka_manifest_base') . $atts['source'] . '/';
  $manifestUri = 'manifestUri=' . $uriBase . determine_manifest_type() . ' '; // A source must always be present
  $subtitleUri = 'subtitleUri=' . $uriBase . get_option('shaka_subtitles_filename') . ' ';

  // Handle base attributes
  $width = $atts['width'] ? 'width=' . $atts['width'] . ' ' : '';
  $poster = $atts['poster'] ? 'poster=' . $atts['poster'] . ' ' : '';
  $attributes = $atts['attributes'] ?: '';
  
  // Handle subtitle attributes
  $subtitleAttributes = '';
  if ( $atts['subtitles'] === TRUE ) {
    $subtitleArr = array(
      'subtitleUri' => $subtitleUri,
      'subtitleLanguage' => get_option('shaka_subtitles_language'),
      'subtitleKind' => get_option('shaka_subtitles_kind'),
      'subtitleMime' => get_option('shaka_subtitles_mime'),
      'subtitleCodec' => get_option('shaka_subtitles_codec') ?: '',
      'subtitleLabel' => get_option('shaka_subtitles_label')
    );
    $subtitleAttributes = implode(' ', $subtitleArr) . ' ';
  }

  $embedHtml = '<video ' . $id . $manifestUri . $width . $poster . $subtitleAttributes . $attributes . ' controls autoplay controlsList=nodownload crossorigin=anonymous></video>';

  return $embedHtml;
}
