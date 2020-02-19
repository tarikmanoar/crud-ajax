<?php
require_once('db.php');

    $id     = $_GET['id'];
    $sql    = mysqli_query($dbconn, "SELECT * FROM student WHERE id='$id'");
    if ($sql) {
        $data = mysqli_fetch_assoc($sql);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }
