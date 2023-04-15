<?php
    // primary secondary tertiary
    require_once "model/domain/Story.php";
    require_once "model/domain/StoryPart.php";
    require "model/sql_database.php";
    require "model/story_db.php";

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

    <div class="container">

        <!-- Left side bar -->
        <div class="sidebar">
            <aside>
                <h2>Left Sidebar</h2>
                <nav>
                    <ul>
                        <?php
                            foreach($stories as $s){
                                echo "<li><a href=\"story.php?id=$s[id]\">$s[title]</a></li>";
                            }
                        ?>
                    </ul>
                </nav>
            </aside>
        </div>

        <!-- Right side bar -->
        <div class="main">
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
                                echo "<h3 class=\"translation\">$secondary</h3>";
                                echo "<h3 class=\"original\">$primary</h3>";
                                echo "</span>";
                            }
                        }
                    ?>

                </section>
            </main>
        </div>
        
    </div>

    <!-- Footer -->
    <?php include "view/footer.php"; ?>

    <?php include "view/scripts.php"; ?>

    <script>
		const translations = document.querySelectorAll(".translation");
		translations.forEach((translation) => {
			const original = translation.nextElementSibling;
			original.addEventListener("click", () => {
				translation.classList.toggle("show");
			});
		});
	</script>

</body>
</html>