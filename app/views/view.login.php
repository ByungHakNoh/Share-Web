<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <link rel="stylesheet" href="public/css/loginStyle.css?after">
    <script defer src="app/views/javascript/login.js"></script>
</head>

<body>
    <div class="logo">
        <a href="/"><img src="/src/image/img.png" alt="logo" /></a>
    </div>
    <div class=container>
        <img src="src/image/log_in.png" class="icon">
        <h1>로그인 하기</h1>
        <small><?= isset($loginError) ? $loginError : "" ?></small>

        <form method="POST" action="/login-startSession">
            <p>사용자 아이디</p>
            <input id="userID" type="text" name="userID" placeholder="이메일 입력"
                value=<?= isset($userID) ? $userID : ''; ?>>
            <small id="userIDText"></small>

            <p>비밀번호</p>
            <input id="password" type="password" name="password" placeholder="비밀번호 입력">
            <small id="passwordText"></small>

            <input id="submitBtn" type="submit" value="로그인">
            <a href="#">아이디/비밀번호 찾기</a>
            <a href="/register">회원가입하기</a>
        </form>
    </div>

</body>

</html>