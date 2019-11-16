<?php

$fullname = "";
$username = "";
$password = "";

$fullname_err = "";
$username_err = "";
$password_err = "";
$sql_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $password = trim($_POST['password']);

    if (empty($username)) {
        $username_err = "Invaid username";
    }

    if (empty($fullname)) {
        $fullname_err = "Invaid fullname";
    }

    if (empty($password)) {
        $password_err = "Invaid password";
    }

    if (empty($username_err) && empty($fullname_err) && empty($password_err)) {

        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "projectaddudb";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO users ( fullname, username, password) VALUES ('$fullname', '$username', '$password' )";

        if ($conn->query($sql) === TRUE) {
            header("Location: /index.php");
        } else {
            $sql_error = $conn->error;
        }
    }
}

?>

<!doctype html>
<html lang="en">

<?php
include("headers.php");
?>


<body>
    <div class="container">
        <?php include("navbar.php"); ?>
        <br>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Register user</h5>

                        <form action="register.php" method="post"  class="mb-4">
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullname" required>
                                <span><?php echo $fullname_err; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>

                            <?php

                            if (!empty($sql_error)) {
                                echo '<div class="alert alert-danger" role="alert"> ' . $sql_error . ' </div>';
                            }

                            ?>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include("footer.php"); ?>

</body>

</html>