// Select the button on which the
        // class has to be toggled
        const btn = document.querySelector("#navmenu");
 
        // Select the entire HTML document
        const html = document.querySelector("html");
 
        // Add an event listener for
        // a click to the button
        btn.addEventListener("click", function (e) {
 
            // Add the required class
            btn.classList.add("show");
        });
 
        // Add an event listener for a
        // click to the html document
        html.addEventListener("click", function (e) {
 
            // If the element that is clicked on is
            // not the button itself, then remove
            // the class that was added earlier
            if (e.target !== btn)
                btn.classList.remove("show");
        });

       