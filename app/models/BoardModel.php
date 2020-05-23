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

    public function fetchDataByID($startNumber, $endNumber, $order)
    {
        $dataClass = 'app\data\BoardPostData';
        $columnName = 'id';
        $postList = App::get('database')->fetchLimitedValues($this->tableName, $columnName, $order, $startNumber, $endNumber, $dataClass);
        $this->returnedData['postListByID'] = $postList;
    }

    public function fetchDataByHit($startNumber, $endNumber, $order)
    {
        $dataClass = 'app\data\BoardPostData';
        $columnName = 'hit';
        $postList = App::get('database')->fetchLimitedValues($this->tableName, $columnName, $order, $startNumber, $endNumber, $dataClass);
        $this->returnedData['postListByHit'] = $postList;
    }

    // 자유게시판 목록을 보여주는 메소드
    public function fetchPostData($currentPage, $resultPerPage)
    {
        $dataClass = 'app\data\BoardPostData';

        $numberOfPage = App::get('database')->paginationPageNum($this->tableName, $resultPerPage);
        $postList = App::get('database')->pagination($this->tableName, $dataClass, $currentPage, $resultPerPage);

        $this->dataForPagination($currentPage, $numberOfPage);
        $this->returnedData['currentPage'] = $currentPage;
        $this->returnedData['numberOfPage'] = $numberOfPage;
        $this->returnedData['postList'] = $postList;
    }

    // 페이징 시작 번호와 끝 번호 정하는 메소드
    private function dataForPagination($currentPage, $numberOfPage)
    {
        $startPage = null;
        $endPage = null;

        if ($numberOfPage <= 10) {
            $startPage = 1;
            $endPage = $numberOfPage;
        } else {
            if ($currentPage <= 10) {
                $startPage = 1;
                $endPage = 10;
            } else {

                $firstDigit = substr($currentPage, strlen($currentPage) - 1);

                if ($firstDigit == 0) {

                    $startPage = substr($currentPage, 0, strlen($currentPage) - 1) * 10 - 9;
                    $endPage = $startPage + 10 - 1;
                } else {

                    $startPage = substr($currentPage, 0, strlen($currentPage) - 1) * 10 + 1;
                    $endPage = $startPage + 10 - 1;

                    if ($numberOfPage < $endPage) {

                        $endPage = $numberOfPage;
                    }
                }
            }
        }

        $this->returnedData['startPage'] = $startPage;
        $this->returnedData['endPage'] = $endPage;
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
        // 댓글 겟수 증가
        $keyValueData = ['comment_count' => 'comment_count+1'];
        $this->saveComment($postID, $writer, $comment);
        App::get('database')->updateByID($this->tableName, $postID,  $keyValueData);
    }

    // 댓글 수정하기
    public function modifyComment($modifiedCommentID, $modifiedComment)
    {
        $tableName = 'free_board_comment';
        $keyValueData = ['comment' => "'" . $modifiedComment . "'"];
        App::get('database')->updateByID($tableName, $modifiedCommentID, $keyValueData);
    }

    // 댓글 삭제하기
    public function deleteComment($postID, $commentID)
    {
        $tableComment = 'free_board_comment';
        $tableReply = 'free_board_reply';
        $columnName = 'comment_id';
        // 댓글 갯수 감소
        $keyValueData = ['comment_count' => 'comment_count-1'];

        App::get('database')->deleteByID($tableComment, $commentID);
        App::get('database')->deleteByColumn($tableReply, $columnName, $commentID);
        App::get('database')->updateByID($this->tableName, $postID,  $keyValueData);
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
        }
        return $content;
    }

    private function modifyTagElement($tags, $type)
    {
        foreach ($tags as $tag) {

            $isLocal = $tag->getAttribute('data-local');

            // 로컬에 저장이 되어있지 않다면 src를 변환하여 로컬에 저장
            if ($isLocal == null) {
                $srcInString = $tag->getAttribute('src');
                $content = $this->decodeBase64($srcInString);

                // 파일의 타입 가져오기
                $dataInfo = explode(";", $srcInString)[0];
                $fileExt = str_replace("data:{$type}/", '', $dataInfo);

                // 고유한 이름을 부여하여 이미지 파일이름을 정하고 파일 객체 생성
                $newFileName = str_replace(".", "", uniqid("free-board:", true));
                $filename = $newFileName . '.' . $fileExt;
                $file = "src/{$type}/{$type}-database/" . $filename;

                // 이미지 서버 컴퓨터에 저장하기
                file_put_contents($file, $content);
                $url = 'https://share-fashion.ga/' . $file;

                $tag->setAttribute('src', $url);
                // 로컬로 저장되어 있는지 여부를 확인하는 요소
                $tag->setAttribute('data-local', true);
                $tag->removeAttribute('data-filename');
            }
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
