<?php



?>

<html>
<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        let i = 0;
        x = document.getElementsByTagName("img");

        $(document).ready(function() {
            let myVar = setInterval("showPic()", 600);
        });

        function showPic(){
            $(x[i]).fadeIn();
            i++;
        }


    </script>

</head>

<body>

    <img id="photo1" src="resources/res/foto/IMG-20180403-WA0001.jpg" style = "display: none; width: 150px;
                                                                   height: 150px;">
    <img id="photo2" src="resources/res/merveileusep1.jpg" style = "display: none; width: 150px;
                                                                   height: 150px;">
    <img id="photo3" src="resources/res/merveileusep2.jpg" style = "display: none; width: 150px;
                                                                   height: 150px;">
    <img id="photo1" src="resources/res/foto/IMG-20180403-WA0004.jpg" style = "display: none; width: 150px;
                                                                   height: 150px;">
    <br>

    <img id="photo1" src="resources/res/foto/IMG-20180403-WA0005.jpg" style = "display: none; width: 150px;
                                                                   height: 150px;">
    <img id="photo2" src="resources/res/foto/IMG-20180403-WA0006.jpg" style = "display: none; width: 150px;
                                                                   height: 150px;">
    <img id="photo3" src="resources/res/foto/IMG-20180403-WA0007.jpg" style = "display: none; width: 150px;
                                                                   height: 150px;">
    <img id="photo1" src="resources/res/foto/IMG-20180403-WA0008.jpg" style = "display: none; width: 150px;
                                                                   height: 150px;">

</body>
</html>
