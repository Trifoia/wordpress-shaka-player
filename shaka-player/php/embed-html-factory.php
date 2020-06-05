<?php

function embed_html_factory($atts) {
  $id = 'id=video '; // ID is always video
  $source = 'manifestUri=' . $atts['source'] . ' '; // A source must always be present

  $width = $atts['width'] ? 'width=' . $atts['width'] . ' ' : '';
  $poster = $atts['poster'] ? 'poster=' . $atts['poster'] . ' ' : '';
  $attributes = $atts['attributes'] ?: '';

  $embedHtml = '<video ' . $id . $source . $width . $poster . $attributes . ' controls autoplay></video>';

  return $embedHtml;
}
