<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <form action="" method="POST">
       Username: <input type="text" id="newuser" name="newuser"><br>
       Password: <input type="password" id="newpass" name="newpass"><br>
       E-mail: <input type="text" id="newmail" name="newmail"><br>
       <input type="submit" value="REGISTER">
    </form>
    <?php
    if(isset($_POST["newuser"]))
    {

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
        
        // Prepare the insert statement
        $insertSql = "INSERT INTO Uporabnik (username, email, password, PASS_HASH) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertSql);

        // Bind the parameters
        $insertableUser = $_POST['newuser'];
        $insertableEmail = $_POST['newmail'];
        $insertablePass = $_POST['newpass'];
        $insertableHash = password_hash($insertablePass, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $insertableUser, $insertableEmail, $insertablePass, $insertableHash);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<script> alert('REGISTRATION SUCCESSFUL');</script>";
            header('Location: http://localhost/matura-app/frontpagehtml.php');
        } else {
            echo "<script> alert('REGISTRATION FAILED');</script>";
            echo "New registration failed";
        }
        
        mysqli_close($conn);
    }
    ?>
    </div>
</body>
</html>
