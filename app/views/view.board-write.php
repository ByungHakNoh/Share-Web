<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>share - 자유 계시판 글쓰기</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="public/css/boardWriteStyle.css">

    <!-- summernote -->
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

    <!-- 자바 스크립트 코드 불러오기 -->
    <script>
    let initContent = '<?= json_encode(isset($postElements) ? $postElements[0]->getContent() : "") ?>'
    </script>
    <script defer src="app/views/javascript/board-write.js"></script>
</head>

<body>
    <?php require('holder/main/bodyHeadPage.php'); ?>
    <div class="writeContainer">
        <form id="writeForm" method="POST" action="/board-writeHandler">
            <h3>제목 : <input id="title" type="text" name="title"
                    value="<?= isset($postElements) ? $postElements[0]->getTitle() : null ?>"></h3>

            <h4>동영상 파일</h4><input id="videoInput" type="file" accept=".mp4">
            <textarea id="summernote" name="content"></textarea>
            <input type="hidden" name="id" value=<?= isset($requestID) ? $requestID : null ?>>
            <input type="submit" value="확인" />
        </form>
    </div>

</body>

</html>