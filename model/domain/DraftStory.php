<?php

class DraftStory {

    private $id;
    private $title;
    private $updated_at;
    private $author_id;
    private $language_id;
    private $original_story_id;



    public function get_id() {
        return $this->id;
    }

    public function set_id($id) :DraftStory {
        $this->id = (int) $id;
        return $this;
    }

    public function get_title() {
        return $this->title;
    }

    public function set_title($title) :DraftStory {
        $this->title = $title;
        return $this;
    }

    public function get_updated_at() {
        return $this->updated_at;
    }

    public function set_updated_at($updated_at) :DraftStory {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function get_author_id() {
        return $this->author_id;
    }

    public function set_author_id($author_id) :DraftStory {
        $this->author_id = (int) $author_id;
        return $this;
    }

    public function get_language_id() {
        return $this->language_id;
    }

    public function set_language_id($language_id) :DraftStory {
        $this->language_id = (int) $language_id;
        return $this;
    }

    public function get_original_story_id() {
        return $this->original_story_id;
    }

    public function set_original_story_id($original_story_id) :DraftStory {
        $this->original_story_id = (int) $original_story_id;
        return $this;
    }

}

?>