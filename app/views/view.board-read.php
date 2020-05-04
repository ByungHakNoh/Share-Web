<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>share - 자유계시판 글</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="public/css/boardReadStyle.css">
</head>

<body>
    <?php require('holder/main/bodyHeadPage.php'); ?>

    <div class="container">
        <div class="readContainer">
            <div id="information">
                <h1>제목 : <?= $postElements[0]->getTitle() ?></h1>
                <h3>글쓴이 : <?= $postElements[0]->getWriter() ?></h3>
                <h5>글쓴 날짜 : <?= $postElements[0]->getDate() ?></h5>
                <h5>조회수 : <?= $postElements[0]->getHit() + 1 ?></h5>
            </div>

            <div id="content">
                <?= $postElements[0]->getContent() ?>
            </div>

            <!-- 동일 닉네임이면 수정 삭제 버튼 생성 -->
            <?php if (isset($_SESSION['nickName'])) : ?>
            <?php if ($_SESSION['nickName'] === $postElements[0]->getWriter()) : ?>
            <div class="btnContainer">
                <form method="POST" action="/board-delete">
                    <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                    <input id="deleteSubmit" type="submit" value="삭제">
                </form>
                <form method="POST" action="/board-write">
                    <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                    <input id="modifySubmit" type="submit" value="수정">
                </form>
            </div>

            <?php endif ?>
            <?php endif ?>

            <div class="commentContainer">
                <form method="POST" action="/board-writeHandler">
                    <textArea></textArea>
                    <input type="submit" value="등록">
                </form>
            </div>
        </div>
    </div>
</body>

</html>