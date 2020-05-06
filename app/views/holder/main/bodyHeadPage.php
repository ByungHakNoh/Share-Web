<nav class="sign_in">
    <ul>
        <?php if (isset($_SESSION['userID'])) :  ?>
        <li><?= $_SESSION['nickName'] ?></li>
        <li>|</li>
        <li><a href="/logout">로그아웃</a></li>
        <?php else : ?>
        <li><a href="/login">로그인</a></li>
        <li><a href="/register">회원가입</a></li>
        <?php endif ?>
    </ul>
</nav>
<div class="logo">
    <a href="/"><img src="/src/image/img.png" alt="logo" /></a>
</div>

<nav class="navigation">
    <ul>
        <li><a href="/">홈</a></li>
        <li><a href="/news">패션 소식</a></li>
        <li><a href="/information">패션 정보</a></li>
        <li><a href="/board">자유 게시판</a></li>
        <li><a href="/broadcast">방송하기</a></li>
    </ul>
</nav>