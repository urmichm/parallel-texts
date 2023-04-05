<?php
    $aa = 3;
    echo $aa;
    // primary secondary tertiary
    include "model/mock_text.php";

    require "model/sql_database.php";
    require "model/story_db.php";

    $pagetitle = "Twin Texts Wiki";

    class TextFont{
        public const TITLE = 0;
        public const SUB_TITLE_1 = 1;
        public const SUB_TITLE_2 = 2;
        public const SUB_TITLE_3 = 3;
        public const SENTENCE = 4;
    }

    class ParallelText {
        public $primary;
        public $secondary;
        // public $tertiary;
        public $schema;
        public $id;

        public function __construct($primary, $secondary, $schema, $id) {
            $this->primary = $primary;
            $this->secondary = $secondary;
            $this->schema = $schema;
            $this->id = $id;
        }

        public function getSize() {
            return count($this->primary);
        }
    }

    $parallelText = new ParallelText(
        getMockFr(), 
        getMockEn(), 
        getMockSchema(), 
        0);

    
    // get all stories from SQL database and store in $stories
    $stories = get_all_stories();

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pagetitle; ?> - Sunflower Style</title>
    <link rel="stylesheet" type="text/css" href="view/css/style.css">
</head>
<body>

    <!-- Header -->
    <?php include "view/header.php"; ?>

    <div class="container">
        <div class="sidebar">
            <aside>
                <h2>Left Sidebar</h2>
                <nav>
                    <ul>
                        <?php
                            foreach($stories as $story){
                                echo "<li><a href=\"story.php?id=$story[id]\">$story[title]</a></li>";
                            }
                        ?>
                    </ul>
                </nav>
            </aside>
        </div>
        
        <pre>
            <?php
                $stories = get_all_stories();
                print_r($stories);
            ?>
        </pre>

        <div class="main">
            <main>
                <section>	
                    <?php 
                        $size = $parallelText->getSize();
                        for($i = 0; $i < $size; $i++){
                            $schema = $parallelText->schema[$i];
                            $primary = $parallelText->primary[$i];
                            $secondary = $parallelText->secondary[$i];

                            echo "<span class=\"parallel-text\">";
                            switch($schema){
                                case TextFont::TITLE:
                                    echo "<h1 class=\"original\">$primary</h1>";
                                    echo "<h1 class=\"translation\">$secondary</h1>";
                                    break;
                                case TextFont::SUB_TITLE_1:
                                    echo "<h2 class=\"original\">$primary</h2>";
                                    echo "<h2 class=\"translation\">$secondary</h2>";
                                    break;
                                case TextFont::SUB_TITLE_2:
                                    echo "<h3 class=\"original\">$primary</h3>";
                                    echo "<h3 class=\"translation\">$secondary</h3>";
                                    break;
                                case TextFont::SUB_TITLE_3:
                                    echo "<h4 class=\"original\">$primary</h4>";
                                    echo "<h4 class=\"translation\">$secondary</h4>";
                                    break;
                                case TextFont::SENTENCE:
                                    echo "<p class='original'>$primary</p>";
                                    echo "<p class='translation'>$secondary</p>";
                                    break;
                                default:
                                    echo "<p>$primary</p>";
                                    break;
                                }
                            echo "</span>";

                        }
                    ?>

                </section>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <?php include "view/footer.php"; ?>

    <script>
		const translations = document.querySelectorAll(".translation");
		translations.forEach((translation) => {
			const original = translation.previousElementSibling;
			original.addEventListener("click", () => {
				translation.classList.toggle("show");
			});
		});
	</script>

</body>
</html>