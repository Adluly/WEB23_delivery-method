<?php

error_reporting(0);

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Credentials: true');

// Database connection parameters
// $servername = "localhost";
// $username = "corr4862_chatbot";
// $password = "]MZ%1Iux@cD&";
// $dbname = "corr4862_chatbot";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web23";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"));

switch ($method) {
    case 'GET':
        // Read - Retrieve delivery methods
        $id = $_REQUEST['id'];
        $result = $conn->query("SELECT * FROM delivery_method");
        $delivery_methods = [];
        while ($row = $result->fetch_assoc()) {
            if ($id && $id == $row['id']) {
                $delivery_methods = $row;
            } else {
                $delivery_methods[] = $row;
            }
        }
        echo json_encode($delivery_methods);
        break;

    case 'POST':
        // Create - Insert a new delivery method
        $delivery_name = $data->delivery_name;
        $delivery_fee = $data->delivery_fee;
        $estimation_delivery = $data->estimation_delivery;
        $image = 'http://localhost/web23_team_5-main/backend/1.png';

        // move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);

        $sql = "INSERT INTO delivery_method (delivery_name, delivery_fee, estimation_delivery, image)
                VALUES ('$delivery_name', '$delivery_fee', '$estimation_delivery', '$image')";

        if ($conn->query($sql) === TRUE) {
            $result_json = [
                "status" => true,
                "ok" => true,
                "message" => "OK"
            ];
            echo json_encode($result_json);
        } else {
            $result_json = [
                "status" => true,
                "ok" => true,
                "message" => "OK"
            ];
            echo json_encode($result_json);
        }
        break;

    case 'PUT':
        // Update - Update an existing delivery method
        $id = $data->id;
        $delivery_name = $data->delivery_name;
        $delivery_fee = $data->delivery_fee;
        $estimation_delivery = $data->estimation_delivery;
        // $image = $_FILES['image']['name'];

        // move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
        $sql = "UPDATE delivery_method
                SET delivery_name='$delivery_name', delivery_fee='$delivery_fee', estimation_delivery='$estimation_delivery' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $result_json = [
                "status" => true,
                "ok" => true,
                "message" => "OK"
            ];
            echo json_encode($result_json);
        } else {
            $result_json = [
                "status" => true,
                "ok" => true,
                "message" => "OK"
            ];
            echo json_encode($result_json);
        }
        break;

    case 'DELETE':
        // Delete - Delete an existing delivery method
        $id = $_GET['id'];

        $sql = "DELETE FROM delivery_method WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $result_json = [
                "status" => true,
                "ok" => true,
                "message" => "OK"
            ];
            echo json_encode($result_json);
        } else {
            $result_json = [
                "status" => true,
                "ok" => true,
                "message" => "OK"
            ];
            echo json_encode($result_json);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method Not Allowed"));
        break;
}

$conn->close();

?>
