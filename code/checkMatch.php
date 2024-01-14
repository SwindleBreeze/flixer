<?php
    header('Content-Type: application/json');
    $params = json_decode(file_get_contents("php://input"), true);

    $servername = "192.168.1.83";
    $username = "root";
    $password = "password";
    $database = "filmer";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $moviearray = array();
    $userarray = array();
    $i = 0;
    $chkkey = $params["CheckKey"];
    $getIdFromMovie = "SELECT idMovie FROM Movie";
    $getMovieIdStmt = mysqli_prepare($conn, $getIdFromMovie);
    mysqli_stmt_execute($getMovieIdStmt);
    $movieresult = mysqli_stmt_get_result($getMovieIdStmt);

    if (mysqli_num_rows($movieresult) > 0) {
        // LOOP THROUGH THE RESULTS AND PERFORM SELECT FOR EACH MOVIE TO CHECK IF THERE ARE MORE THAN 2 MATCHES
        while ($row = mysqli_fetch_assoc($movieresult)) {
            $movieid = $row["idMovie"];
            $CheckForSimilars = "SELECT idMovie, idUporabnik FROM LikedMovies WHERE (CHK_Key = ? AND idMovie = ?)";
            $checkSimilarsStmt = mysqli_prepare($conn, $CheckForSimilars);
            mysqli_stmt_bind_param($checkSimilarsStmt, "si", $chkkey, $movieid);
            mysqli_stmt_execute($checkSimilarsStmt);
            $result = mysqli_stmt_get_result($checkSimilarsStmt);

            if (mysqli_num_rows($result) > 1) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $moviearray[$i] = $row["idMovie"];
                    $userarray[$i] = $row["idUporabnik"];
                    $i++;
                }
            }
        }
    }

    for ($j = 0; $j < $i; $j++) {
        $movie = $moviearray[$j];
        $user = $userarray[$j];
        $deletefromliked = "DELETE FROM LikedMovies WHERE (idMovie = ? AND CHK_Key = ?)";
        $copytomatched = "INSERT INTO MatchedMovies VALUES (?, ?, ?)";
        $deleteStmt = mysqli_prepare($conn, $deletefromliked);
        $copyStmt = mysqli_prepare($conn, $copytomatched);
        mysqli_stmt_bind_param($deleteStmt, "is", $movie, $chkkey);
        mysqli_stmt_bind_param($copyStmt, "iss", $user, $movie, $chkkey);
        mysqli_stmt_execute($copyStmt);
        mysqli_stmt_execute($deleteStmt);
    }

    if (isset($moviearray)) {
        echo json_encode($moviearray);
    } else {
        echo "no";
    }

    mysqli_close($conn);
?>