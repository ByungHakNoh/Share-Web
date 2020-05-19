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
    <script defer src="app/views/javascript/broadcast.js"></script>
    <script defer src="https://share-fashion.ga:3000/socket.io/socket.io.js"></script>
    <script defer src="app/node/script.js"></script>
    <script>
        const userNickName = "<?= isset($_SESSION['nickName']) ? $_SESSION['nickName'] : null ?>"
    </script>
</head>

<body>

    <?php require('holder/main/bodyHeadPage.php'); ?>
    <div class="broadcastContainer">
        <video id="player" class="video-js vjs-default-skin" controls>
            <source src="https://share-fashion.ga/src/video/hls/test.m3u8" type="application/x-mpegURL" />
        </video>
    </div>

    <!-- 채팅창 박스 -->
    <div class="chatBox">
        <div id="messageContainer" class="messageContainer">
        </div>
        <form class="messageForm" id="messageForm">
            <input type="text" id="messageInput">
            <button type="submit" id="sendBtn">보내기</button>
        </form>
    </div>
</body>

</html>