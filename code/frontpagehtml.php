<!DOCTYPE html>

<html lang="en">
    <head>
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Filmer</title>
    </head>
    <body>
    <h1 class="TITLE">WELCOME TO FILMER</h1>
    <h2 class="UNDERTITLE">The world's premiere cinematography matcher </h2>
    <h3 id = "validationInfo" style = "color: red; display: none;">information</h3>
    <div id="container">
        <div id="sign_in">
            <form action="validation.php" method="POST">
                    <a style="color:white;" >Username</a><br>
                <input style="margin-bottom:5px; width:100%; height:35px; border-radius:5px;" type="text" id="username" name="username" placeholder="Your username"><br>
                    <a style="color:white;" >Password</a><br>
                <input style="width:100%; height:35px; border-radius:5px;" type="password" id="password" name="password" placeholder="Your password"><br>
                <input class="frontpageSignIn" style="position: relative; margin-top:10px; width:100%;" type="submit" value="Sign In">
            </form>
            <?php
                    setcookie("moviesetId", 'NULL',time()-7200);
                    setcookie("moviesetTitle", 'NULL',time()-7200);
                    setcookie("username", 'NULL',time()-7200);
                    setcookie("password", 'NULL',time()-7200);
                    if(isset($_COOKIE["conformation"]))
                    {
                        if($_COOKIE["conformation"]==0)
                        {
                            echo '<script> document.getElementById("validationInfo").style.display = "block"</script>';
                            echo '<script> document.getElementById("validationInfo").textContent = "Login failed"; </script>';
                            setcookie("conformation", 'NULL',time()-7200);
                            setcookie("username", 'NULL',time()-7200);
                            setcookie("password", 'NULL',time()-7200);
                        }
                    }
            ?>
        </div>
        <div id="register">
            <form action="./frontpagehtml.php" method="POST">
                <a style="color:white;" >Username</a><br>
                <input style="margin-bottom: 5px; width:100%; height:35px; border-radius:5px;" type="text" id="newuser" name="newuser" placeholder="New Username" required><br>
                <a style="color:white;" >Password</a><br>
                <input style="margin-bottom: 5px; width:100%; height:35px; border-radius:5px;" type="password" id="newpass" name="newpass" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Password must contain at least 1 uppercase character, 1 special character, 1 number, and be at least 8 characters long" required><br>
                <a style="color:white;" >E-mail</a><br>
                <input style="margin-bottom: 5px; width:100%; height:35px; border-radius:5px;" type="email" id="newmail" name="newmail" placeholder="New Email" required><br>
                <input style="margin-top: 5px; width:100%;" class="frontpageRegister" type="submit" value="Register">
            </form>
            <?php
                if (isset($_POST["newuser"]) && isset($_POST["newmail"]) && isset($_POST["newpass"]) && $_POST["newuser"] != '' && $_POST["newpass"] != '' && $_POST["newmail"] != '') {
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

                    $insertableuser = $_POST['newuser'];
                    $insertableemail = $_POST['newmail'];
                    $insertablepass = $_POST['newpass'];
                    $insertabelhash = password_hash($insertablepass, PASSWORD_DEFAULT);

                    // Prepare statement to search for existing username
                    $searchStmt = mysqli_prepare($conn, "SELECT username FROM Uporabnik WHERE username = ?");
                    mysqli_stmt_bind_param($searchStmt, "s", $insertableuser);
                    mysqli_stmt_execute($searchStmt);
                    mysqli_stmt_store_result($searchStmt);

                    if (mysqli_stmt_num_rows($searchStmt) > 0) {
                        echo '<script> document.getElementById("validationInfo").style.display = "block"</script>';
                        echo '<script> document.getElementById("validationInfo").textContent = "Username already in use";</script>';
                    } else {
                        // Prepare statement to insert new user
                        $insertStmt = mysqli_prepare($conn, "INSERT INTO Uporabnik (username, email, password, PASS_HASH) VALUES (?, ?, ?, ?)");
                        mysqli_stmt_bind_param($insertStmt, "ssss", $insertableuser, $insertableemail, $insertablepass, $insertabelhash);
                        if (mysqli_stmt_execute($insertStmt)) {
                            echo '<script> document.getElementById("validationInfo").style.display = "block"</script>';
                            echo '<script> document.getElementById("validationInfo").style.color = "green"</script>';
                            echo '<script> document.getElementById("validationInfo").textContent = "Registration successful";</script>';
                        } else {
                            echo '<script> document.getElementById("validationInfo").style.display = "block"</script>';
                            echo '<script> document.getElementById("validationInfo").textContent = "Registration failed";</script>';
                        }
                    }

                    mysqli_close($conn);
                }
            ?>
        </div>


    </div>

        <div class="fade-in">
            <h3 class="QUOTE" style="font-style:italic;color:grey; opacity:40%; margin-bottom:0;">"Mama always said life was like a box of chocolates. You never know what you're gonna get." <br></h3>
        </div>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <div id="guest">
            <form action="./index.php" method="POST">
                <input style="width:100%;" class="MenuItemButt" id="indexReturnButt" type="submit" value="Return as guest">
            </form>
        </div>
    </body>
</html>