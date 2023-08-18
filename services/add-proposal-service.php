<?php
error_reporting(E_ALL);
session_start();

require_once '../config/database.php';
$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kd_kategori = isset($_POST['kategori']) ? $_POST['kategori'] : "";
    $judul = isset($_POST['judul']) ? $_POST['judul'] : "";
    $semester = isset($_POST['semester']) ? $_POST['semester'] : "";
    $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : "";
    $url = isset($_POST['url']) ? $_POST['url'] : "";
    if (isset($_POST['submit'])) {
        if (empty($kd_kategori) || empty($judul) || empty($semester) || empty($tahun) || empty($url)) {
            $_SESSION['add_proposal_error'] = "Mohon untuk lengkapi data form sebelum melakukan submit!";
            // Redirect back to the add proposal page
            header('Location: ../tambah-proposal.php');
            exit;
        }
        // $code = $kd_kategori . "-" . generateCode("SELECT * FROM tbl_proposal WHERE kd_kategori = '" . $kd_kategori . "'");
        $code = generateCode($kd_kategori, "SELECT * FROM tbl_proposal WHERE kd_kategori = '" . $kd_kategori . "'");
        $insert = insertProposal($code, $kd_kategori, $judul, $semester, $tahun, $url, $user['kd_user'], 'submit');
        if ($insert > 0) {
            $_SESSION['add_proposal_success'] = "Pengajuan proposal anda telah berhasil tersubmit!";
            // Redirect back to the add proposal page
            header('Location: ../dashboard.php');
            exit;
        } else {
            $_SESSION['add_proposal_error'] = "Pengajuan anda gagal tersubmit!";
            // Redirect back to the add proposal page
            header('Location: ../tambah-proposal.php');
            exit;
        }
    } else {
        if (empty($kd_kategori) || empty($tahun) ) {
            $_SESSION['add_proposal_error'] = "Mohon untuk mengisi kategori dan tahun ajaran sebelum menyimpan data!";
            // Redirect back to the add proposal page
            header('Location: ../proposal-tersimpan.php');
            exit;
        }
        // if (empty($kd_kategori) && empty($judul) && empty($semester) && empty($tahun) && empty($url)) {
        //     $_SESSION['add_proposal_error'] = "Mohon untuk lengkapi data form sebelum menyimpan data!";
        //     // Redirect back to the add proposal page
        //     header('Location: ../tambah-proposal.php');
        //     exit;
        // }
        // $code = "";
        // if (!empty($kd_kategori)) {
        //     $code = $kd_kategori . "-" . generateCode("SELECT * FROM tbl_proposal WHERE kd_kategori = '" . $_POST['kategori'] . "'");
        // }
        $code = generateCode($kd_kategori, "SELECT * FROM tbl_proposal WHERE kd_kategori = '" . $_POST['kategori'] . "'");
        $save = insertProposal($code, $kd_kategori, $judul, $semester, $tahun, $url, $user['kd_user'], 'save');
        if ($save > 0) {
            $_SESSION['add_proposal_success'] = "Pengajuan proposal anda berhasil tersimpan!";
            // Redirect back to the add proposal page
            header('Location: ../dashboard.php');
            exit;
        } else {
            $_SESSION['add_proposal_error'] = "Pengajuan anda gagal tersimpan!";
            // Redirect back to the add proposal page
            header('Location: ../tambah-proposal.php');
            exit;
        }
    }
}

function insertProposal($kd_proposal, $kd_kategori, $judul, $semester, $tahun, $url, $kd_user, $method) {
    // Perform database connection
    $conn = connect_to_database();
    // Prepare and execute the query to insert data to tbl_proposal
    $query = "INSERT INTO tbl_proposal (kd_proposal, kd_kategori, status_id, judul, semester, tahun_ajar_id, link_dokumen, created_by, updated_by) VALUES (:kd_proposal, :kd_kategori, :status_id, :judul, :semester, :tahun_ajar_id, :link_dokumen, :kd_user, :kd_user)";
    $stmt = $conn->prepare($query);
    // bind parameter ke query
    $params = array(
        ":kd_proposal" => $kd_proposal,
        ":kd_kategori" => $kd_kategori,
        ":status_id" => $method == 'submit' ? 2 : 11,
        ":judul" => $judul,
        ":semester" => $semester,
        ":tahun_ajar_id" => $tahun,
        ":link_dokumen" => $url,
        ":kd_user" => $kd_user
    );
    $stmt->execute($params);
    $last_proposal_id = $conn->lastInsertId();
    if ($method == 'submit') {
        if ($last_proposal_id > 0) {
            // Prepare and execute the query to insert data to tbl_proses
            $query = "INSERT INTO tbl_proposal_status (proposal_id, akun_id, status_id) VALUES (:proposal_id, :akun_id, 1), (:proposal_id, :akun_id, 2)";
            $stmt = $conn->prepare($query);
            // bind parameter ke query
            $params = array(
                ":proposal_id" => $last_proposal_id,
                ":akun_id" => $_SESSION['user']['id']
            );
            $stmt->execute($params);
            $last_flow_id = $conn->lastInsertId();
            if ($last_flow_id > 0) return $conn->lastInsertId();
        }

        return 0;
    }

    if ($last_proposal_id > 0) return $conn->lastInsertId();

    return 0;
}

function generateCode($kd_kategori, $query) {
    // Perform database connection
    $conn = connect_to_database();
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = count($results);
    $code = "";
    while (empty($code)) {
        $count++;
        // Generate the code
        $generateCode = $kd_kategori . "-" . str_pad($count, 5, '0', STR_PAD_LEFT);
        $query = "SELECT COUNT(*) As proposal_count FROM tbl_proposal WHERE kd_proposal=:generate_code";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':generate_code', $generateCode);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && $result['proposal_count'] == 0) $code = $generateCode;
    }
    
    return $code;
}
?>