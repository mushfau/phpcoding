<?php


// if(!isset($_COOKIE['user'])) {
//     echo "Cookie named 'user' is not set!";
// } else {
//     echo "Cookie 'user' is set!<br>";
//     echo "Value is: " . $_COOKIE['user'];
// }

$search = $_GET['search'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectaddudb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT * FROM islands WHERE name LIKE '%" . $name . "%'";
$sql = "SELECT * FROM islands WHERE name LIKE '%$search%'";
$result = $conn->query($sql);
echo "<table border='1'>";
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
}
echo "</table>";

$conn->close();
