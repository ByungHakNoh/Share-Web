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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
    <script defer src="app/views/javascript/broadcast.js"></script>
    <script defer src="https://share-fashion.ga:3000/socket.io/socket.io.js"></script>
    <script defer src="app/node/script.js"></script>
    <script>
        const userNickName = "<?= $nickName ?>"
        const userDonationMoney = "<?= $donationMoney ?>"
    </script>
</head>

<body>

    <?php require('holder/main/bodyHeadPage.php'); ?>
    <div class="broadcastContainer">
        <video id="player" class="video-js vjs-default-skin" controls>
            <source src="https://share-fashion.ga/src/video/hls/test.m3u8" type="application/x-mpegURL" />
        </video>

        <div id="overlayBox" class="overlay" hidden>
            <img src="src/image/img.png" alt="">
            <div>
                <small id="overlayText"></small>
            </div>
        </div>
        <div class="broadcastBtnContainer">
            <button data-target="#donationBox">후원하기</button>
        </div>
    </div>

    <!-- 채팅창 박스 -->
    <div class="chatBox">
        <div id="messageContainer" class="messageContainer">
        </div>
        <form class="messageForm" id="messageForm" autocomplete="off">
            <input type="text" id="messageInput">
            <button type="submit" id="sendBtn">보내기</button>
        </form>
    </div>


    <div class="donationBox" id="donationBox">
        <div class="donationBoxHeader">
            <div class="title">후원하기</div>
            <button id="donationCloseBtn" class="closeBtn">&times;</button>
        </div>
        <div class="donationBoxBody">
            <div class="notificationBox">
                <h3>현재 보유한 금액 :</h3>
                <h3 id="currentMoney" class="currentMoney"><?= $donationMoney ?></h3>
                <h3>원</h3>
            </div>
            <h4>후원금액 : <input id="donationInput" type="text"> 원</h4>
            <div class="donateBtnContainer">
                <button id="donateBtn">후원</button>
                <button id='rechargePopUpBtn'>충전</button>
            </div>
        </div>
    </div>

    <div class="donationBox" id="rechargeBox">
        <div class="donationBoxHeader">
            <div class="title">충전하기</div>
            <button data-close-btn="#rechargeBox" class="closeBtn" id="testExit">&times;</button>
        </div>
        <div class="donationBoxBody">
            <div class="notificationBox">
                <h3>현재 보유한 금액 :</h3>
                <h3 class="currentMoney"><?= $donationMoney ?></h3>
                <h3>원</h3>
            </div>
            <h4>충전금액 선택</h4>
            <form class="rechargeSelectForm" id="rechargeSelectForm">
                <div>
                    <label><input type="radio" name="money" value="1000">1000원</label>
                    <label><input type="radio" name="money" value="3000">3000원</label>
                    <label><input type="radio" name="money" value="5000">5000원</label>
                    <label><input type="radio" name="money" value="10000">10000원</label>
                </div>
                <div class="donateBtnContainer">
                    <button type="submit" id="rechargeBtn">결제하기</button>
                </div>
            </form>
        </div>
    </div>

    <div id="donationBoxOverlay">
    </div>
</body>

</html>