<?php

function embed_html_factory($atts) {
  $embedHtml <<<EOD
<video id="video"
  width="$atts['width']"
  poster="$atts['poster']"
  controls autoplay></video>
EOD;

  print_r($embedHtml);
  return $embedHtml;
}
