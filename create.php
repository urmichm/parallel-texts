<?php
    
    require_once 'model/story_db.php';
    require_once "model/author_db.php";

    $PAGE_TITLE="New Story";

    session_start();
	$user_id = $_SESSION['user_id'] ?? null;
    if($user_id) {
		$author = get_author_by_id($user_id);
	} else {
        header("Location: login.php");
    }

    // !TODO: Deal with POST cycle and save to database
    $original_title = $_POST['original_title'] ?? null;
    $parallel_title = $_POST['parallel_title'] ?? null;
    $original_lang =  $_POST['original_language'] ?? null;
    $parallel_lang = $_POST['parallel_language'] ?? null;

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

                            <div class="field">
                                <label>Original:</label>
                                <textarea rows="1" ><?php echo $original_title ?></textarea>
                                <button class="ui button icon"><i class="save icon"></i></button>
                            </div>                            

                            <div class="field">
                                <label>Parallel Translation:</label>
                                <textarea rows="1" ><?php echo $parallel_title ?></textarea>
                                <button class="ui button icon save"><i class="save icon"></i></button>
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