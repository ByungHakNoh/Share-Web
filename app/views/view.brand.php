<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share - 브랜드</title>
    <?php require 'holder/main/linkCss.php'; ?>
    <link rel="stylesheet" href="public/css/mainBrandStyle.css?after">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <script defer src="app/views/javascript/brand.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- 로그인일 때만 평점 줄 수 있도록 구현하기 위해 닉네임 선언  -->
    <script>
        const nickName = '<?= isset($_SESSION['nickName']) ? $_SESSION['nickName'] : null ?>'
        const ratingRecordJSON = '<?= isset($ratingRecord) ? json_encode($ratingRecord) : null ?>'
    </script>
</head>

<body>
    <?php require 'holder/main/bodyHeadPage.php'; ?>
    <div class="bestBrandContainer">

    </div>

    <!-- <div class="tabBtnContainer">
        <button>최신 업데이트 순</button>
        <button>평점 순</button>
    </div> -->
    <main class="recentBrandContainer">
    </main>
    <footer>
    </footer>

</body>

</html>