
<?php

require "config.php";

function connect()
{
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($mysqli->connect_errno != 0) {
        $error = $mysqli->connect_error;
        $error_date = date("F j, Y, g:i a");
        $message = "{$error} | {$error_date} \r\n";
        file_put_contents("db-log.txt", $message, FILE_APPEND);
        return false;
    } else {
        return $mysqli;
    }

}

function registerAdmin($username, $password)
{
    $mysqli = connect();
    $args = func_get_args();

    $args = array_map(function ($value) {
        return trim($value);
    }, $args);

    foreach ($args as $value) {
        if (empty($value)) {
            return "All fields are required";
        }
    }

    foreach ($args as $value) {
        if (preg_match("/([<|>])/", $value)) {
            return "characters are not allowed";
        }
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO admin(username, password) VALUES(?,?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        return "An error ocurred, Please try again";
    } else {
        return "success";
    }




}

function loginAdmin($username, $password)
{
    $mysqli = connect();
    $username = mysqli_real_escape_string($mysqli, $username);
    $password = mysqli_real_escape_string($mysqli, $password);
    $username = trim($username);
    $password = trim($password);

    if ($username == "" || $password == "") {
        $response = array("message" => "Field are required to be filled", "status" => "error");

        return $response;
    }

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $sql = "SELECT username, password FROM admin WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data == NULL) {
        $response = array("message" => "Username atau password anda salah!", "status" => "error");

        return $response;
    }

    if (password_verify($password, $data["password"]) == FALSE) {
        $response = array("message" => "Username atau password anda salah!", "status" => "error");

        return $response;
    } else {
        $_SESSION["user"] = $username;
        header("location: dashboard.php");
        exit();
    }
}

function logoutUser()
{
    session_destroy();
    header("location: login.php");
    exit();
}

