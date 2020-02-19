<?php
require_once('db.php');
if(isset($_POST['id'])){
    $id     = $_POST['id'];
    $sql    = mysqli_query($dbconn, "DELETE FROM student  WHERE id='$id'");
    if ($sql) {
        echo json_encode(['status' => 'success', 'message' => 'Data Deleted!']);
    }
}