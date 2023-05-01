<?php

    require_once "model/sql_database.php";
    require_once "model/story_db.php";
    require_once "model/author_db.php";

    $PAGE_TITLE = "Twin Texts Wiki";

    session_start();
	$user_id = $_SESSION['user_id'] ?? null;
    if($user_id) {
		$author = get_author_by_id($user_id);
	}

    // get all stories from SQL database and store in $stories
    $stories = get_all_stories();
?>

<!DOCTYPE html>
<html>

<?php include "view/head.php"; ?>

<body>

    <!-- Header -->
    <?php include "view/header.php"; ?>

    <div class="ui grid">

        <div class="three wide column">
            <div class="ui vertical menu">
                <?php
                    foreach($stories as $story){
                        echo "<a href=\"story.php?id=$story[id]\" class=\"item\">$story[title]</a>";
                    }
                ?>
            </div>
        </div>

        <div class="twelve wide stretched column">
                <main>
                    <section>	
                        <?php 
                            echo "<h1>TODO: Make the welcome page</h1>";
                        ?>
                    </section>
                </main>
        </div>

    </div>

    <!-- Footer -->
    <?php include "view/footer.php"; ?>

    <?php include "view/scripts.php"; ?>

</body>
</html>