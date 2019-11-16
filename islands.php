<html lang="en">
<?php
include("headers.php");
$sort = 'id';
$dir  = 'asc';

$limit = 5;
$offset = 0;
$page = 1;

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}

if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
}

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * $limit;
}
?>

<body>
    <div class="container">
        <?php include("navbar.php"); ?>

        <div class="card">
            <div class="card-body">
                <a href="addisland.php" class="btn btn-success">Add</a>
                <br>
                <br>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">
                                <?php
                                if ($dir == 'asc') {
                                    echo "<a href='/islands.php?sort=name&dir=desc'>Name</a>";
                                } else {
                                    echo "<a href='/islands.php?sort=name&dir=asc'>Name</a>";
                                }
                                ?>
                            </th>
                            <th scope="col">
                                <?php
                                if ($dir == 'asc') {
                                    echo "<a href='/islands.php?sort=atoll&dir=desc'>Atoll</a>";
                                } else {
                                    echo "<a href='/islands.php?sort=atoll&dir=asc'>Atoll</a>";
                                }
                                ?>
                            </th>
                            <th scope="col">Postcode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php



                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "projectaddudb";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM islands ORDER BY $sort $dir LIMIT $limit OFFSET $offset";

                        $result = $conn->query($sql);


                        if ($result->num_rows > 0) {
                            while ($r = $result->fetch_assoc()) {
                                echo "<tr> 
                                 <td><a href='/islanddetails.php?id=" . $r['id'] . "'>" . $r['id'] . "</a></td> 
                                 <td>" . $r['name'] . "</td> 
                                 <td>" . $r['atoll'] . "</td>  
                                 <td>" . $r['postcode'] . "</td> 
                                 </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No records found</td></tr>";
                        }

                        $conn->close();

                        ?>

                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">

                        <li class="page-item">
                            <?php
                            $prev = $page - 1;
                            if ($prev < 1) {
                                $prev = 1;
                            }
                            $href = "/islands.php?limit=$limit&page=$prev";
                            echo "<a class='page-link' href='$href'>Previous</a>"
                            ?>
                        </li>
                        <li class="page-item">
                            <?php
                            $next = $page + 1;
                            $href = "/islands.php?limit=$limit&page=$next";
                            echo "<a class='page-link' href='$href'>Next</a>"
                            ?>
                        </li>
                </nav>
            </div>
        </div>

    </div>
    <?php include("footer.php"); ?>

</body>

</html>