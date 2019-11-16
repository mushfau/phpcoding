
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectaddudb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
$rows = array();
if ($result->num_rows > 0) {
    while ($r = $result->fetch_assoc()) {
        $rows[] = $r;
    }
}
$conn->close();
echo json_encode($rows);
