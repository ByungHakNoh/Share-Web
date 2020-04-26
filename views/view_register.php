<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <?php require('holder/signIn/linkCss.php'); ?>
</head>

<body>

    <div class=container>
        <img src="src/image/register.png" class="icon">
        <h1>회원가입 하기</h1>

        <div class="warnging">
            <ul>
                <?php foreach ($errorsArray as $error) : ?>
                <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </div>

        <form method="POST" action="/register">
            <p>사용자 아이디</p>
            <input type="text" name="userID" placeholder="이메일 입력" value=<?= $userID ?>>

            <p>비밀번호</p>
            <input type="password" name="password" placeholder="비밀번호 입력" value=<?= $password ?>>

            <p>비밀번호 확인</p>
            <input type="password" name="passwordCheck" placeholder="비밀번호 확인" value=<?= $passwordCheck ?>>

            <input type="submit" value="회원가입">
        </form>
    </div>

</body>

</html>