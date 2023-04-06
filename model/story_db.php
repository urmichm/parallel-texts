<?php
    
    include_once 'domain/Story.php';
    include_once 'domain/StoryPart.php';

    function get_all_stories()
    {
        global $db;
        $query = 'SELECT id, title FROM stories
                  ORDER BY id';
        $statement = $db->prepare($query);
        $statement->execute();
        $stories = $statement->fetchAll();
        $statement->closeCursor();
        return $stories;
    }

    function get_story($story_id)
    {
        global $db;
        $query = 'SELECT * FROM stories
                  WHERE id = :story_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':story_id', $story_id);
        $statement->execute();
        $query_result = $statement->fetch();
        $statement->closeCursor();

        $story = new Story($query_result);
        return $story;
    }

    function get_story_parts($story_id)
    {
        global $db;
        $query = 'SELECT * FROM story_part
                  WHERE story_id = :story_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':story_id', $story_id);
        $statement->execute();
        $query_result = $statement->fetchAll();
        $statement->closeCursor();

        $result = array();

        foreach ($query_result as $part) {
            array_push($result, new StoryPart($part)); 
        }

        return $result;
    }

    function get_story_content($start_content_id, $end_content_id)
    {
        global $db;
        $query = 'SELECT * FROM content
                  WHERE id BETWEEN :start_content_id AND :end_content_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':start_content_id', $start_content_id);
        $statement->bindValue(':end_content_id', $end_content_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        
        return $result;
    }
        

?>