<?php

class StoryPart {

    private $id;
    private $story_id;
    private $title;
    private $part_number;
    private $start_content_id;
    private $end_content_id;


    public function __construct($from_sql)
    {
        $this->id = $from_sql['id'];
        $this->story_id = $from_sql['story_id'];
        $this->title = $from_sql['title'];
        $this->part_number = $from_sql['part_number'];
        $this->start_content_id = $from_sql['start_content_id'];
        $this->end_content_id = $from_sql['end_content_id'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStoryId()
    {
        return $this->story_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function hasTitle()
    {
        return $this->title != null;
    }
    
    public function getPartNumber()
    {
        return $this->part_number;
    }

    public function getStartContentId()
    {
        return $this->start_content_id;
    }

    public function getEndContentId()
    {
        return $this->end_content_id;
    }
}
