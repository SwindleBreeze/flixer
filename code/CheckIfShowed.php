<?php
    session_start();
    // USE FETCH POST TO SEND DATA ON CLICK to php file throught javascript, do everything database related in separate php files. YOU CAN ACCESS WITH json_decode(file_get_contents("php://input"),true);
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

    $key = $params['CheckKey'];
    $user = $params['uporab'];

    // DOBI ID UPORABNIKA z usernamemom ki dobim iz mainhtml.php
    $sqlfinduser = "SELECT idUporabnik FROM Uporabnik WHERE username=?";
    $usertable = '';
    $stmt = mysqli_prepare($conn, $sqlfinduser);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $userID = $row['idUporabnik'];

    $SQLCheckLiked = "SELECT idMovie FROM ShowedMovies WHERE CHK_Key=? AND idUporabnik=?";
    $TabelaOfLikes = array();
    $stmt = mysqli_prepare($conn, $SQLCheckLiked);
    mysqli_stmt_bind_param($stmt, "si", $key, $userID);
    mysqli_stmt_execute($stmt);
    $resultLikes = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultLikes) > 0) {
        while ($row = mysqli_fetch_assoc($resultLikes)) {
            $TabelaOfLikes[] = $row['idMovie'];
        }
    }
    
    echo json_encode(array_map('htmlspecialchars', $TabelaOfLikes), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)
?>
