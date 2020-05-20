<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share - news</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="public/css/mainNewsStyle.css?after">
</head>

<body>

    <?php require('holder/main/bodyHeadPage.php'); ?>
    <main class="mainContainer">

        <?php foreach ($scrapData[$currentPage] as $newsData) : ?>
            <div class="newsContainer">

                <figure>
                    <a href=<?= $newsData['link'] ?>>
                        <img src=<?= isset($newsData['image']) ? $newsData['image'] : 'src/image/no_image.png' ?> alt='이미지가 없습니다'>
                    </a>
                </figure>

                <div>
                    <a href=<?= $newsData['link'] ?>>
                        <h3><?= $newsData['title'] ?></h3>
                    </a>
                    <small><?= $newsData['date'] ?></small>
                </div>
            </div>
        <?php endforeach ?>

        <div class="pagination">
            <!-- 이전 버튼 생성 -->
            <?php if ($currentPage > 1) : ?>
                <a href=<?= '/news?page=' . ($currentPage - 1) ?>><button id="previousBtn">이전</button></a>
            <?php endif; ?>

            <!-- 페이징 버튼 생성 -->
            <?php for ($page = 1; $page <= count($scrapData); $page++) { ?>
                <?php if ($currentPage == $page) : ?>
                    <a href=<?= "/news?page={$page}" ?>><button class="active"><?= $page ?></button></a>
                <?php else : ?>
                    <a href=<?= "/news?page={$page}" ?>><button><?= $page ?></button></a>
                <?php endif; ?>
            <?php } ?>

            <!-- 다음 버튼 생성 -->
            <?php if ($currentPage < count($scrapData)) : ?>
                <a href=<?= '/news?page=' . ($currentPage + 1) ?>><button id="nextBtn">다음</button></a>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>