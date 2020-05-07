<?php

namespace app\data;

class BoardReplyData
{

    private $id;
    private $comment_id;
    private $writer;
    private $reply;
    private $date;

    public function getID()
    {
        return $this->id;
    }

    public function getCommentID()
    {
        return $this->comment_id;
    }

    public function getWriter()
    {
        return $this->writer;
    }

    public function getReply()
    {
        return $this->reply;
    }

    public function getDate()
    {
        return $this->date;
    }
}