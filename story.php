<?php
    // primary secondary tertiary
    include "model/mock_text.php";

    require "model/sql_database.php";
    require "model/story_db.php";

    $story = get_story($_GET['id']);

    $pagetitle = $story['title'];



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

    $parallelText = new ParallelText(
        get_story_content($_GET['id']) ,
        get_story_content(1) );

    
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
                            foreach($stories as $s){
                                echo "<li><a href=\"story.php?id=$s[id]\">$s[title]</a></li>";
                            }
                        ?>
                    </ul>
                </nav>
            </aside>
        </div>


        
        <div class="main">
            <main>
                <section>	
                    <?php 
                        $size = $parallelText->getSize();
                        for($i = 0; $i < $size; $i++){
                            $primary = $parallelText->primary[$i]['content_text'];
                            $secondary = $parallelText->secondary[$i]['content_text'];
                            echo "<span class=\"parallel-text\">";
                            echo "<h1 class=\"original\">$primary</h1>";
                            echo "<h1 class=\"translation\">$secondary</h1>";
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