<?php

namespace app\models;

require 'app/data/BoardPostData.php';
require 'app/data/BoardReadData.php';
require 'app/data/CommentData.php';
require 'app/data/BoardReplyData.php';

use core\App;
use core\mvc\Model;
use DOMDocument;

class BoardModel extends Model
{
    private $tableName = 'free_board';

    // 자유게시판 목록을 보여주는 메소드
    public function fetchPostData($currentPage, $resultPerPage)
    {
        $dataClass = 'app\data\BoardPostData';

        $numberOfPage = App::get('database')->paginationPageNum($this->tableName, $resultPerPage);
        $postList = App::get('database')->pagination($this->tableName, $dataClass, $currentPage, $resultPerPage);

        $this->returnedData['numberOfPage'] = $numberOfPage;
        $this->returnedData['postList'] = $postList;
    }

    // 자유게시판 글을 읽는 페이지를 들어갈 때 사용하는 메소드 -> 클릭한 계시글에 관한 글을 데이터베이스에서 가져온다.
    public function fetchBoardData($requestID)
    {
        $dataClass = 'app\data\BoardReadData';
        $postElements = App::get('database')->fetchValueByID($this->tableName, $requestID, $dataClass);

        $addedHitCount = $postElements[0]->getHit() + 1;

        App::get('database')->updateByID($this->tableName, $requestID, ['hit' =>  $addedHitCount]);

        $this->returnedData['postElements'] = $postElements;
    }

    // 자유게시판에 글을 쓸 때 사용하는 메소드로 이미지, 동영상이 있을 시 서버 컴퓨터에 파일 저장 후 데이터 베이스에 저장한다
    public function uploadScript($writer, $title, $content)
    {
        $content = $this->prepareContent($content);
        $this->savePost($writer, $title, $content);
    }

    // 게시물 수정하는 메소드로 이미지, 동영상이 있을 시 서버 컴퓨터에 파일 저장 후 데이터 베이스에 저장한다
    public function modifyScript($requestID, $title, $content)
    {
        $content = $this->prepareContent($content);
        $this->updatePost($requestID, $title, $content);
    }

    // 게시물 삭제하기 
    public function deletePost($requestID)
    {
        App::get('database')->deleteByID($this->tableName, $requestID);
    }

    // 댓글 정보 가져오기
    public function fetchCommentData($postID)
    {
        $tableName = 'free_board_comment';
        $keyValueData = ['post_id' => $postID];
        $dataClass = 'app\data\CommentData';
        $comments = App::get('database')->fetchValueByName($tableName, $keyValueData, $dataClass);
        $this->returnedData['comments'] = $comments;
    }

    // 댓글 추가하기
    public function addComment($postID, $writer, $comment)
    {
        $this->saveComment($postID, $writer, $comment);
    }

    // 댓글 수정하기
    public function modifyComment($modifiedCommentID, $modifiedComment)
    {
        $tableName = 'free_board_comment';
        $keyValueData = ['comment' => "'" . $modifiedComment . "'"];
        App::get('database')->updateByID($tableName, $modifiedCommentID, $keyValueData);
    }

    // 댓글 삭제하기
    public function deleteComment($requestID)
    {
        $tableComment = 'free_board_comment';
        $tableReply = 'free_board_reply';
        $columnName = 'comment_id';
        App::get('database')->deleteByID($tableComment, $requestID);
        App::get('database')->deleteByColumn($tableReply, $columnName, $requestID);
    }


    // 답글 정보 가져오기
    public function fetchReplyData($commentID)
    {
        $tableName = 'free_board_reply';
        $keyValueData = ['comment_id' => $commentID];

        $dataClass = 'app\data\BoardReplyData';
        $replies = App::get('database')->fetchValueByName($tableName, $keyValueData, $dataClass);
        return $replies;
    }

    public function addReply($commentID, $writer, $reply)
    {
        $this->saveReply($commentID, $writer, $reply);
    }

