<?php
error_reporting(E_ALL);
session_start();

require_once '../config/database.php';
$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_kategori = $_POST['kategori'];
    $judul = $_POST['judul'];
    $semester = $_POST['semester'];
    $tahun = $_POST['tahun'];
    $url = $_POST['url'];
    if (empty($judul) || empty($url)) {
        $_SESSION['add_proposal_error'] = "Mohon untuk lengkapi data form!";
        // Redirect back to the add proposal page
        header('Location: ../add-proposal.php');
        exit;
    }

    $code = $kd_kategori . "-" . generateCode("SELECT * FROM tbl_proposal WHERE kd_proposal LIKE '%" . $kd_kategori . "%'");
    $insert = insertProposal($code, $judul, $semester, $tahun, $url, $user['kd_user']);
    if ($insert > 0) {
        $_SESSION['add_proposal_success'] = "Pengajuan proposal anda telah berhasil!";
        // Redirect back to the add proposal page
        header('Location: ../tambah-proposal.php');
        exit;
    } else {
        $_SESSION['add_proposal_error'] = "Pengajuan anda gagal!";
        // Redirect back to the add proposal page
        header('Location: ../tambah-proposal.php');
        exit;
    }
}

function insertProposal($kd_proposal, $judul, $semester, $tahun, $url, $kd_user) {
    // Perform database connection
    $conn = connect_to_database();

    // Prepare and execute the query to insert data to tbl_proposal
    $query = "INSERT INTO tbl_proposal (kd_proposal, status_id, judul, semester, tahun, link_dokumen, created_by, updated_by) VALUES (:kd_proposal, 2, :judul, :semester, :tahun, :link_dokumen, :kd_user, :kd_user)";
    $stmt = $conn->prepare($query);
    // bind parameter ke query
    $params = array(
        ":kd_proposal" => $kd_proposal,
        ":judul" => $judul,
        ":semester" => $semester,
        ":tahun" => $tahun,
        ":link_dokumen" => $url,
        ":kd_user" => $kd_user
    );
    $stmt->execute($params);

    // Prepare and execute the query to insert data to tbl_proses
    $query = "INSERT INTO tbl_proposal_status (kd_proposal, akun_id, status_id) VALUES (:kd_proposal, :akun_id, 1), (:kd_proposal, :akun_id, 2)";
    $stmt = $conn->prepare($query);
    // bind parameter ke query
    $params = array(
        ":kd_proposal" => $kd_proposal,
        ":akun_id" => $_SESSION['user']['id']
    );
    $stmt->execute($params);
    $last_flow_id = $conn->lastInsertId();
    if ($last_flow_id) return $conn->lastInsertId();

    return 0;
}

function generateCode($query) {
    // Perform database connection
    $conn = connect_to_database();
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = count($results) + 1;
    // Generate the code
    $code = str_pad($count, 5, '0', STR_PAD_LEFT);

    return $code;
}
?>