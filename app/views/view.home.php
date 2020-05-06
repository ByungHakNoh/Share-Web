<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>share - home</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="public/css/mainHomeStyle.css?after">
    <script defer src="app/views/javascript/home.js"></script>
</head>

<body>

    <?php require('holder/main/bodyHeadPage.php'); ?>

    <?php if (!isset($_COOKIE['notToday'])) : ?>
    <div id="cookieContainer" class="cookieContainer">
        <p>
            Share-Fashion에 오신것을 환영합니다.
            다양한 패션 정보를 공유해보세요.
        </p>
        <div class="btnContainer">
            <input id="closeBtn" type="button" value="닫기">
            <form method="POST" action="/cookie-handler">
                <input type="hidden" name="notToday">
                <input id="notTodayBtn" type="submit" value="오늘 하루 보지 않기">
            </form>
        </div>
    </div>
    <?php endif ?>
    <div class="homeMainBoard">
        <div class="M">
            패션 소식
        </div>

        <div class="M">
            패션 정보
        </div>

        <div class="M">
            자유 계시판
        </div>
    </div>
</body>

</html>