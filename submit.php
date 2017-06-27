<html>

<head>

    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/darcula.css">
    <script src="highlight.pack.js"></script>
    <script src="js/he-master/he.js"></script>

    <style>
        code {
            display: block;
            overflow-x: auto;
            padding: 0.5em;
            background: #444;
            width: 500px;
            height: 300px;
            /* specify width  */
            white-space: pre-wrap;
            /* CSS3 browsers  */
            white-space: -moz-pre-wrap !important;
            /* 1999+ Mozilla  */
            white-space: -pre-wrap;
            /* Opera 4 thru 6 */
            white-space: -o-pre-wrap;
            /* Opera 7 and up */
            word-wrap: break-word;
            /* IE 5.5+ and up */
            /* overflow-x: auto; */
            /* Firefox 2 only */
            /* width: 99%; */
            /* only if needed */
        }
    </style>
</head>

<body>
    <input id="openFile" type="file" />
    <pre><code class="javascript" id="fileContents" contenteditable="true"> Please upload your script here</code></pre>

    <button id="run" onclick="run();return false;">Run</button>
    <script>
        //OPEN THE file
        document.getElementById("openFile").addEventListener('change', function() {
            //create new reader
            var reader = new FileReader();
            reader.onload = function(e) {
                //Clear area
                window.sessionStorage.removeItem('exCode');
                //code gets file and writes to fileContents box
                document.getElementById("fileContents").textContent = this.result;
                //store the uploaded file code to a global variable to be access by another script
                exCode = this.result
                //stores the file to local storage without the higlighting applied
                sessionStorage.setItem('exCode', exCode);
                //highlights the file uploaded into the code area.
                hljs.highlightBlock($('code').get(0));
                hljs.configure({
                    useBR: true
                });

                //https://highlightjs.org/download/
            };
            reader.readAsText(this.files[0]);

        })
    </script>
    <script>
        function run() {
            //new xmlHttpRequest
            var xmlhttp = new XMLHttpRequest();
            //script to call action on
            var url = "execute.php";
            
            //get the session storage data store it in var data
            var datad = sessionStorage.getItem('exCode', exCode);
             data = encodeURIComponent(datad);
   
            //post data to execute.php
            xmlhttp.open("POST", url, true);
            //request header to XMLHttpRequest request for POST
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $('#target').load('executed-file.php');
                    alert(xmlhttp.responseText);
                }
            }
            xmlhttp.send(data);
            //xmlhttp.send(exCode);
						
        }
    </script>
    <div id="target"> </div>


</body>

</html>
