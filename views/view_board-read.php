<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>share - 자유계시판 글</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="css/boardReadStyle.css">
</head>

<body>
    <?php require('holder/main/bodyHeadPage.php'); ?>

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
    </div>
</body>

</html>