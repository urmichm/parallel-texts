<?php
    $PAGE_TITLE="New Story";
?>

<!DOCTYPE html>
<html>
    <?php include "view/head.php"; ?>

<body>
    <?php include "view/header.php"; ?>
    
    <div class="ui container">

        <div class="ui form">
            <form action="submit.php" method="post">

                <div class="two fields">
                    <div class="field">
                        <!-- first text input column -->
                        <label for="text1">Text 1:</label>
                        <textarea id="text1" name="text1" rows="5" ></textarea>
                    </div>

                    <div class="field">
                        <!-- second text input column -->
                        <label for="text2">Text 2:</label>
                        <textarea id="text2" name="text2" rows="5" ></textarea>
                    </div>
                </div>

                <!-- button to add another text input couple -->
                <button class="ui button" type="button" id="add-text">+</button>

                <!-- submit button -->
                <button class="ui button" type="submit">Submit</button>

            </form>
        </div>
    </div>




    <script>
        // add another text input couple when the button is clicked
        document.getElementById('add-text').addEventListener('click', function() {

            var form = document.querySelector('form');

            var twoFieldsDiv = document.createElement('div');
            twoFieldsDiv.classList.add('two');
            twoFieldsDiv.classList.add('fields');
            
            var leftFieldDiv = document.createElement('div');
            leftFieldDiv.classList.add('field');

            var leftTextArea = document.createElement('textarea');
            leftTextArea.setAttribute('rows', '5');
            leftTextArea.setAttribute('name', 'text');

            leftFieldDiv.appendChild(leftTextArea);

            var rightFieldDiv = document.createElement('div');
            rightFieldDiv.classList.add('field');

            var rightTextArea = document.createElement('textarea');
            rightTextArea.setAttribute('rows', '5');
            rightTextArea.setAttribute('name', 'text');

            rightFieldDiv.appendChild(rightTextArea);

            twoFieldsDiv.appendChild(leftFieldDiv);
            twoFieldsDiv.appendChild(rightFieldDiv);

            console.log(twoFieldsDiv);
            console.log(document.getElementById('add-text'));
            console.log(form);
            form.insertBefore(twoFieldsDiv, document.getElementById('add-text'));
        });
    </script>

</body>