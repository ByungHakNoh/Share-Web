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

    <!-- 라이브러리 폴더에 위치해 있음 다시 확인할 필요가 있다. -->
    <script src="library/summernote-ko-KR.js"></script>
    <!-- 자바 스크립트 코드 불러오기 -->
    <script defer src="app/views/javascript/board-write.js"></script>
</head>

<body>
    <?php require('holder/main/bodyHeadPage.php'); ?>

    <div class="writeContainer">
        <form id="writeForm" method="post" action="/board-writeHandler">
            <!-- <form id="writeForm"> -->
            <h4>제목 : <input id="title" type="text" name="title" /></h4>
            <textarea id="summernote" name="content"></textarea>
            <input type="submit" value="확인" />
        </form>
    </div>

</body>

</html>