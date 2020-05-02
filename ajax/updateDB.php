<?php
require_once('db.php');

if (isset($_POST['name'])) {
    $id     = $_POST['id'];
    $name   = $_POST['name'];
    $c_name = $_POST['c_name'];
    $c_no   = $_POST['c_no'];
    $sql    = mysqli_query($dbconn, "UPDATE student SET name='$name',c_name='$c_name',c_no='$c_no' WHERE id='$id'");
    if ($sql) {
        echo json_encode(['status' => 'success', 'message' => 'Data Updated!']);
    }
}
