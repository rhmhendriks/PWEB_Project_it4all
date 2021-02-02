    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1> Choose a language to translate the website </h1>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?
    cb=googleTranslateElementInit"></script>
            <p> Have fun browsing</p>
                <div id="google_translate_element"></div>
        </div>
    </div>

    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 450px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
        }
        .modal-content h1 {
            font-size: 30px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            margin-bottom: 8px;
        }
        .modal-content p {
            font-size: 17px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            margin-bottom: 8px;
        }
        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        div #google_translate_element div.goog-te-gadget-simple {
            font-size: 19px;
        }

        div #google_translate_element div.goog-te-gadget-simple {
            background-color: black;
        }

        div #google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value span {
            color: green
        }

        div #google_translate_element div.goog-te-gadget-simple a.goog-te-menu-value span:hover {
            color: blue
        }

        div #google_translate_element div.goog-te-gadget-simple {
            border: none;
        }

        @media screen and (max-width: 1560px){
            .modal-content {
                width: 55%
            }
        }

        @media screen and (max-width: 1024px){
            .modal-content {
                width: 90%;
            }
            .modal-content h1 {
                font-size: 24px;
                margin-bottom: 7px;
            }
            .modal-content p {
                font-size: 14px;
                margin-bottom: 7px;
            }
        }

    </style>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");
        // Get the button that opens the modal
        var btn = document.getElementById("translate");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>