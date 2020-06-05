=== shaka-player ===

Adds shortcodes that can be used to embed Shaka Player videos

== Description ==
# Use
Add the [shaka_player] shortcode that will automatically embed the Shaka Player
Required Attributes:
- "source" - The source for the main video manifest. Note: This value should not begin or end with a slash ("/")

Optional Attributes
- "width" - The width to make the video player
- "poster" - Url of the image to show when loading video
- "attributes" - Any additional attributes you may wish to add to the video element

# Settings
The following configurations can be found in the settings menu
Required Settings:
- "Player URL" - A URL pointing to a "shaka-player.compiled.js" file
- "Manifest Base" - Base to use when constructing the manifest url
- "Default Poster URL" - A URL pointing to the poster image to use as a default
