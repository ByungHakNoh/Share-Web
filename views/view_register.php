<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <?php require('holder/signIn/linkCss.php'); ?>
    <!-- 자바 스크립트 코드 불러오기 -->
    <script defer src="javascript/register.js"></script>
</head>

<body>
    <?php require('holder/signIn/bodyHeadPage.php'); ?>
    <div class=container>
        <img src="src/image/register.png" class="icon">
        <h1>회원가입 하기</h1>

        <form id="registerForm" method="POST" action="/registerHandler">
            <p>사용자 아이디</p>
            <input id="userID" type="text" name="userID" placeholder="이메일 입력">

            <p>비밀번호</p>
            <input id="password" type="password" name="password" placeholder="비밀번호 입력">

            <p>비밀번호 확인</p>
            <input id="passwordCheck" type="password" name="passwordCheck" placeholder="비밀번호 확인">
            <span id="passwordSuccess">비밀번호가 일치합니다.</span>
            <span id="passwordFailed">비밀번호가 일치하지 않습니다.</span>
            <input type="submit" value="회원가입">
        </form>
    </div>

</body>

</html>