<?php 

    require_once "model/author_db.php";
    require_once "model/domain/Author.php";

    require_once "model/draft_story_db.php";
    require_once "model/domain/DraftStory.php";

    session_start();

	$user_id = $_SESSION['user_id'] ?? null;
    if($user_id) {
		$author = get_author_by_id($user_id);
	} else {
        header("Location: login.php");
        return;
    }

    $PAGE_TITLE = $author->get_name() . "'s Account";

    $authors_draft_stories = get_draft_stories_by_author_id($user_id);

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
                <?php foreach($authors_draft_stories as $ds){ ?>
                        <a href="create.php?story_id=<?php echo $ds->get_id(); ?>" class="item"> <?php echo $ds->get_title(); ?> </a>
                <?php } ?>
            </div>
        </div>

        <div class="twelve wide stretched column">
                <main>
                    <section>	
                        <form class="ui form container" action="create.php" method="POST">

                            <div class="two fields">
                                <div class="field">
                                    <label>Original Title</label>
                                    <input type="text" name="original_title" placeholder="Title">
                                </div>
                                <div class="field">
                                    <label>Parallel Title</label>
                                    <input type="text" name="parallel_title" placeholder="Title">
                                </div>
                            </div>
    
                            <div class="two fields">
                                <div class="field">
                                    <label>Original Language</label>
                                    <select name="original_language" class="ui fluid dropdown">
                                        <option value="1">English</option>
                                        <option value="2">French</option>
                                        <option value="3">German</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Parallel Language</label>
                                    <select name="parallel_language" class="ui fluid dropdown">
                                        <option value="1">English</option>
                                        <option value="2">French</option>
                                        <option value="3">German</option>
                                    </select>
                                </div>
                            </div>

                            <button class="ui button" type="submit">Go</button>

                        </form>
                    </section>
                </main>
        </div>

    </div>

    <!-- Footer -->
    <?php include "view/footer.php"; ?>

    <?php include "view/scripts.php"; ?>

</body>
</html>

