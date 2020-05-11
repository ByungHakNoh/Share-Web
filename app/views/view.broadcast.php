<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share - broadcast</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="public/css/broadcastStyle.css?after">
    <link href="https://vjs.zencdn.net/7.1/video-js.min.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.1/video.min.js"></script>
</head>

<body>

    <?php require('holder/main/bodyHeadPage.php'); ?>
    <div class="broadcastContainer">
        <h1>... 의 방송입니다</h1>
        <video id="player" class="video-js vjs-default-skin" controls>
            <source src="https://share-fashion.ga/src/video/hls/test.m3u8" type="application/x-mpegURL" />
        </video>
    </div>
    <script>
        let options, video;

        options = {
            autoplay: true,
            muted: true
        };

        video = videojs('player', options);
    </script>
</body>

</html>