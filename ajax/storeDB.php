<?php
require_once('db.php');

if (isset($_POST['name'])) {
    $name   = $_POST['name'];
    $c_name = $_POST['c_name'];
    $c_no   = $_POST['c_no'];
    $sql = mysqli_query($dbconn, "INSERT INTO student(name,c_name,c_no) VALUES('$name','$c_name','$c_no')");
    if ($sql) {
        echo json_encode(['status' => 'success', 'message' => 'Data Inserted!']);
    }
}
