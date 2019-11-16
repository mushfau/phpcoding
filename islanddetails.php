<!doctype html>
<html lang="en">

<?php

include("headers.php");
?>


<body>
    <div class="container">
        <?php include("navbar.php"); ?>

        <!-- <button onclick="getData()" class="btn btn-success">Read</button> -->

        <div class="card">

            <div class="card-body">

                <?php
                $id = $_GET['id'];

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "projectaddudb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM islands WHERE id = $id";
                $result = $conn->query($sql);
                $r = $result->fetch_assoc();
                ?>

                <table id="services_table" class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td><?php echo $r['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $r['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Atoll</th>
                        <td><?php echo $r['atoll']; ?></td>
                    </tr>
                    <tr>
                        <th>Postcode</th>
                        <td><?php echo $r['postcode']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

    <?php include("footer.php"); ?>
</body>

</html>