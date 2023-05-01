(function($){
    
    "use strict";
  
    document.addEventListener("DOMContentLoaded", onDOMContentLoaded);

    function onDOMContentLoaded(event){
        console.log("DOM fully loaded and parsed");

        setup_login_form();
    }

    function setup_login_form(){
        console.log("Setting up login form");
        $('#login-form')[0].form({
            onSuccess : onSubmitForm,
            fields: {
                email : {
                    identifier  : 'email',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'Please enter your e-mail'
                        },
                        {
                            type   : 'email',
                            prompt : 'Please enter a valid e-mail'
                        }
                    ]
                },
                password: {
                    identifier  : 'password',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : 'Please enter your password'
                        },
                        {
                            type   : 'length[6]',
                            prompt : 'Your password must be at least 6 characters'
                        }
                    ]
                }
            }
        });
    }

    function onSubmitForm(event, fields){
        console.log("Submitting form");
        let body = {
            "email" : fields["email"],
            "password" : fields["password"]
        }
        
        $.ajax({
            xhrFields: {
                withCredentials: true
            },
            type: "POST",
            url: "/login.php",
            data: JSON.stringify(body),
            contentType: "application/json",
            dataType: "json"
        });
    }


})(jQuery);
