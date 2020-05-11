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

        <div class="boardContainer">
            <h3>자유 계시판</h3>
            <a id="moreInfo" href="/board">더 많은 내용보기</a>
            <div class="tapBtnContainer">
                <button class="active" id="recentPostBtn">최신 순</button>
                <button id="viewsPostBtn">조회수 순</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="70">번호</th>
                        <th width="700">제목</th>
                        <th width="150">작성자</th>
                        <th width="120">작성일</th>
                        <th width="100">조회수</th>
                    </tr>
                </thead>
                <tbody id="recentPostContainer">
                    <?php foreach ($postListByID as $post) : ?>
                        <tr>
                            <td width="70"><?= $post->getID(); ?></td>
                            <td width="700"><a href=<?= '/board-read?id=' . $post->getID(); ?>><?= $post->getTitle(); ?></a>
                            </td>
                            <td width="150"><?= $post->getWriter(); ?></td>
                            <td width="120"><?= $post->getDate(); ?></td>
                            <td width="100"><?= $post->getHit(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tbody id="viewsPostContainer" hidden>
                    <?php foreach ($postListByHit as $post) : ?>
                        <tr>
                            <td width="70"><?= $post->getID(); ?></td>
                            <td width="700"><a href=<?= '/board-read?id=' . $post->getID(); ?>><?= $post->getTitle(); ?></a>
                            </td>
                            <td width="150"><?= $post->getWriter(); ?></td>
                            <td width="120"><?= $post->getDate(); ?></td>
                            <td width="100"><?= $post->getHit(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</body>

</html>