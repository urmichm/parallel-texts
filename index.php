<?php
    $aa = 3;
    echo $aa;
    // primary secondary tertiary
    include "model/mock_text.php";

    require "model/sql_database.php";
    require "model/story_db.php";

    $pagetitle = "Twin Texts Wiki";

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
        

        <div class="main">
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