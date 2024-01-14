<!DOCTYPE html>
<html>
    <head>
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
        <link rel="manifest" href="./manifest.json">
    </head>
    <body onload="FetchMovie();presentMovie();">
        <div id="header">
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
                <span style="font-size:30px;cursor:pointer" onclick="openNav1()">
                <img src="burger.png" style="width:40px;heigth:40px; right:0; position:absolute; padding-right: 5px;"></span>

            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn"
                onclick="closeNav()">&times;</a>
                <a onclick="goToLogIn()" class="MenuItemButt">LOG IN</a>
            </div>
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">
            <img src="profileimg.png" style="width:40px;height:40px; margin-left:5px; margin-top:5px"></span>
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
                        <button onclick="openPromptModal()" class="likebutt">&#10084;</button>
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

        <div id="promptModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closePromptModal()">&times;</span>
                <div id="ModalTitle" style="text-align:center;">Login required!</div>
                <div id="ModalTitle" style="text-align:center;" >To use this feature you must be logged in</div>
                <div id="promptButtons" style="text-align: center">
                    <button id="promptYes" onclick="goToLogIn()" class="MenuItemButt" style="position: relative; margin: auto; font-size: 4vh">Go to login</button>
                    <button id="promptNo" onclick="closePromptModal()" class="MenuItemButt" style="position: relative; margin: auto; font-size: 4vh">Close</button>
                </div>
            </div>
        </div>

        <div id="noVisib">
            Unfortunately we cannot display our application on such a small screen,
            Please resize your broswer or turn your phone.
        </div>
        <!--<button onclick="DeleteMovies()">BUTTON FOR TESTING DIFFERENT FUNCTIONS //IGNORE IT WHEN NOT IN USE</button>-->
        <script>
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('./sw.js')
                .then((registration) => {
                    console.log('Service Worker registered with scope:', registration.scope);
                })
                .catch((error) => {
                    console.error('Service Worker registration failed:', error);
                });
            }
        </script>
    </body>
</html>