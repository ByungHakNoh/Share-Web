<?php

namespace app\data;

class CommentData
{

    private $id;
    private $writer;
    private $comment;
    private $date;

    public function getID()
    {
        return $this->id;
    }
    public function getWriter()
    {
        return $this->writer;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getDate()
    {
        return $this->date;
    }
}