<?php
if (!isset($_SESSION)) {
    session_start();
}

$login_error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username  = $_POST['username'];
    $password  = $_POST['password'];


    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "projectaddudb";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username = '$username'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            $_SESSION['user'] = $username;
            // setcookie('user', $username, time() + (60*60), "/");
            header("Location: /index.php");
        } else {
            $login_error = "Invalid login credentials";
        }
    } else {

        $login_error = "Invalid login credentials";
    }
}
?>


<!doctype html>
<html lang="en">

<?php include("headers.php"); ?>


<body>
    <div class="container">
        <?php include("navbar.php"); ?>

        <br>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
                        <form action="login.php" method="post" class="mb-4">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        <?php

                            if (!empty($login_error)) {
                                echo '<div class="alert alert-danger" role="alert"> ' . $login_error . ' </div>';
                            }

                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>

</body>

</html>