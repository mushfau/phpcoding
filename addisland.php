<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!$_SESSION['user']) {
    header("Location: /login.php");
}

$name = "";
$atoll = "";
$postcode = "";

$name_err = "";
$atoll_err = "";
$postcode_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $atoll = trim($_POST['atoll']);
    $name = trim($_POST['name']);
    $postcode = trim($_POST['postcode']);

    if (empty($atoll)) {
        $atoll_err = "Invaid Atoll";
    }

    if (strlen($atoll) > 3) {
        $atoll_err = "Invaid Atoll, too long";
    }

    if (empty($name)) {
        $name_err = "Invaid Name";
    }

    if (empty($postcode)) {
        $postcode_err = "Invaid Postcode";
    }

    if (empty($atoll_err) && empty($name_err) && empty($postcode_err)) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projectaddudb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO islands ( postcode, atoll, name) VALUES ('$postcode', '$atoll', '$name' )";

        if ($conn->query($sql) === TRUE) {
            header("Location: /islands.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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
            <div class="col-lg-8 offset-lg-2">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Add Island</h5>
                        <form action="addisland.php" method="post">
                            <div class="form-group">
                                <label for="atoll">Example Atoll</label>
                                <select class="form-control" id="atoll" name="atoll" required>
                                    <option value="Hdh">Haa dhaalu</option>
                                    <option value="Haa">Haa alif</option>
                                    <option value="S">Seenu</option>
                                    <option value="Gn"> Fuvahmulah</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Enter Name" required>
                            </div>

                            <div class="form-group">
                                <label for="postcode">Postcode</label>
                                <input type="number" class="form-control" id="postcode" name="postcode" placeholder="Enter Postcode" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include("footer.php"); ?>

</body>

</html>