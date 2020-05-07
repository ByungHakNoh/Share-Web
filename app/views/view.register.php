<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link rel="stylesheet" href="public/css/registerStyle.css?after">
    <!-- 자바 스크립트 코드 불러오기 -->

    <script>
    let userList = ('<?= json_encode($userList) ?>');
    </script>
    <script defer src="app/views/javascript/register.js"></script>
</head>

<body>
    <div class="logo">
        <a href="/"><img src="/src/image/img.png" alt="logo" /></a>
    </div>
    <div class=container>
        <h1>회원가입 하기</h1>

        <form action="/registerHandler" method="POST">

            <p>사용자 아이디</p>
            <input id="userID" oninput="validate(this);" type="text" name="userID" placeholder="이메일 입력">
            <small id="userIDText">필수 입력란</small>

            <p>비밀번호</p>
            <input id="password" oninput="validate(this);" type="password" name="password" placeholder="비밀번호 입력">
            <small id="passwordText">필수 입력란</small>

            <p>비밀번호 확인</p>
            <input id="passwordCheck" oninput="validate(this);" type="password" name="passwordCheck"
                placeholder="비밀번호 확인">
            <small id="passwordCheckText">필수 입력란</small>

            <p>닉네임</p>
            <input id="nickName" oninput="validate(this);" type="text" name="nickName" placeholder="닉네임">
            <small id="nickNameText">필수 입력란</small>

            <p>성별</p>
            <select id="sex" name="sex" required>
                <option value="">성별 선택</option>
                <option value="man">남자</option>
                <option value="woman">여자</option>
            </select>

            <p>개인정보 수집 이용 안내</p>
            <div class="collectInfo">
                <h5>1. 수집 목적</h5>
                <p>
                    이용자는 회원가입을 하지 않아도 제한적으로 게시글을 읽을 수 있습니다.
                    하지만 글쓰기, 회원들만의 게시판 등은 사용이 불가능하며,
                    Share Fashion에서는 서비스 이용을 위해 필요한 최소한의 개인정보를 수집합니다.
                </p>
            </div>
            <label for="infoProvideCheckbox" required>개인정보 수집 동의
                <input id="infoProvideCheckbox" type="checkbox" name="isConsented" value="consented" required>
            </label>

            <input id=submitBtn type="submit" value="회원가입" disabled>
            <small id="submitBtnText">필수 입력란을 확인해주세요</small>
        </form>
    </div>

</body>

</html>