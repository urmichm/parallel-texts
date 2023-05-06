<?php
    
    require_once 'model/draft_story_db.php';
    require_once "model/author_db.php";
    require_once 'model/domain/DraftStory.php';

    $PAGE_TITLE="New Story";

    session_start();
	$user_id = $_SESSION['user_id'] ?? null;
    if($user_id) {
		$author = get_author_by_id($user_id);
	} else {
        header("Location: login.php");
    }

    if( isset($_POST['original_title']) && isset($_POST['parallel_title'])) 
    {
        $original_title = $_POST['original_title'] ?? null;
        $parallel_title = $_POST['parallel_title'] ?? null;
        $original_lang =  $_POST['original_language'] ?? null;
        $parallel_lang = $_POST['parallel_language'] ?? null;
        
        $original_story = new DraftStory();
        $original_story
            ->set_title($original_title)
            ->set_updated_at(date("Y-m-d H:i:s"))
            ->set_author_id($author->get_id())
            ->set_language_id($original_lang)
            ->set_original_story_id(null);
        
        $original_story_id = put_draft_story($original_story);

        $parallel_story = new DraftStory();
        $parallel_story
            ->set_title($parallel_title)
            ->set_updated_at(date("Y-m-d H:i:s"))
            ->set_author_id($author->get_id())
            ->set_language_id($parallel_lang)
            ->set_original_story_id($original_story_id);
        
        $parallel_story_id = put_draft_story($parallel_story);

        header("Location: create.php?story_id=$parallel_story_id");
        return;
    }
    else if ($_GET['story_id']) {
        $parallel_story_id = $_GET['story_id'];
        $parallel_story = get_draft_story_by_id( $parallel_story_id );

        $parallel_title = $parallel_story->get_title();
        $parallel_lang = $parallel_story->get_language_id();

        $original_story_id = $parallel_story->get_original_story_id();

        if(0 == $original_story_id) {
            header("Location: error.php");
            return;
        }

        $original_story = get_draft_story_by_id($original_story_id);
        $original_title = $original_story->get_title();
        $original_lang = $original_story->get_language_id();
    }
?>

<!DOCTYPE html>
<html>
    <?php include "view/head.php"; ?>

<body>
    <?php include "view/header.php"; ?>
    
    <div class="ui grid">
        <div class="two wide column">
            <div class="ui vertical menu">

            </div>
        </div>

        <div class="fourteen wide  column">
            <div class="ui container">

                <!-- Title of the Story -->
                <label>Title:</label>
                <div class="ui form">
                    <div class="ui segment">
                        <div class="two fields">

                            <div class="field" id="original-title-block">
                                <label>Original:</label>
                                <input type="hidden" id="original-story-id" value="<?php echo $original_story_id ?>">
                                <textarea rows="1"><?php echo $original_title ?></textarea>
                            </div>

                            <div class="field" id="parallel-title-block">
                                <label>Parallel Translation:</label>
                                <input type="hidden" id="parallel-story-id" value="<?php echo $parallel_story_id ?>">
                                <textarea rows="1"><?php echo $parallel_title ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content of the story -->
                <label>Story Parts:</label>
                <div class="ui form">
                    <div class="ui segment">
                        <div class="two fields">

                            <div class="field" id="original-text"> </div>                            

                            <div class="field" id="translated-text"> </div>
                        </div>

                        <!-- button to add another text input couple -->
                        <button class="ui button" type="button" id="add-text">+</button>
                    </div>
                </div>

                <button class="ui primary button" id="publish-button">Publish</button>

            </div>

        </div>
    </div>



    <?php include "view/scripts.php"; ?>

    <script src="javascript/create.js"></script>

</body>