<?php
/**
 * Created by PhpStorm.
 * User: Edwar
 * Date: 10/30/2018
 * Time: 9:14 AM
 */
$hn = 'localhost';
$db = 'wearable_app';
$un = 'dbuser';
$pw = 'dbroot';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

$sql = "SELECT * FROM gsr_rate_table";
$result = $conn->query($sql);
$row = $result->fetch_assoc(); // $row = mysqli_fetch_assoc($result)
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  // $row is an array of columns
        echo "id: " . $row["id"]. " data: " .$row["data"] ." time: " .
            $row["time"] . "<br>";
    }
}
else {
    echo "0 results";
}

// While a row of data exists, put that orw in $row as an associative array
// Note: If you're expecting


while($enr = mysqli_fetch_assoc($result)) {
    $a = array($enr['id'], $enr['data'], $enr['time']);
    array_push($data, $a);
}
echo json_encode($data);

$conn->close();
?>