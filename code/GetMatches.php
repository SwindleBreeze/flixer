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
    
    // Prepare and execute the SQL query to retrieve the user ID
    $getuserid = "SELECT idUporabnik FROM Uporabnik WHERE username=?";
    $stmt1 = mysqli_prepare($conn, $getuserid);
    mysqli_stmt_bind_param($stmt1, "s", $params["userid"]);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    $row1 = mysqli_fetch_assoc($result1);
    $userid = $row1["idUporabnik"];

    // Prepare and execute the SQL query to retrieve matched movies
    $getunique = "SELECT COUNT(idUporabnik) AS Amount, idMovie FROM MatchedMovies WHERE CHK_Key=? GROUP BY idMovie";
    $stmt2 = mysqli_prepare($conn, $getunique);
    mysqli_stmt_bind_param($stmt2, "s", $params["userkey"]);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);

    $results = array();

    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $results[] = array(
                "id" => $row2["idMovie"],
                "amount" => $row2["Amount"]
            );
        }
    }

    // Set the appropriate headers to prevent XSS attacks
    header("Content-Type: application/json");
    header("X-XSS-Protection: 1; mode=block");
    header("X-Content-Type-Options: nosniff");
    header("Content-Security-Policy: default-src 'self'");

    echo json_encode($results);
?>
