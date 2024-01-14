<?php
    session_start();
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

    $username = $params['username'];
    $key = $params['keygen'];

    // Get the user ID using the provided username
    $getUserIdStmt = mysqli_prepare($conn, "SELECT idUporabnik FROM Uporabnik WHERE (username = ?)");
    mysqli_stmt_bind_param($getUserIdStmt, "s", $username);
    mysqli_stmt_execute($getUserIdStmt);
    $result = mysqli_stmt_get_result($getUserIdStmt);
    $row = mysqli_fetch_assoc($result);
    $userID = $row['idUporabnik'];

    $deletionsql = "DELETE FROM ShowedMovies WHERE (idUporabnik = ? AND CHK_Key = ? AND (TIMESTAMPDIFF(HOUR, AddDate, NOW()) > 1))";
    $deleteStmt = mysqli_prepare($conn, $deletionsql);
    mysqli_stmt_bind_param($deleteStmt, "is", $userID, $key);

    if (mysqli_stmt_execute($deleteStmt)) {
        echo 1;
    } else {
        echo 0;
    }

    mysqli_close($conn);
?>
