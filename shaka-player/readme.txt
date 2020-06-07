=== shaka-player ===

Adds shortcodes that can be used to embed Shaka Player videos

== Description ==
# Use
Add the [shaka_player] shortcode that will automatically embed the Shaka Player
Required Attributes:
- "source" - The location of the main video manifest. This value will be appended to the
             "Manifest Base" setting, and the correct manifest file format will be appended,
             depending on the platform (Dash vs HLS). For example, if a manifest can be found
             at the address "https://test.com/videos/test/dash.mpd", you would use set the
             source attribute to "videos/test"
             
             Note: This value should not begin or end with a slash ("/")

Optional Attributes
- "width" - The width to make the video player
- "poster" - Url of the image to show when loading video
- "attributes" - Any additional attributes you may wish to add to the video element
- "subtitles" - If subtitles should be added using the configured settings. Default "true"

# Settings
The following configurations can be found in the settings menu
Required Settings:
- "Player URL" - A URL pointing to a "shaka-player.compiled.js" file
- "Manifest Base" - Base to use when constructing the manifest url

Optional Settings:
- "Default Poster URL" - A URL pointing to the poster image to use as a default

Subtitle Settings:
- "Filename" - Name of the subtitle file. Default "subtitles.0.vtt"
- "Language" - The language of the text. Default "en"
- "Kind" - The kind of subtitles. Can be "caption" or "subtitle". Default "subtitle"
- "MIME" - The MIME type of the subtitle file. Default "text/vtt"
- "Codec" - The codec to use. Should generally be left blank
- "Label" - The label used to identify the text track. Default "English"

# Subtitles
Currently, only a single subtitle configuration set is supported. All videos with subtitles
enabled will use the settings defined in the "Subtitle Settings" section of the settings menu
