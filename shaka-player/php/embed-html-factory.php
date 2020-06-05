<?php

function embed_html_factory($atts) {
  $embedHtml = '<video id="video" width="' . $atts['width'] . '" poster="' . $atts['poster'] . '" controls autoplay></video>';

  return $embedHtml;
}
