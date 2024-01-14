<?php
   session_start();

   // USE FETCH POST TO SEND DATA ON CLICK to php file throught javascript, do everything database related in separate php files. YOU CAN ACCESS WITH json_decode(file_get_contents("php://input"),true);
   $params=json_decode(file_get_contents("php://input"),true);
   
   $servername = "192.168.1.83";
   $username = "root";
   $password = "password";
   $database="filmer";

   // response array

   $response= array("status" => "success", "data" => false);

   // Create connection
   $conn = mysqli_connect($servername, $username, $password,$database);

   // Check connection
   if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
   }
   
   //create INSERT DATA and check if already exist
   
   $insertableMovieId=$params["MovieId"];
   $insertableMovieTitle = mysqli_real_escape_string($conn, $params["MovieName"]);

   $insertableUser=$params["UserName"];
   $insertableKey=$params["CheckKey"];

   $sqlselect="SELECT idMovie FROM Movie";
   
   // Prepare statement for finding user
   $sqlfinduser="SELECT idUporabnik FROM Uporabnik WHERE username=?";

   $stmt = mysqli_prepare($conn, $sqlfinduser);
   mysqli_stmt_bind_param($stmt, "s", $insertableUser);
   mysqli_stmt_execute($stmt);
   $userresult = mysqli_stmt_get_result($stmt);
   $row = mysqli_fetch_assoc($userresult);

   // Select userID
   $userID=$row["idUporabnik"];

   // Select movie ids from database
   $result=mysqli_query($conn,$sqlselect); 

   // Check if the movie already exists in the Movie table; if not, add it
   $sqlcheckmovie="SELECT * FROM Movie WHERE idMovie=?";
   $stmt = mysqli_prepare($conn, $sqlcheckmovie);
   mysqli_stmt_bind_param($stmt, "s", $insertableMovieId);
   mysqli_stmt_execute($stmt);
   $resultformovie = mysqli_stmt_get_result($stmt);

   if($resultformovie->num_rows == 0) {
      $sqlinsertmovie="INSERT INTO Movie(idMovie,MovieTitle) VALUES(?, ?)"; 
      $stmt = mysqli_prepare($conn, $sqlinsertmovie);
      mysqli_stmt_bind_param($stmt, "ss", $insertableMovieId, $insertableMovieTitle);
      mysqli_stmt_execute($stmt);
   }

   // Check if the movie and user combination already exists in the MatchedMovies table
   $sqlcheckMatched="SELECT * FROM MatchedMovies WHERE (idMovie=? AND CHK_Key=?)";
   $stmt = mysqli_prepare($conn, $sqlcheckMatched);
   mysqli_stmt_bind_param($stmt, "ss", $insertableMovieId, $insertableKey);
   mysqli_stmt_execute($stmt);
   $resultformatch = mysqli_stmt_get_result($stmt);

   // ADD TO LIKED MOVIES QUERY
   $sqlinsertliked="INSERT INTO LikedMovies VALUES (?, ?, ?, NOW())"; 
   $stmt = mysqli_prepare($conn, $sqlinsertliked);
   mysqli_stmt_bind_param($stmt, "sss", $userID, $insertableMovieId, $insertableKey);
   mysqli_stmt_execute($stmt);

   if(mysqli_num_rows($resultformatch) > 0)
   {
      $SQLINSERTTOMATCH="INSERT INTO MatchedMovies VALUES(?, ?, ?)";
      $stmt = mysqli_prepare($conn, $SQLINSERTTOMATCH);
      mysqli_stmt_bind_param($stmt, "sss", $userID, $insertableMovieId, $insertableKey);
      mysqli_stmt_execute($stmt);

      // Check if the exact same record already exists in the MatchedMovies table
      $SQLEXISTMatch="SELECT idUporabnik,idMovie,CHK_Key FROM MatchedMovies WHERE (idUporabnik=? AND idMovie=? AND CHK_Key=?)";
      $stmt = mysqli_prepare($conn, $SQLEXISTMatch);
      mysqli_stmt_bind_param($stmt, "sss", $userID, $insertableMovieId, $insertableKey);
      mysqli_stmt_execute($stmt);
      $resultExistMatched=mysqli_stmt_get_result($stmt);
      
      if(mysqli_num_rows($resultExistMatched) == 0)
      {
         mysqli_stmt_execute($stmt); // INSERT movie and user INTO MATCHED
         $response = array("status" => "success", "data" => true);
      }
   }
   else{
      // Check if the exact same record already exists in the LikedMovies table
      $SQLEXIST="SELECT idUporabnik,idMovie,CHK_Key FROM LikedMovies WHERE (idUporabnik=? AND idMovie=? AND CHK_Key=?)";
      $stmt = mysqli_prepare($conn, $SQLEXIST);
      mysqli_stmt_bind_param($stmt, "sss", $userID, $insertableMovieId, $insertableKey);
      mysqli_stmt_execute($stmt);
      $resultExist=mysqli_stmt_get_result($stmt);

      if(mysqli_num_rows($resultExist) == 0)
      {
         mysqli_stmt_execute($stmt); // INSERT movie and user INTO LIKED
      }

      // CHECK IF SOMEONE HAS SAME CHCK KEY AND MOVIEID
      $sqlsearchforsimilar="SELECT * FROM LikedMovies WHERE (idMovie=? AND CHK_Key=?)";
      $stmt = mysqli_prepare($conn, $sqlsearchforsimilar);
      mysqli_stmt_bind_param($stmt, "ss", $insertableMovieId, $insertableKey);
      mysqli_stmt_execute($stmt);
      $similarresult=mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($similarresult) > 1) // IF THERE ARE DUPLICATES, TRANSFER TO "MATCHEDMOVIES" AND DELETE FROM LIKED
      {
         $response = array("status" => "success", "data" => true);
      }
      else
      {
         $response = array("status" => "success", "data" => false);
      }
   }
   
   header("Content-Type: application/json");
   echo json_encode($response);
   mysqli_close($conn);   
?>
