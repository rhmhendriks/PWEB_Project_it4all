<!-- The popup -->
<div id="mypopup" class="popup">
        <!-- popup content -->
        <div class="popupcontent">
            <span class="close">&times;</span>
            <h1> Choose a language to translate the website </h1>
            <div id="translate_wrapper">
                <div id="google_translate_element"></div>
                <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                    }
                </script>
                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>
        </div>
    </div>

    <style>
        .popup {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 450px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .popupcontent {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
        }
        .popupcontent h1 {
            font-size: 30px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            margin-bottom: 8px;
        }
        /* closing button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: #000000;
            text-decoration: none;
            cursor: pointer;
        }

        #translate_wrapper {
            margin-left: 35%;
        }
        #google_translate_element .goog-te-gadget-simple {
            font-size: 19px;
        }
        #google_translate_element .goog-te-gadget-simple {
            background-color: black;
        }
        #google_translate_element .goog-te-gadget-simple a.goog-te-menu-value span {
            color: green;
        }
        #google_translate_element .goog-te-gadget-simple a.goog-te-menu-value span:hover {
            color: blue;
        }
        #google_translate_element .goog-te-gadget-simple {
            border: none;
        }

        @media screen and (max-width: 1560px){
            .popupcontent {
                width: 55%
            }
        }

        @media screen and (max-width: 1024px){
            .popupcontent {
                width: 90%;
            }
            .popupcontent h1 {
                font-size: 24px;
                margin-bottom: 7px;
            }
            .popupcontent p {
                font-size: 14px;
                margin-bottom: 7px;
            }
        }

        @media screen and (max-width: 850px){
            #translate_wrapper {
                margin-left: 37%;
            }
            .popup {
                padding-top: 250px;
            }
        }

        @media screen and (max-width: 725px){
            #translate_wrapper {
                margin-left: 30%;
            }
        }

    </style>

    <script>
        // Get the popup
        var popup = document.getElementById("mypopup");
        // Get the button that opens the popup
        var button = document.getElementById("translate");
        // Get the <span> element that closes the popup
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the popup 
        button.onclick = function() {
            popup.style.display = "block";
        }
        // When the user clicks on <span> (x), close the popup
        span.onclick = function() {
            popup.style.display = "none";
        }
        // When the user clicks anywhere outside of the popup, close it
        window.onclick = function(event) {
            if (event.target == popup) {
                popup.style.display = "none";
            }
        }
    </script>