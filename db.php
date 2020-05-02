<?php

function get_db()
{
    $dbconn = mysqli_connect('localhost', 'root', '', 'php_swift');
    if (!$dbconn) {
        die("Database Connection Problem!");
    }
    return $dbconn;
}

function get_all_data()
{
    $dbconn = get_db();
    $sql    = "SELECT * FROM student";
    $result = mysqli_query($dbconn, $sql);

    $html = '';
    $html .= '<thead>';
    $html .= '    <tr>';
    $html .= '        <th>ID</th>';
    $html .= '        <th>Name</th>';
    $html .= '        <th>Course Name</th>';
    $html .= '        <th>Card Number</th>';
    $html .= '        <th>Actions</th>';
    $html .= '    </tr>';
    $html .= '</thead>';
    if (mysqli_num_rows($result)) {

        while ($row = mysqli_fetch_assoc($result)) {
            $html .= '<tr>';
            $html .= '<td>' . $row['id'] . '</td>';
            $html .= '<td>' . $row['name'] . '</td>';
            $html .= '<td>' . $row['c_name'] . '</td>';
            $html .= '<td>' . $row['c_no'] . '</td>';
            $html .= '<td>';
            $html .= '<a data-id="' . $row['id'] . '" class="btn btn-info" id="update" href="#" ><i class="fa fa-edit  "></i></a>';
            $html .= '<a data-id="' . $row['id'] . '" class="btn btn-danger" id="delete" href="#"><i class="fa fa-trash  "></i></a>';
            $html .= '</td>';
            $html .= '</tr>';
        }
        echo json_encode(['status' => 'success', 'html' => $html]);
    } else {
        $html .= '<tr colspan="">';
        $html .= '<td>SORRY NO DATA FOUND!</td>';
        $html .= '<tr>';
        echo json_encode(['status' => 'danger', 'html' => $html]);
    }
}

function add_data($post)
{
    $dbconn = get_db();
    $name   = $post['name'];
    $c_name = $post['c_name'];
    $c_no   = $post['c_no'];
    $sql    = "INSERT INTO student(name,c_name,c_no) VALUES(?,?,?)";
    $stmt   = mysqli_prepare($dbconn, $sql);
    if (is_object($stmt)) {
        mysqli_stmt_bind_param($stmt, 'sss', $name, $c_name, $c_no);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) == 1) {
            echo json_encode(['status' => 'success', 'message' => 'Data Inserted!',]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data Not Inserted!',]);
        }
    }
}
function getData($id)
{
    $dbconn = get_db();
    $id     = $id['id'];
    $sql    = "SELECT * FROM student WHERE id = '$id'";
    $result = mysqli_query($dbconn, $sql);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        // echo $data['name'];
        echo json_encode(['status' => 'success', 'data' => $data,]);
    }
}
function updateData($post){
    $dbconn = get_db();
    $id     = $post['id'];
    $name   = $post['name'];
    $c_name = $post['c_name'];
    $c_no   = $post['c_no'];
    $sql    = mysqli_query($dbconn,"UPDATE student SET name='$name',c_name='$c_name',c_no='$c_no ' WHERE id='$id'");
    if ($sql) {
        echo json_encode(['status' => 'success','message' => 'Data Updated!']);
    }
}

function deleteData($id){
    $dbconn = get_db();
    $id = $id['id'];
    $sql = mysqli_query($dbconn,"DELETE FROM student WHERE id='$id'");
    if($sql){
        echo json_encode(['status' => 'success','message' => 'Data DELETED']);
    }
}