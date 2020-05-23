<?php

namespace app\controllers;

use core\mvc\Controller;

class BoardController extends Controller
{
    public function board()
    {
        $resultPerPage = 15;
        if (isset($_GET['page'])) {
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }

        $model = $this->createModel('BoardModel');
        $model->fetchPostData($currentPage, $resultPerPage);

        $viewData = $model->getReturnedData();
        $view = $this->createView('board', $viewData);
        return $view->loadView();
    }

    public function boardRead()
    {
        $requestID = $_GET['id'];

        $model = $this->createModel('BoardModel');
        $model->fetchBoardData($requestID);
        $model->fetchCommentData($requestID);

        $viewData = $model->getReturnedData();
        $viewData['model'] = $model;
        $view = $this->createView('board-read', $viewData);
        return $view->loadView();
    }

    // 글쓰기 페이지를 관리하는 메소드
    public function boardWrite()
    {
        // 게시글 수정하는 경우
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestID = $_POST['id'];

            $model = $this->createModel('BoardModel');
            $model->fetchBoardData($requestID);

            $viewData = $model->getReturnedData();
            $viewData['requestID'] = $requestID;
            $view = $this->createView('board-write', $viewData);
            return $view->loadView();

            // 글쓰기 페이지에 접속한 경우
        } else {
            $view = $this->createView('board-write');
            return $view->loadView();
        }
    }

    // 게시글 쓰기, 수정하기를 관리하는 메소드
    public function boardWriteHandler()
    {
        // 사용자가 게시글을 추가하는 경우
        $writer = $_SESSION['nickName'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $directUrl = 'board';

        $model = $this->createModel('BoardModel');

        // 계시글 처음 작성 시 
        if ($_POST['id'] == null) {

            $model->uploadScript($writer, $title, $content);
            header("Location:/{$directUrl}");
            exit;

            // 게시글 수정 시
        } else {
            $model->modifyScript($_POST['id'], $title, $content);
            header("Location:/{$directUrl}");
            exit;
        }
    }

    // 게시글 삭제를 관리하는 메소드
    public function boardDeletePost()
    {
        $requestID = $_POST['id'];
        $directUrl = 'board';

        $model = $this->createModel('BoardModel');
        $model->deletePost($requestID);
        header("Location:/{$directUrl}");
        exit;
    }

    // 게시판 댓글 추가 수정을 관리
    public function boardComment()
    {
        $postID = $_POST['id'];
        $directUrl = 'board-read';
        $model = $this->createModel('BoardModel');

        //댓글을 추가할 경우
        if (!isset($_POST['modifiedCommentID'])) {
            $writer = $_POST['nickName'];
            $comment = $_POST['comment'];

            $model->addComment($postID, $writer, $comment);

            header("Location:/{$directUrl}?id={$postID}");
            exit;

            // 댓글을 수정할 경우
        } else {

            $modifiedCommentID = $_POST['modifiedCommentID'];
            $modifiedComment = $_POST['modifiedComment'];

            $model->modifyComment($modifiedCommentID, $modifiedComment);

            header("Location:/{$directUrl}?id={$postID}");
            exit;
        }
    }

    public function boardDeleteComment()
    {
        $postID = $_POST['id'];
        $deleteCommentID = $_POST['deleteCommentID'];
        $directUrl = 'board-read';

        $model = $this->createModel('BoardModel');
        $model->deleteComment($postID, $deleteCommentID);
        header("Location:/{$directUrl}?id={$postID}");
        exit;
    }

    public function boardReply()
    {
        $postID = $_POST['id'];
        $directUrl = 'board-read';
        $model = $this->createModel('BoardModel');

        if (!isset($_POST['modifiedReplyID'])) {

            $commentID = $_POST['commentID'];
            $writer = $_POST['writer'];
            $reply = $_POST['reply'];

            $model->addReply($commentID, $writer, $reply);

            header("Location:/{$directUrl}?id={$postID}");
            exit;
        } else {

            $modifiedReplyID = $_POST['modifiedReplyID'];
            $modifiedReply = $_POST['modifiedReply'];

            $model->modifyReply($modifiedReplyID, $modifiedReply);

            header("Location:/{$directUrl}?id={$postID}");
            exit;
        }
    }

    public function boardDeleteReply()
    {
        $postID = $_POST['id'];
        $deleteReplyID = $_POST['deleteReplyID'];
        $directUrl = 'board-read';

        $model = $this->createModel('BoardModel');
        $model->deleteReply($deleteReplyID);
        header("Location:/{$directUrl}?id={$postID}");
        exit;
    }
}
