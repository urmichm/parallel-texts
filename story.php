<?php
    // primary secondary tertiary
    require_once "model/domain/Story.php";
    require_once "model/domain/StoryPart.php";
    require_once "model/sql_database.php";
    require_once "model/story_db.php";
    require_once "model/author_db.php";


    session_start();
	$user_id = $_SESSION['user_id'] ?? null;
    if($user_id) {
		$author = get_author_by_id($user_id);
	}

    $story = get_story($_GET['id']);
    $originalStory = get_story($story->getOriginalStoryId());

    $PAGE_TITLE = $story->getTitle();

    $story->loadStoryParts();
    $originalStory->loadStoryParts();

    class ParallelText {
        public $primary;
        public $secondary;

        public function __construct($primary, $secondary) {
            $this->primary = $primary;
            $this->secondary = $secondary;
        }

        public function getSize() {
            return count($this->primary);
        }
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
                    foreach($stories as $s){
                        echo "<a href=\"story.php?id=$s[id]\" class=\"item\">$s[title]</a>";
                    }
                ?>
            </div>
        </div>

        <!-- Right side bar -->
        <div class="twelve wide stretched column">
            <div class="pt-main">
                <main>
                    <section>
                        <?php 
                            $totalNumberOfParts = count($story->getStoryParts());
                            for($p = 0; $p < $totalNumberOfParts; $p++)
                            {
                                $storyPart = $story->getStoryParts()[$p];
                                $originalStoryPart = $originalStory->getStoryParts()[$p];

                                if($storyPart->hasTitle() && $originalStoryPart->hasTitle())
                                {
                                    echo "<span class=\"parallel-text\">";
                                    echo "<h2 class=\"translation\">".$originalStoryPart->getTitle()."</h2>";
                                    echo "<h2 class=\"original\">".$storyPart->getTitle()."</h2>";
                                    echo "</span>";
                                }

                                $parallelText = new ParallelText(
                                    get_story_content( $storyPart->getStartContentId(), 
                                                    $storyPart->getEndContentId() ) ,
                            
                                    get_story_content( $originalStoryPart->getStartContentId(), 
                                                    $originalStoryPart->getEndContentId() ) 
                                            );

                            
                                $size = $parallelText->getSize();
                                for($i = 0; $i < $size; $i++){
                                    $primary = $parallelText->primary[$i]['content_text'];
                                    $secondary = $parallelText->secondary[$i]['content_text'];
                                    echo "<span class=\"parallel-text\">";
                                    echo "<p class=\"translation\">$secondary</p>";
                                    echo "<p class=\"original\">$primary</p>";
                                    echo "</span>";
                                }
                            }
                        ?>

                    </section>
                </main>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "view/footer.php"; ?>

    <?php include "view/scripts.php"; ?>

    <script src="javascript/story.js"></script>

</body>
</html>
