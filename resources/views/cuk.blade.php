<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="//vjs.zencdn.net/7.10.2/video-js.min.css" rel="stylesheet">
  <script src="//vjs.zencdn.net/7.10.2/video.min.js"></script>
</head>
<body>
  <video
  id="my-player"
  class="video-js"
  controls
  preload="auto"
  poster="//vjs.zencdn.net/v/oceans.png"
  data-setup='{}'>
  <source src="/storage/video/video-360.mp4" type="video/mp4"></source>
  <p class="vjs-no-js">
    To view this video please enable JavaScript, and consider upgrading to a
    web browser that
  </p>
</video>

<script type="text/javascript">
  var options = {};

  var player = videojs('my-player', options, function onPlayerReady() {
    videojs.log('Your player is ready!');

  // In this context, `this` is the player that was created by Video.js.
  this.play();

  // How about an event listener?
  this.on('ended', function() {
    videojs.log('Awww...over so soon?!');
  });
});
</script>
</body>
</html>