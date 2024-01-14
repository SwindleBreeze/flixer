<?php
    session_start();
    // USE FETCH POST TO SEND DATA ON CLICK to php file throught javascript, do everything database related in seperate php files. YOU CAN ACCESS WITH json_decode(file_get_contents("php://input"),true);
    $params=json_decode(file_get_contents("php://input"),true);
    
    $servername = "192.168.1.83";
    $username = "root";
    $password = "password";
    $database="filmer";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$database);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
    //create INSERT DATA and check if already exist
    
    $insertableMovieId=$params["MovieId"];
    $insertableUser=$params["UserName"];
    $insertableKey=$params["CheckKey"];


    //https://stackoverflow.com/questions/1917576/how-do-i-pass-javascript-variables-to-php
    
    $sqlfinduser="SELECT idUporabnik FROM Uporabnik WHERE (username='$insertableUser')";// DOBI ID UPORABNIKA z usernamemom ki dobim iz mainhtml.php

    $userresult=mysqli_query($conn,$sqlfinduser); //shrani kaj dobi od query
    $row=mysqli_fetch_assoc($userresult);//spremeni rezultat v array

    //izbere userID
    $userID=$row["idUporabnik"];


    //ADD TO SHOWED MOVIES QUERY
    $sqlinsertshowed="INSERT INTO ShowedMovies VALUES ('$userID','$insertableMovieId','$insertableKey',NOW())";
    mysqli_query($conn,$sqlinsertshowed); // INSERT movie and user INTO SHOWED
    mysqli_close($conn);
                         
?>