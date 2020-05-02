<?php
require_once('db.php');

$sql = mysqli_query($dbconn, "SELECT * FROM student");
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
if (mysqli_num_rows($sql)) {
    while ($row = mysqli_fetch_assoc($sql)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['id'] . '</td>';
        $html .= '<td>' . $row['name'] . '</td>';
        $html .= '<td>' . $row['c_name'] . '</td>';
        $html .= '<td>' . $row['c_no'] . '</td>';
        $html .= '<td>';
        $html .= '<i data-id="' . $row['id'] . '"id="update" class="fa fa-edit btn btn-info"></i> &nbsp;';
        $html .= '<i data-id="' . $row['id'] . '"id="delete" class="fa fa-trash btn btn-danger"></i>';
        $html .= '</td>';
        $html .= '</tr>';
    }
    echo json_encode(['status' => 'success', 'data' => $html]);
} else {
    $html = '<h1 class="display-1 text-danger text-center text-bolder">SORRY!</h1>';
    echo json_encode(['status' => 'error', 'data' => $html]);
}
