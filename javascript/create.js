(function($){
    
    "use strict";
  
    document.addEventListener("DOMContentLoaded", onDOMContentLoaded);

    function onDOMContentLoaded(event){

        document.getElementById('add-text').addEventListener('click', addNewTextPair);

        document.getElementById('publish-button').addEventListener('click', function(){ 
            console.log("Publishing...");
            return;
        });

        addTextArea(document.getElementById('original-title-block'), 1);
        addSaveButton(  document.getElementById('original-title-block') );
        addLockTextButton(document.getElementById('original-title-block'));

        addTextArea(document.getElementById('parallel-title-block'), 1);
        addSaveButton(document.getElementById('parallel-title-block'));
        addLockTextButton(document.getElementById('parallel-title-block'));

        let originalTextColumn = document.getElementById('original-text');
        addTextArea(originalTextColumn);
        addSaveButton(originalTextColumn);
        addLockTextButton(originalTextColumn);

        let translatedTextColumn = document.getElementById('translated-text');
        addTextArea(translatedTextColumn);
        addSaveButton(translatedTextColumn);
        addLockTextButton(translatedTextColumn);
        
        console.log("DOM fully loaded and parsed");
    }

    function addNewTextPair(event){


        var parent = event.srcElement.parentElement;

        var twoFieldsDiv = document.createElement('div');
        twoFieldsDiv.classList.add('two');
        twoFieldsDiv.classList.add('fields');

        createDivWithTextArea(twoFieldsDiv);
        createDivWithTextArea(twoFieldsDiv);

        parent.insertBefore(twoFieldsDiv, document.getElementById('add-text'));
    }

    function createDivWithTextArea(parent){
        var block = document.createElement('div');
        block.classList.add('field');

        addTextArea(block);
        addSaveButton(block);
        addLockTextButton(block);

        parent.appendChild(block);
        return;
    }


    function addTextArea(parent, rows = 5){
        let textArea = document.createElement('textarea');
        textArea.setAttribute('rows', rows);

        textArea.addEventListener('input', function() {
            parent
                .querySelectorAll('i.save.icon')[0]
                .parentElement
            
                .classList
                .add('red');
          });

        const initial_content = parent.querySelector('input[name="initial_content"]');
        if(initial_content){
            textArea.value = initial_content.value;
        }
        
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

            // TODO: save to database !
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

    function addLockTextButton(parent){
        // create button such as <button class="ui button icon"><i class="lock icon"></i></button>
        let icon = document.createElement('i');
        icon.classList.add('lock');
        icon.classList.add('open');

        let button = document.createElement('button');
        button.classList.add('ui');
        button.classList.add('button');
        button.classList.add('icon');

        button.addEventListener('click', function() {
            let textarea = parent.querySelectorAll('textarea')[0];
            let readonly = textarea.getAttribute('readonly');
            if(readonly){
                textarea.removeAttribute('readonly');
                icon.classList.add('open');
            }else{
                textarea.setAttribute('readonly', true);
                icon.classList.remove('open');
            }
        });

        icon.classList.add('icon');

        button.appendChild(icon);
        parent.appendChild( button);
        return;
    }

})(jQuery);