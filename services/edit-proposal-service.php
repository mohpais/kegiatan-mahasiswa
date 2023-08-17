<?php
error_reporting(E_ALL);
session_start();

require_once '../config/database.php';
$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $kd_proposal = $_POST['kd_proposal'];
    $kd_kategori = $_POST['kd_kategori'];
    $judul = $_POST['judul'];
    $semester = $_POST['semester'];
    $tahun = $_POST['tahun'];
    $url = $_POST['url'];
    if (empty($kd_proposal) || empty($judul) || empty($semester) || empty($tahun) || empty($url)) {
        $_SESSION['edit_proposal_error'] = "Mohon untuk lengkapi data form sebelum melakukan submit!";
        // Redirect back to the add proposal page
        header('Location: ../edit-proposal.php?id=' . $kd_proposal);
        exit;
    }

    $conn = connect_to_database();
    $stmt = $conn->prepare("SELECT * FROM tbl_proposal WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $currentProposal = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $kd_proposal . '<br />';
    if (isset($currentProposal) && $currentProposal['kd_kategori'] != $kd_kategori) {
        $kd_proposal = $kd_kategori . "-" . generateCode("SELECT * FROM tbl_proposal WHERE kd_kategori = '" . $kd_kategori . "'");
    }

    $update = updateProposal($id, $kd_proposal, $kd_kategori, $judul, $semester, $tahun, $url);
    if ($update > 0) {
        $_SESSION['edit_proposal_success'] = "Revisi proposal telah berhasil!";
        // Redirect back to the add proposal page
        header('Location: ../dashboard.php');
        exit;
    } else {
        $_SESSION['edit_proposal_error'] = "Revisi proposal gagal!";
        // Redirect back to the add proposal page
        header('Location: ../edit-proposal.php?id=' . $kd_proposal);
        exit;
    }
}

function updateProposal($id, $kd_proposal, $kd_kategori, $judul, $semester, $tahun, $url) {
    // Perform database connection
    $conn = connect_to_database();

    // Prepare and execute the query to insert data to tbl_proposal
    $query = "UPDATE tbl_proposal SET kd_proposal = :kd_proposal, kd_kategori = :kd_kategori, status_id = 2, judul = :judul, semester = :semester, tahun_ajar_id = :tahun_ajar_id, link_dokumen = :link_dokumen WHERE id = :id";
    $stmt = $conn->prepare($query);
    // bind parameter ke query
    $params = array(
        ":kd_proposal" => $kd_proposal,
        ":kd_kategori" => $kd_kategori,
        ":judul" => $judul,
        ":semester" => $semester,
        ":tahun_ajar_id" => $tahun,
        ":link_dokumen" => $url,
        ":id" => $id,
    );
    $success = $stmt->execute($params);
    if ($success) {
        $query = "UPDATE tbl_proposal_status SET is_shown = 0 WHERE proposal_id = :proposal_id AND status_id = 6 AND is_shown = 1";
        $stmt = $conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':proposal_id', $id);
        $stmt->execute();

        // Prepare and execute the query to insert data to tbl_proses
        $query = "INSERT INTO tbl_proposal_status (proposal_id, akun_id, status_id) VALUES (:proposal_id, :akun_id, 8), (:proposal_id, :akun_id, 2)";
        $stmt = $conn->prepare($query);
        // bind parameter ke query
        $params = array(
            ":proposal_id" => $id,
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