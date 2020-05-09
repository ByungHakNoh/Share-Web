<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>share - 관리자 페이지</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="public/css/adminStyle.css">
    <script>
        let visitorCountries = '<?= json_encode($visitorCountries); ?>'
        let monthlyVisitor = '<?= json_encode($monthlyVisitor); ?>'
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script defer src="app/views/javascript/admin.js"></script>
</head>

<body>
    <?php require('holder/main/bodyHeadPage.php'); ?>
    <div class="adminTabContainer">
        <div class="tapBtnContainer">
            <button onclick="panelController(0)">전체</button>
            <button onclick="panelController(1)">나라별 방문자</button>
            <button onclick="panelController(2)">월별 방문자</button>
        </div>

        <div class="adminTabPannel" id="visitorByCountry" style="width: 900px; height: 500px;"></div>
        <div class="adminTabPannel" id="monthlyVisitor" style="width: 900px; height: 500px;"></div>
    </div>
</body>

</html>