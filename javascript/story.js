(function($){
    
    "use strict";
  
    document.addEventListener("DOMContentLoaded", onDOMContentLoaded);

    function onDOMContentLoaded(event){
        console.log("DOM fully loaded and parsed");

        setup_translations();
    }

    function setup_translations(){
        const translations = document.querySelectorAll(".translation");
		translations.forEach((translation) => {
			const original = translation.nextElementSibling;
			original.addEventListener("click", () => {
				translation.classList.toggle("show");
			});
		});
    }

})(jQuery);