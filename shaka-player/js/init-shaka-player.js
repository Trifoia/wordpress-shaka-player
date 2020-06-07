(function() {
  function initApp() {
    // Install built-in polyfills to patch browser incompatibilities.
    shaka.polyfill.installAll();

    // Check to see if the browser supports the basic APIs Shaka needs.
    if (shaka.Player.isBrowserSupported()) {
      // Everything looks good!

      var video = document.getElementById('video');
      initPlayer(video);
    } else {
      // This browser does not have the minimum set of APIs we need.
      console.error('Browser not supported!');
    }
  }

  function initPlayer(video) {
    // Create a Player instance.
    var manifestUri = video.getAttribute('manifestUri');
    var subtitleUri = video.getAttribute('subtitleUri');
    var player = new shaka.Player(video);

    // Attach player to the window to make it easy to access in the JS console.
    window.player = player;

    // Listen for error events.
    player.addEventListener('error', onErrorEvent);

    // Try to load a manifest.
    // This is an asynchronous process.
    player.load(manifestUri).then(function() {
      // This runs if the asynchronous load is successful.
      console.log('The video has now been loaded!');
    }).then(function() {
      if (!subtitleUri) return true;

      // Apply subtitles
      var opts = {
        uri: subtitleUri, // Always present
        language: video.getAttribute('subtitleLanguage'), // Required
        kind: video.getAttribute('subtitleKind'), // Required
        mime: video.getAttribute('subtitleMime'), // Required
        codec: video.getAttribute('subtitleCodec') || '', // Optional
        label: video.getAttribute('subtitleLabel') // Required
      }

      // Throw an error if we are missing any required elements. This should never happen
      if (!opts.language || !opts.kind || !opts.mime || !opts.label) {
        var err = new Error('Subtitle instantiation failure: Incomplete options ' + JSON.stringify(opts));
        err.code = 'alfa';
        throw err;
      }

      // return Promise.all([
      //   player.addTextTrack(opts.uri, opts.language, opts.kind, opts.mime, opts.codec, opts.label),
      //   player.setTextTrackVisibility(true)
      // ])
      // Do this nasty business because Promise.all isn't supported in IE
      return new Promise(function(resolve, reject) {
        var textTrackAdded = false;
        var textTrackVisible = false;
  
        player.addTextTrack(opts.uri, opts.language, opts.kind, opts.mime, opts.codec, opts.label).then(function() {
          textTrackAdded = true;
          if (textTrackVisible) return resolve();
        }).catch(function(err) {
          console.error('player.addTextTrack error');
          console.error(err);
        });
        player.setTextTrackVisibility(true).then(function() {
          textTrackVisible = true;
          if (textTrackAdded) return resolve();
        }).catch(function(err) {
          console.error('player.setTextTrackVisibility error');
          console.error(err);
        });
      });
    }).catch(onError);  // onError is executed if the asynchronous load fails.
  }

  function onErrorEvent(event) {
    // Extract the shaka.util.Error object from the event.
    onError(event.detail);
  }

  function onError(error) {
    // Log the error.
    console.error('Error code', error.code, 'object', error);
  }

  document.addEventListener('DOMContentLoaded', initApp);
})();
