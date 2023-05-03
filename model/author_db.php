<?php 
    require_once 'sql_database.php';
    require_once 'domain/Author.php';

    function get_author_by_email($email)
    {
        global $db;
        $query = 'SELECT * FROM authors
                  WHERE email = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        // fetch an author from db as object of class Author 
        $query_result = $statement->fetchObject('Author');
        $statement->closeCursor();

        return $query_result;
    }

    function get_author_by_id($id) : Author
    {
        global $db;
        $query = 'SELECT * FROM authors
                  WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $query_result = $statement->fetchObject('Author');
        $statement->closeCursor();

        return $query_result;

    }

?>