    public function modifyReply($modifiedReplyID, $modifiedReply)
    {
        $tableName = 'free_board_reply';
        $keyValueData = ['reply' => "'" . $modifiedReply . "'"];
        App::get('database')->updateByID($tableName, $modifiedReplyID, $keyValueData);
    }

    public function deleteReply($requestID)
    {
        $tableName = 'free_board_reply';
        App::get('database')->deleteByID($tableName, $requestID);
    }



    // --- 코드 정리를 위한 메소드 생성 --- 
    private function prepareContent($content)
    {
        // if (strpos($content, '<img') && strpos($content, ';base64')) {
        if (strpos($content, ';base64')) {

            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML('<?xml encoding="utf-"?>' . $content);
//코드 정렬이 맞지 않아 php 열고 닫아줌 -> 추후 수정 요망
?>
<?php
            if (strpos($content, '<img')) {
                $imageTags = $doc->getElementsByTagName('img');
                $this->modifyTagElement($imageTags, 'image');
            }

            if (strpos($content, '<video')) {
                $videoTags = $doc->getElementsByTagName('video');
                $this->modifyTagElement($videoTags, 'video');
            }

            $content = $doc->saveHTML();
            return $content;
        }
        return $content;
    }

    private function modifyTagElement($tags, $type)
    {
        foreach ($tags as $tag) {
            $srcInString = $tag->getAttribute('src');
            $img = $this->decodeBase64($srcInString);

            // 파일의 타입 가져오기
            $dataInfo = explode(";", $srcInString)[0];
            $fileExt = str_replace("data:{$type}/", '', $dataInfo);

            // 고유한 이름을 부여하여 이미지 파일이름을 정하고 파일 객체 생성
            $newFileName = str_replace(".", "", uniqid("free-board:", true));
            $filename = $newFileName . '.' . $fileExt;
            $file = "src/{$type}/{$type}-database/" . $filename;

            // 이미지 서버 컴퓨터에 저장하기
            file_put_contents($file, $img);
            $url = 'http://192.168.56.1/' . $file;

            $tag->setAttribute('src', $url);
            $tag->setAttribute('data-original-filename', $tag->getAttribute('data-filename'));
            $tag->removeAttribute('data-filename');
        }
    }

    private function decodeBase64($srcInString)
    {
        // string으로 인코딩된 base64 가져오기
        $base64EncData = substr($srcInString, ($pos = strpos($srcInString, 'base64,')) ? $pos + 7 : 0);
        $base64EncData = substr($base64EncData, 0, -1);

        // base64로 된 이미지, 비디오를 디코드한다
        return base64_decode($base64EncData);
    }

    private function savePost($wrtier, $title, $content)
    {
        $date = date('Y-m-d');

        App::get('database')->insertData($this->tableName, [
            'writer' => '"' . $wrtier . '"',
            'title' => '"' . $title . '"',
            'date' => '"' . $date . '"',
            'content' => "'" . $content . "'"
        ]);
    }

    private function updatePost($requestID, $title, $content)
    {
        App::get('database')->updateBoardScript($this->tableName, $requestID, [
            'title' =>  '"' . $title . '"',
            'content' => "'" . $content . "'"
        ]);
    }

    private function saveComment($postID, $writer, $comment)
    {
        // 댓글 테이블 이름 따로 입력
        $tableName = 'free_board_comment';

        App::get('database')->insertData($tableName, [
            'post_id' =>  $postID,
            'writer' => '"' . $writer . '"',
            'comment' => "'" . $comment . "'"
        ]);
    }

    private function saveReply($commentID, $writer, $reply)
    {
        $tableName = 'free_board_reply';

        App::get('database')->insertData($tableName, [
            'comment_id' =>  $commentID,
            'writer' => '"' . $writer . '"',
            'reply' => "'" . $reply . "'"
        ]);
    }
}