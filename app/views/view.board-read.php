<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>share - 자유계시판 글</title>
    <?php require('holder/main/linkCss.php'); ?>
    <link rel="stylesheet" href="public/css/boardReadStyle.css">
    <script>
    let isLogin = ("<?= isset($_SESSION['userID']) ?>");
    </script>
    <script defer src="app/views/javascript/board-read.js"></script>
</head>

<body>
    <?php require('holder/main/bodyHeadPage.php'); ?>
    <div class="readContainer">
        <div id="information">
            <h1>제목 : <?= $postElements[0]->getTitle() ?></h1>
            <h3>글쓴이 : <?= $postElements[0]->getWriter() ?></h3>
            <h5>글쓴 날짜 : <?= $postElements[0]->getDate() ?></h5>
            <h5>조회수 : <?= $postElements[0]->getHit() + 1 ?></h5>
        </div>

        <div id="content">
            <?= $postElements[0]->getContent() ?>
        </div>

        <!-- 동일 닉네임이면 수정 삭제 버튼 생성 -->
        <?php if (isset($_SESSION['nickName'])) : ?>
        <?php if ($_SESSION['nickName'] === $postElements[0]->getWriter()) : ?>
        <div class="btnContainer">
            <form method="POST" action="/board-delete">
                <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                <input id="deleteSubmit" type="submit" value="삭제">
            </form>
            <form method="POST" action="/board-write">
                <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                <input id="modifySubmit" type="submit" value="수정">
            </form>
        </div>
        <?php endif ?>
        <?php endif ?>

        <div class="commentWriteContainer">
            <form method="POST" action="/board-comment">
                <textArea id="comment" name="comment"></textArea>
                <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                <input type="hidden" name="nickName"
                    value="<?= isset($_SESSION['nickName']) ? $_SESSION['nickName'] : null ?>">
                <input id="commentSubmit" type="submit" value="등록">
                <small id="commentWarning"></small>
            </form>
        </div>
        <?php if (isset($comments[0])) : ?>
        <?php foreach ($comments as $comment) : ?>

        <div class="commentReadContainer">

            <h4>By : <?= $comment->getWriter() ?></h4>
            <small><?= $comment->getDate() ?></small>

            <?php if (isset($_SESSION['nickName'])) : ?>
            <p><?= $_SESSION['nickName'] != $comment->getWriter() ?  $comment->getComment() : null ?></p>
            <?php else : ?>
            <p><?= $comment->getComment() ?></p>
            <?php endif ?>

            <?php if (isset($_SESSION['nickName'])) : ?>
            <?php if ($_SESSION['nickName'] == $comment->getWriter()) : ?>

            <div class="commentHandleContainer">
                <p><?= $comment->getComment() ?></p>
                <button hidden>취소</button>
                <button>수정</button>
                <form method="POST" action="/board-delete-comment">
                    <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                    <input type="hidden" name="deleteCommentID" value="<?= $comment->getID() ?>">
                    <input type="submit" value="삭제">
                </form>
                <form method="POST" action="/board-comment" hidden>
                    <textarea name="modifiedComment"></textarea>
                    <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                    <input type="hidden" name="modifiedCommentID" value="<?= $comment->getID() ?>">
                    <input id="addSubmit" type="submit" value="등록">
                </form>
            </div>

            <?php endif ?>
            <?php endif ?>
        </div>

        <?php $replies = $model->fetchReplyData($comment->getID()) ?>
        <?php if (isset($replies[0])) : ?>

        <?php foreach ($replies as $reply) : ?>
        <div class="replyReadContainer">

            <h4>Reply By : <?= $reply->getWriter() ?></h4>
            <small><?= $reply->getDate() ?></small>

            <?php if (isset($_SESSION['nickName'])) : ?>
            <p><?= $_SESSION['nickName'] != $reply->getWriter() ?  $reply->getReply() : null ?></p>
            <?php else : ?>
            <p><?= $reply->getReply() ?></p>
            <?php endif ?>

            <?php if (isset($_SESSION['nickName'])) : ?>
            <?php if ($_SESSION['nickName'] == $reply->getWriter()) : ?>

            <div class="replyHandleContainer">
                <p><?= $reply->getReply() ?></p>
                <button hidden>취소</button>
                <button>수정</button>
                <form method="POST" action="/board-delete-reply">
                    <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                    <input type="hidden" name="deleteReplyID" value="<?= $reply->getID() ?>">
                    <input type="submit" value="삭제">
                </form>
                <form method="POST" action="/board-reply" hidden>
                    <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                    <textarea name="modifiedReply"></textarea>
                    <input type="hidden" name="modifiedReplyID" value="<?= $reply->getID() ?>">
                    <input id="addSubmit" type="submit" value="등록">
                </form>
            </div>

            <?php endif ?>
            <?php endif ?>
        </div>
        <?php endforeach ?>
        <?php endif ?>

        <?php if (isset($_SESSION['nickName'])) : ?>
        <div class="replyWriteContainer">
            <form method="POST" action="/board-reply">
                <input type="hidden" name="id" value=<?= $postElements[0]->getID() ?>>
                <input type="hidden" name="commentID" value=<?= $comment->getID() ?>>
                <input type="hidden" name="writer" value="<?= $_SESSION['nickName'] ?>">
                <textarea name="reply"></textarea>
                <input type="submit" value="등록">
            </form>
        </div>
        <?php endif ?>
        <?php endforeach ?>
        <?php endif ?>
    </div>
</body>

</html>