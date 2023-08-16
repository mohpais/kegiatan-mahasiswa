<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection details from database.php
    require_once '../config/database.php';
    // Get the kd_user and password from the login form (sanitize the input)
    $kd_user = $_POST['kd_user'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    if (empty($kd_user) || empty($password) || empty($nama)) {
        $_SESSION['registration_error'] = "Please type kode and password!";
        // Redirect back to the login page
        header('Location: ../sign-up.php');
        exit;
    } elseif ($password != $repassword) {
        $_SESSION['registration_error'] = "Password and repassword not same!";
        // Redirect back to the login page
        header('Location: ../sign-up.php');
        exit;
    }
    
    // Perform user authentication (e.g., querying the database)
    $registered = registerUser($kd_user, $nama, $password);
}

function registerUser($kd_user, $nama, $password) {
    // Hash and encrypt the password using password_hash()
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    if ($hashed_password === false) {
        $error = password_get_info();
        // You can log the error or take appropriate action based on the error information.
        $message = "Password hash failed: " . $error['algo'];
        $_SESSION['registration_error'] = $message;
    }
    // Perform database connection
    $conn = connect_to_database();

    // Prepare and execute the query for search of role for user register
    $findRole = $conn->prepare("SELECT * FROM tbl_role WHERE nama='Mahasiswa'");
    $findRole->execute();
    $role = $findRole->fetch(PDO::FETCH_ASSOC);
    if ($role) {
        // Prepare and execute the query to insert user details into the database
        $stmt = $conn->prepare("INSERT INTO tbl_akun (kd_user, role_id, nama, password) VALUES (:kd_user, :role_id, :name, :password)");
        // bind parameter ke query
        $params = array(
            ":kd_user" => $kd_user,
            ":role_id" => $role['id'],
            ":name" => $nama,
            ":password" => $hashed_password
        );
        
        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);
        
        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved) header("Location: ../sign-in.php");
    } else {
        $_SESSION['registration_error'] = "Role not found!";
        // Redirect back to the login page
        header('Location: ../sign-up.php');
        exit;
    }
}
?>