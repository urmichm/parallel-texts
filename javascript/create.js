(function($){
    
    "use strict";
  
    document.addEventListener("DOMContentLoaded", onDOMContentLoaded);

    function onDOMContentLoaded(event){

        document.getElementById('add-text').addEventListener('click', addNewTextPair);

        document.getElementById('publish-button').addEventListener('click', function(){ 
            console.log("Publishing...");
            return;
        });

        let originalTextColumn = document.getElementById('original-text');
        addTextArea(originalTextColumn);
        addSaveButton(originalTextColumn);

        let translatedTextColumn = document.getElementById('translated-text');
        addTextArea(translatedTextColumn);
        addSaveButton(translatedTextColumn);
        
        console.log("DOM fully loaded and parsed");
    }

    function addNewTextPair(event){


        var parent = event.srcElement.parentElement;

        var twoFieldsDiv = document.createElement('div');
        twoFieldsDiv.classList.add('two');
        twoFieldsDiv.classList.add('fields');

        addFieldWithTextArea(twoFieldsDiv);
        addFieldWithTextArea(twoFieldsDiv);

        parent.insertBefore(twoFieldsDiv, document.getElementById('add-text'));
    }

    function addFieldWithTextArea(parent){
        var block = document.createElement('div');
        block.classList.add('field');

        addTextArea(block);
        addSaveButton(block);

        parent.appendChild(block);
        return;
    }

    function addTextArea(parent){
        let textArea = document.createElement('textarea');
        textArea.setAttribute('rows', '5');

        textArea.addEventListener('input', function() {
            parent
                .querySelectorAll('i.save.icon')[0]
                .parentElement
            
                .classList
                .add('red');
          });

        parent.appendChild(textArea);
        return;
    }

    function addSaveButton(parent){
        // create button such as <button class="ui button icon"><i class="save icon"></i></button>
        let button = document.createElement('button');
        button.classList.add('ui');
        button.classList.add('button');
        button.classList.add('icon');

        button.addEventListener('click', function() {
            let textarea = parent.querySelectorAll('textarea')[0];

            // TODO: save to database
            console.log("Saving...");
            console.log(textarea.value);

            button.classList.remove('red');
            return;
        });


        let icon = document.createElement('i');
        icon.classList.add('save');
        icon.classList.add('icon');

        button.appendChild(icon);
        parent.appendChild( button);
        return;
    }

})(jQuery);