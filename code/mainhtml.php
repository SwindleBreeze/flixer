<!DOCTYPE html>
<html>
    <head>
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <?php

        // check if 'conformation' cookie is set to 1, if not redirect to ./frontpagehtml.php
        if(!isset($_COOKIE["conformation"]))
        {
            header("Location: ./frontpagehtml.php");
        }
        else if($_COOKIE["conformation"]!=1)
        {
            header("Location: ./frontpagehtml.php");
        }
    ?>
    <body onload="FetchMovie();startChecking();presentMovie();DeleteMovies();">
        <div id="header" style="width: 100%">
            <div id="logo">

            </div>
            <div id="search">
            </div>
            <div id="mySidenav1" class="searchnav">
            <a href="javascript:void(0)" class="closebtn"
                onclick="closeNav1()">&times;</a>
                <div>
                    <!--
                        <form>
                        <input type="text" name="search" placeholder="Search" id="searchbar">
                        </form>
                    -->
                    <div>
                    <abb style="padding-left:10px">SORT BY</abb>
                    </div>
                    <a onclick="SortByPopular()" class="SortButt">POPULAR</a>
                    <a onclick="SortByTopRated()" class="SortButt">TOP RATED</a>
                    <a onclick="SortByPlayingNow()" class="SortButt">PLAYING NOW</a>
                </div> 
                
                
            </div>
                <span style="cursor:pointer" onclick="openNav1()">
                <img src="burger.png" style="width:50px;height:50px; right:0; position:absolute; padding-right: 5px;"></span>
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn"
                onclick="closeNav()">&times;</a>
                <a onclick="ToMatchedMovies()" class="MenuItemButt">MATCHES</a>
                <a onclick="LogOut()" class="MenuItemButt">LOG OUT</a>
                <abb id="currentuser">Current user key:</abb>
                <a id="userkeygenDisplay" style="margin-top:0; text-align:center;">tmp</a>
            </div>
            <span style="cursor:pointer" onclick="openNav()">
            <img src="profileimg.png" style="width:50px;height:50px; margin-left:5px; margin-top:5px"></span>
        </div>

        <div id="main">
            <div id="img">
                <div id="imgcontainer">
                    <img id="presentimg">
                    <div id="footer" style="height:100%; background-color:green;">
                        <div id="shortinfobackg">
                        </div> 
                        <div id="infoButton">
                        <button id="imgInfo" >?</button>
                    </div>
                    </div>
                    <div id="MovieSummary"></div>
                    <div id="MovieID" hidden></div>
                    <div id="MovieTitle" hidden>
                    </div>
                    <div id="buttons">
                        <button onclick="DislikeMovie()" class="dislikebutt">&#10060;</button>
                        <button onclick="LikeMovie()" class="likebutt">&#10084;</button>
                    </div>
                </div>
                
            </div> 
        </div>

        <div id="modal1" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="ModalTitle">place</div>
                <a id="ModalGenres">place</a> | 
                <a id="ModalRuntime">place</a> min | 
                <a id="ModalReleaseDate">place</a><br>
                <div id="MediaDiv">
                    <img id="ModalImage">
                    <iframe id="TrailerVideo" width="720" height="480" controls>
                        Your browser does not support the video tag.
                    </iframe>
                </div>
                <div id="summarytitle">SUMMARY: </div>
                <div id="ModalSummary">place</div>
                
            </div>
        </div>

        <div id="noVisib">
            Unfortunately we cannot display our application on such a small screen,
            Please resize your broswer or turn your phone.
        </div>
        <!--<button onclick="DeleteMovies()">BUTTON FOR TESTING DIFFERENT FUNCTIONS //IGNORE IT WHEN NOT IN USE</button>-->
    </body>
</html>