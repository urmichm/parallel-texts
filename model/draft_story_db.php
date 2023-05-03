<?php

    require_once 'sql_database.php';
    require_once 'domain/DraftStory.php';

    function put_draft_story($draft_story) :int
    {
        global $db;
        $query = 'INSERT INTO draft_stories
                     (title, updated_at, author_id, language_id, original_story_id)
                  VALUES
                     (:title, :updated_at, :author_id, :language_id, :original_story_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $draft_story->get_title());
        $statement->bindValue(':updated_at', $draft_story->get_updated_at());
        $statement->bindValue(':author_id', $draft_story->get_author_id());
        $statement->bindValue(':language_id', $draft_story->get_language_id());
        $statement->bindValue(':original_story_id', $draft_story->get_original_story_id());
        $statement->execute();
        $statement->closeCursor();

        $id = $db->lastInsertId();

        return $id;
    }

    function update_original_story_id_for_story_with_id($id, $original_story_id){
        global $db;
        $query = 'UPDATE draft_stories
                  SET original_story_id = :original_story_id
                  WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':original_story_id', $original_story_id);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    function get_draft_story_by_id($id) :DraftStory 
    {
        global $db;

        if(!is_numeric($id)) {
            throw new Exception('id must be numeric');
        }
        if($id < 1) {
            throw new Exception('id must be greater than 0');
        }

        $query = 'SELECT * FROM draft_stories WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $draft_story = $statement->fetchObject('DraftStory');

        $statement->closeCursor();

        return $draft_story;
    }

?>
