<?php

class Story {

    private $id;
    private $title;
    private $author_id;
    private $language_id;
    private $original_story_id;

    private $story_parts;

    // create constructor with an array parameter
    public function __construct($from_sql)
    {
        $this->id = $from_sql['id'];
        $this->title = $from_sql['title'];
        $this->author_id = $from_sql['author_id'];
        $this->language_id = $from_sql['language_id'];
        $this->original_story_id = $from_sql['original_story_id'];
    }

    // get id
    public function getId()
    {
        return $this->id;
    }

    // get title
    public function getTitle()
    {
        return $this->title;
    }

    // get original story id
    public function getOriginalStoryId()
    {
        return $this->original_story_id;
    }



    public function loadStoryParts() {
        $this->story_parts = get_story_parts($this->id);
    }

    // get story parts
    public function getStoryParts() {
        return $this->story_parts;
    }

}
