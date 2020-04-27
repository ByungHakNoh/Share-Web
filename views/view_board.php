<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share - board</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="css/mainBoardStyle.css?after">
</head>

<body>

    <?php require('holder/main/bodyHeadPage.php'); ?>

    <div class="boardContainer">
        <h1>자유게시판</h1>
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

            <!-- 바디 부분 테스트용으로 바꿔야 함 -->
            <tbody>
                <tr>
                    <td width="70">1</td>
                    <td width="700">이거 좀 보셈</a></td>
                    <td width="150">대박</td>
                    <td width="120">정말?</td>
                    <td width="100">오우</td>
                </tr>
            </tbody>
        </table>

        <div>
            <a href="/board-write"><button>글쓰기</button></a>
        </div>
    </div>

</body>

</html>