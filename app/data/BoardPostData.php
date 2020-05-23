<?php

namespace app\data;

class BoardPostData
{

    private $id;
    private $writer;
    private $title;
    private $date;
    private $hit;
    private $comment_count;

    public function getID()
    {
        return $this->id;
    }

    public function getWriter()
    {
        return $this->writer;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getHit()
    {
        return $this->hit;
    }

    public function getCommentCount()
    {
        return $this->comment_count;
    }
}
