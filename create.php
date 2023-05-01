<?php
    
    require_once 'model/story_db.php';
    require_once "model/author_db.php";

    $PAGE_TITLE="New Story";

    session_start();
	$user_id = $_SESSION['user_id'] ?? null;
    if($user_id) {
		$author = get_author_by_id($user_id);
	}
?>

<!DOCTYPE html>
<html>
    <?php include "view/head.php"; ?>

<body>
    <?php include "view/header.php"; ?>
    
    <div class="ui container">

        <div class="ui form">

            <div class="ui segment">
                <div class="two fields">

                    <div class="field" id="original-text">
                        <label>Original Text:</label>
                        <!-- <textarea rows="5" ></textarea> -->
                        <!-- <button class="ui button icon"><i class="save icon"></i></button> -->
                    </div>                            

                    <div class="field" id="translated-text">
                        <label>Parallel Translation:</label>
                        <!-- <textarea rows="5" ></textarea> -->
                        <!-- <button class="ui button icon save"><i class="save icon"></i></button> -->
                    </div>
                </div>

                <!-- button to add another text input couple -->
                <button class="ui button" type="button" id="add-text">+</button>

            </div>
        </div>

        <button class="ui primary button" id="publish-button">Publish</button>

    </div>

    <?php include "view/scripts.php"; ?>

    <script src="javascript/create.js"></script>

</body>