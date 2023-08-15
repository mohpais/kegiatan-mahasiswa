<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();

    // Check if the login form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Include the database connection details from database.php
        require_once '../config/database.php';
        // Get the username and password from the login form (sanitize the input)
        $kd_user = $_POST['kd_user']; // You may use htmlentities or other sanitization functions
        $password = $_POST['password']; // You should also hash the password before storing it
        if (empty($kd_user) || empty($password)) {
            $_SESSION['login_error'] = "Please type kode and password!";
            // Redirect back to the login page
            header('Location: ../sign-in.php');
            exit;
        }
        // Perform user authentication (e.g., querying the database)
        // Replace this with your actual authentication logic
        $user = authenticateUser($kd_user, $password);

        if ($user) {
            // Store the user ID or any relevant data in the session for future use
            $_SESSION['user'] = $user;
            // You can store other user data in the session as needed (e.g., name, email, etc.)
            if ($user['role'] == 'Mahasiswa') {
                header('Location: ../dashboard.php');
            } elseif ($user['role'] == 'Kaprodi') {
                header('Location: ../laporan.php');
            } else {
                header('Location: ../monitoring.php');
            }
            // Redirect the user to the dashboard or any other authorized page
            exit;
        } else {
            // Invalid login credentials, display an error message
            $error_message = 'Invalid username or password';
            $_SESSION['login_error'] = $error_message;
            // Redirect back to the login page
            header('Location: ../sign-in.php');
            exit;
        }
    }

    function authenticateUser($kd_user, $password) {
        // Perform database connection
        $conn = connect_to_database();

        // Prepare and execute the query to find the user by kd_user
        $stmt = $conn->prepare("SELECT akun.*, role.nama role FROM tbl_akun akun join tbl_role role on role.id = akun.role_id WHERE kd_user = :kd_user");
        // bind parameter ke query
        $params = array(
            ":kd_user" => $kd_user
        );
        $stmt->execute($params);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // jika user terdaftar
        if ($user) {
            // Verify the provided password against the hashed password in the database
            if (password_verify($password, $user['password'])) return $user;
        }

        // User not found or invalid password, return false
        return null;
    }
?>