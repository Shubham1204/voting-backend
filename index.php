<?php

$conn = mysqli_connect("localhost", "root", "", "voting");

$request = $_SERVER['REQUEST_METHOD'];

$data = array();

switch ($request) {
        	case 'POST':
            checkUser();
           break;
    default:
        # code...
        break;
}

function checkUser()
{
    global $conn;
    $sql="SELECT status FROM user_mst where username='{$_POST['username']}' and password='{$_POST['u_password']}'";
    $query = mysqli_query($conn,$sql );
    if (mysqli_num_rows($query) > 0) {
        response(getData());
    } else {
        $data[] = array("message" => "fail");
        response($data);
    }
}

function getData()
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * from user_mst where username='{$_POST['username']}' and password='{$_POST['u_password']}'");
    while ($row = mysqli_fetch_assoc($query)) {

        $data[] = array("user_id" => $row['userid'], "name" => $row['username'], "u_password" => $row['password'], "u_stat" => $row['status'], "message" => "success");
    }
    return $data;
}




function response($data)
{

    echo  json_encode($data);
}
