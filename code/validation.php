<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
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
    echo "Connected successfully";

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $logpass = $_POST['password'];
        $loguser = $_POST['username'];

        // Prepare statement to search for the user's password hash
        $searchStmt = mysqli_prepare($conn, "SELECT PASS_HASH FROM Uporabnik WHERE username = ?");
        mysqli_stmt_bind_param($searchStmt, "s", $loguser);
        mysqli_stmt_execute($searchStmt);
        mysqli_stmt_store_result($searchStmt);

        // Bind the result
        mysqli_stmt_bind_result($searchStmt, $passHash);

        if (mysqli_stmt_fetch($searchStmt) && password_verify($logpass, $passHash)) {
            $conformation = 1;
            echo "Log is successful";
            $sessionID = session_id();
            if (empty($sessionID)) {
                session_regenerate_id(true);
                $sessionID = session_id();
            }

            setcookie("username", $loguser, time() + 3600, '/');
            setcookie("conformation", $conformation, time() + 3600, '/');

            $_SESSION['username'] = $loguser;
            $_SESSION['conformation'] = $conformation;

            header("Location: ./keygen.html");
            exit();
        } else {
            echo "<script>console.log('Failed to confirm')</script>";
            $conformation = 0;
            setcookie("conformation", $conformation, time() + 3600);
            setcookie("username", '', time() - 7200);
            setcookie("password", '', time() - 7200);
            header("Location: ./frontpagehtml.php");
            echo "Login failed <br>";
            echo $passHash;
            exit();
        }
    }
    ?>
</body>
</html>
