<?php
error_reporting(E_ALL);
session_start();

require_once '../config/database.php';
$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_proposal = $_POST['kd_proposal'];
    $judul = $_POST['judul'];
    $semester = $_POST['semester'];
    $tahun = $_POST['tahun'];
    $url = $_POST['url'];
    if (empty($kd_proposal) || empty($judul) || empty($semester) || empty($tahun) || empty($url)) {
        $_SESSION['edit_proposal_error'] = "Mohon untuk lengkapi data form!";
        // Redirect back to the add proposal page
        header('Location: ../edit-proposal.php?id=' . $kd_proposal);
        exit;
    }

    $update = updateProposal($kd_proposal, $judul, $semester, $tahun, $url);
    if ($update > 0) {
        $_SESSION['edit_proposal_success'] = "Revisi proposal telah berhasil!";
        // Redirect back to the add proposal page
        header('Location: ../edit-proposal.php?id=' . $kd_proposal);
        exit;
    } else {
        $_SESSION['edit_proposal_error'] = "Revisi proposal gagal!";
        // Redirect back to the add proposal page
        header('Location: ../edit-proposal.php?id=' . $kd_proposal);
        exit;
    }
}

function updateProposal($kd_proposal, $judul, $semester, $tahun, $url) {
    // Perform database connection
    $conn = connect_to_database();

    // Prepare and execute the query to insert data to tbl_proposal
    $query = "UPDATE tbl_proposal SET status_id = 2, judul = :judul, semester = :semester, tahun = :tahun, link_dokumen = :link_dokumen WHERE kd_proposal = :kd_proposal";
    $stmt = $conn->prepare($query);
    // bind parameter ke query
    $params = array(
        ":judul" => $judul,
        ":semester" => $semester,
        ":tahun" => $tahun,
        ":link_dokumen" => $url,
        ":kd_proposal" => $kd_proposal,
    );
    $success = $stmt->execute($params);
    if ($success) {
        $query = "UPDATE tbl_proposal_status SET is_shown = 0 WHERE kd_proposal = :kd_proposal AND status_id = 6 AND is_shown = 1";
        $stmt = $conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':kd_proposal', $kd_proposal);
        $stmt->execute();

        // Prepare and execute the query to insert data to tbl_proses
        $query = "INSERT INTO tbl_proposal_status (kd_proposal, akun_id, status_id) VALUES (:kd_proposal, :akun_id, 8), (:kd_proposal, :akun_id, 2)";
        $stmt = $conn->prepare($query);
        // bind parameter ke query
        $params = array(
            ":kd_proposal" => $kd_proposal,
            ":akun_id" => $_SESSION['user']['id']
        );
        $stmt->execute($params);
        $last_flow_id = $conn->lastInsertId();
        if ($last_flow_id) return $conn->lastInsertId();
    }

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