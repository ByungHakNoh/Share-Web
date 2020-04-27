<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>share - 자유 계시판 글쓰기</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="css/boardWriteStyle.css">

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

    <!-- summernote 실행 및 설정 메소드  -->
    <script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'content',
            minHeight: 700,
            maxHeight: 700,
            focus: true,
            lang: 'ko-KR'
        });
    });
    </script>
</head>

<body>
    <?php require('holder/main/bodyHeadPage.php'); ?>

    <div class="writeContainer">
        <form method="post" action="/board-write">
            <h4>제목 : <input type="text" name="title" value=<?= $title ?> /></h4>
            <textarea id="summernote" name="content" value=<?= $content ?>></textarea>
            <input type="submit" value="글 작성" />
        </form>
    </div>

</body>

</html>