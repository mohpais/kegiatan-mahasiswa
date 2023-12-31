<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
    // Include the functions.php file from the main theme directory
    require_once 'helpers/authorize.php';
    require_once 'helpers/functions.php';
    require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="./assets/img/favicon.png">
        <title>
            Website Kegiatan Mahasiswa
        </title>
        <!-- Fonts and icons -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="./assets/css/argon-dashboard.css" rel="stylesheet" />
    </head>

    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-ubk position-absolute w-100"></div>
        <!-- Include the sidebar -->
        <?php include 'includes/sidebar.php' ?>
        <main class="main-content position-relative border-radius-lg ">
            <!-- Navbar -->
            <?php include 'includes/navbar.php' ?>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
            <!-- <div class="row">
                <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Proposal</p>
                                        <h5 class="font-weight-bolder">11</h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">LPJ</p>
                                        <h5 class="font-weight-bolder">5</h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="row">
                <div class="col-12">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile-tabs-icons" role="tab" aria-controls="preview" aria-selected="true">
                                    <i class="fa fa-list text-sm me-2"></i> Pengajuan Tertunda
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dashboard-tabs-icons" role="tab" aria-controls="code" aria-selected="false">
                                    <i class="fas fa-tasks text-sm me-2"></i> Pengajuan Selesai
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header border pb-3">
                            <div class="row">
                                <div class="col-auto my-auto">
                                    <h6 class="mb-0">Daftar Pengajuan Proposal</h6>
                                    <p class="text-xs mb-0 text-secondary font-weight-bold">Datfar proposal yang sedang diajukan oleh Anda.</p>
                                </div>
                                <div class="col-md-auto my-auto ms-auto d-md-block d-none">
                                    <a class="btn btn-icon px-3 btn-sm btn-success my-auto" href="tambah-proposal.php">
                                        <span class="btn-inner--icon"><i class="fa fa-plus me-1"></i>Buat Proposal</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <?php 
                                if (isset($_SESSION['add_proposal_success'])) {
                                    $message = $_SESSION['add_proposal_success'];
                                    echo "<div class='alert alert-success mx-4 my-2' role='alert'>" . $message . "</div>";
                                    unset($_SESSION['add_proposal_success']);
                                }
                                if (isset($_SESSION['edit_proposal_success'])) {
                                    $message = $_SESSION['edit_proposal_success'];
                                    echo "<div class='alert alert-success mx-4 my-2' role='alert'>" . $message . "</div>";
                                    unset($_SESSION['edit_proposal_success']);
                                }
                                if (isset($_SESSION['add_lpj_success'])) {
                                    $message = $_SESSION['add_lpj_success'];
                                    echo "<div class='alert alert-success mx-4 my-2' role='alert'>" . $message . "</div>";
                                    unset($_SESSION['add_lpj_success']);
                                }
                                if (isset($_SESSION['edit_lpj_success'])) {
                                    $message = $_SESSION['edit_lpj_success'];
                                    echo "<div class='alert alert-success mx-4 my-2' role='alert'>" . $message . "</div>";
                                    unset($_SESSION['edit_lpj_success']);
                                }
                            ?>
                            <div class="row">
                                <div class="col">
                                    <ul class="nav nav-pills py-0 px-0" role="tablist">
                                        <li class="nav-item">
                                            <button class="nav-link text-sm active" data-bs-toggle="tab" data-bs-target="#nav-pengajuan" type="button" role="tab" aria-controls="nav-pengajuan" aria-selected="true">
                                                Semua Pengajuan
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link text-sm" data-bs-toggle="tab" data-bs-target="#nav-selesai" type="button" role="tab" aria-controls="nav-selesai" aria-selected="true">
                                                Pengajuan Selesai
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link text-sm" data-bs-toggle="tab" data-bs-target="#nav-tertunda" type="button" role="tab" aria-controls="nav-tertunda" aria-selected="true">
                                                Pengajuan Berlangsung
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-pengajuan" role="tabpanel" aria-labelledby="nav-pengajuan-tab">
                                            <div class="table-responsive p-0">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Kode Proposal</th>
                                                            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-8">Judul</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8 ps-2">Kategori</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Link Proposal</th>
                                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-8">Link LPJ</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Status Pengajuan</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Diajukan pada</th>
                                                            <th class="text-secondary opacity-8"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            // Perform database connection
                                                            $conn = connect_to_database();
                                                            // jalankan query
                                                            $stmt = $conn->prepare("
                                                                SELECT 
                                                                    ps.*, 
                                                                    lpj.id lpj_id ,
                                                                    lpj.link_foto ,
                                                                    kg.nama kategori , 
                                                                    sp.nama status 
                                                                FROM 
                                                                    tbl_proposal ps 
                                                                    LEFT JOIN 
                                                                        tbl_kategori kg 
                                                                        ON
                                                                            kg.kd_kategori = ps.kd_kategori
                                                                    LEFT JOIN 
                                                                        tbl_status sp 
                                                                        ON
                                                                            sp.id = ps.status_id
                                                                    LEFT JOIN 
                                                                        tbl_lpj lpj 
                                                                        ON
                                                                            lpj.proposal_id = ps.id
                                                                WHERE
                                                                    ps.created_by = :kd_user
                                                                ORDER BY ps.created_at DESC
                                                            ");
                                                            // bind parameter ke query
                                                            $stmt->bindParam(':kd_user', $_SESSION['user']['kd_user']);
                                                            $stmt->execute();
                                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <?php if (count($results) > 0) {?>
                                                            <?php foreach ($results as $row) { ?>
                                                                <tr>
                                                                    <td class="text-center text-xs"><?php echo $row['kd_proposal'] ? $row['kd_proposal'] : '-'; ?></td>
                                                                    <td class="">
                                                                        <?php 
                                                                            if ($row['judul']) {
                                                                                # code...
                                                                                $originalString = $row['judul']; // Replace with your actual string
                    
                                                                                if (strlen($originalString) > 15) {
                                                                                    $shortenedString = substr($originalString, 0, 15) . '...';
                                                                                } else {
                                                                                    $shortenedString = $originalString;
                                                                                }
                                                                            } else {
                                                                                $shortenedString = '-';
                                                                            }
                                                                        ?>
                                                                        <p class="text-xs font-weight-bold mb-0 <?php echo !$row['judul'] ? 'text-center' : '' ?>"><?php echo $shortenedString ?></p>
                                                                    </td>
                                                                    <td class="">
                                                                        <p class="text-xs text-secondary mb-0"><?php echo $row['kategori'] ? $row['kategori'] : '-' ?></p>
                                                                    </td>
                                                                    <td class="text-center text-xs">
                                                                        <?php if ($row['link_dokumen']) { ?>
                                                                            <a href="<?php echo $row['link_dokumen'] ?>" target="_blank" class="text-xs text-primary mb-0">
                                                                                <u><i class="fa fa-file-pdf-o me-1"></i>Lihat Dokumen</u>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <span class="font-weight-bold">-</span>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td class="align-middle text-center text-xs">
                                                                        <?php if ($row['link_foto']) { ?>
                                                                            <a href="<?php echo $row['link_foto'] ?>" target="_blank" class="text-xs text-primary mb-0">
                                                                                <u><i class="fa fa-file-picture-o me-1"></i>Lihat Foto</u>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <span class="font-weight-bold">-</span>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td class="align-middle text-center text-sm">
                                                                        <?php 
                                                                            $namaStatus = $row['status'];
                                                                            $badgeColor = "success";
                                                                            if ($row["status_id"] == 2) {
                                                                                $badgeColor = "warning";
                                                                            } elseif ($row["status_id"] == 4) {
                                                                                $badgeColor = "danger";
                                                                            } elseif ($row["status_id"] == 6) {
                                                                                $badgeColor = "primary";
                                                                            } elseif ($row["status_id"] == 11) {
                                                                                $badgeColor = "info";
                                                                            } 
                                                                        ?>
                                                                        <span class="badge badge-sm bg-gradient-<?php echo $badgeColor; ?>"><?php echo $namaStatus ?></span>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <span class="text-secondary text-xs font-weight-bold">
                                                                            <?php
                                                                                $timestamp = strtotime($row['created_at']);
                                                                                $formattedDate = date('d-M-Y H:m', $timestamp);
                
                                                                                echo $formattedDate;
                                                                            ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <?php if ($row['status_id'] == 3 && $row['lpj_id'] == null) { ?>
                                                                            <a href="tambah-lpj.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                                                                                <!-- <span class="btn-inner--text">Buat Laporan</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if (($row['lpj_id'] == null && $row['status_id'] != 3 && $row['status_id'] != 6 && $row['status_id'] != 11) || $row['status_id'] == 2 || $row['status_id'] == 7 ) { ?>
                                                                            <!-- <a href="review-pengajuan.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-info my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-eye"></i></span>
                                                                                <span class="btn-inner--text">Lihat Pengajuan</span>
                                                                            </a> -->
                                                                            <form method="post">
                                                                                <button type="submit" name="move" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                                                    <span class="btn-inner--icon"><i class="fa fa-eye"></i></span>
                                                                                </button>
                                                                                <?php
                                                                                    $kd_p = $row['kd_proposal'];
                                                                                    if (isset($_POST['move'])) {
                                                                                        $_SESSION['page_before'] = get_current_url();
                                                                                        echo "<meta http-equiv='refresh' content='1;url=review-pengajuan.php?id=" . $kd_p . "'>";
                                                                                    }
                                                                                ?>
                                                                            </form>
                                                                        <?php } ?>
                                                                        <?php if ($row['status_id'] == 6 && $row['lpj_id'] == null) { ?>
                                                                            <a href="edit-proposal.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-warning my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                                                <!-- <span class="btn-inner--text">Edit Proposal</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if ($row['status_id'] == 11) { ?>
                                                                            <a href="proposal-tersimpan.php" class="btn btn-icon px-3 btn-sm btn-warning my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                                                <!-- <span class="btn-inner--text">Edit Proposal</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if ($row['status_id'] == 6 && $row['lpj_id']) { ?>
                                                                            <a href="edit-lpj.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                                                <!-- <span class="btn-inner--text">Edit LPJ</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <tr>
                                                                <td class="text-center" colspan="7"><div class="h6">Tidak ada pengajuan yang sedang berlangsung</div></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-selesai" role="tabpanel" aria-labelledby="nav-tertunda-tab">
                                            <div class="table-responsive p-0">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Kode Proposal</th>
                                                            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-8">Judul</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8 ps-2">Kategori</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Link Proposal</th>
                                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-8">Link LPJ</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Status Pengajuan</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Diajukan pada</th>
                                                            <th class="text-secondary opacity-8"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            // Perform database connection
                                                            $conn = connect_to_database();
                                                            // jalankan query
                                                            $stmt = $conn->prepare("
                                                                SELECT 
                                                                    ps.*, 
                                                                    lpj.id lpj_id ,
                                                                    lpj.link_foto ,
                                                                    kg.nama kategori , 
                                                                    sp.nama status 
                                                                FROM 
                                                                    tbl_proposal ps 
                                                                    LEFT JOIN 
                                                                        tbl_kategori kg 
                                                                        ON
                                                                            kg.kd_kategori = ps.kd_kategori
                                                                    LEFT JOIN 
                                                                        tbl_status sp 
                                                                        ON
                                                                            sp.id = ps.status_id
                                                                    LEFT JOIN 
                                                                        tbl_lpj lpj 
                                                                        ON
                                                                            lpj.proposal_id = ps.id
                                                                WHERE
                                                                    ps.created_by = :kd_user AND ps.status_id IN (4, 7)
                                                                ORDER BY ps.created_at DESC
                                                            ");
                                                            // bind parameter ke query
                                                            $stmt->bindParam(':kd_user', $_SESSION['user']['kd_user']);
                                                            $stmt->execute();
                                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <?php if (count($results) > 0) {?>
                                                            <?php foreach ($results as $row) { ?>
                                                                <tr>
                                                                    <td class="text-center text-xs"><?php echo $row['kd_proposal'] ? $row['kd_proposal'] : '-'; ?></td>
                                                                    <td class="">
                                                                        <?php 
                                                                            if ($row['judul']) {
                                                                                # code...
                                                                                $originalString = $row['judul']; // Replace with your actual string
                    
                                                                                if (strlen($originalString) > 15) {
                                                                                    $shortenedString = substr($originalString, 0, 15) . '...';
                                                                                } else {
                                                                                    $shortenedString = $originalString;
                                                                                }
                                                                            } else {
                                                                                $shortenedString = '-';
                                                                            }
                                                                        ?>
                                                                        <p class="text-xs font-weight-bold mb-0 <?php echo !$row['judul'] ? 'text-center' : '' ?>"><?php echo $shortenedString ?></p>
                                                                    </td>
                                                                    <td class="">
                                                                        <p class="text-xs text-secondary mb-0"><?php echo $row['kategori'] ? $row['kategori'] : '-' ?></p>
                                                                    </td>
                                                                    <td class="text-center text-xs">
                                                                        <?php if ($row['link_dokumen']) { ?>
                                                                            <a href="<?php echo $row['link_dokumen'] ?>" target="_blank" class="text-xs text-primary mb-0">
                                                                                <u><i class="fa fa-file-pdf-o me-1"></i>Lihat Dokumen</u>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <span class="font-weight-bold">-</span>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td class="align-middle text-center text-xs">
                                                                        <?php if ($row['link_foto']) { ?>
                                                                            <a href="<?php echo $row['link_foto'] ?>" target="_blank" class="text-xs text-primary mb-0">
                                                                                <u><i class="fa fa-file-picture-o me-1"></i>Lihat Foto</u>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <span class="font-weight-bold">-</span>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td class="align-middle text-center text-sm">
                                                                        <?php 
                                                                            $namaStatus = $row['status'];
                                                                            $badgeColor = "success";
                                                                            if ($row["status_id"] == 2) {
                                                                                $badgeColor = "warning";
                                                                            } elseif ($row["status_id"] == 4) {
                                                                                $badgeColor = "danger";
                                                                            } elseif ($row["status_id"] == 6) {
                                                                                $badgeColor = "primary";
                                                                            } elseif ($row["status_id"] == 11) {
                                                                                $badgeColor = "info";
                                                                            } 
                                                                        ?>
                                                                        <span class="badge badge-sm bg-gradient-<?php echo $badgeColor; ?>"><?php echo $namaStatus ?></span>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <span class="text-secondary text-xs font-weight-bold">
                                                                            <?php
                                                                                $timestamp = strtotime($row['created_at']);
                                                                                $formattedDate = date('d-M-Y H:m', $timestamp);
                
                                                                                echo $formattedDate;
                                                                            ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <?php if ($row['status_id'] == 3 && $row['lpj_id'] == null) { ?>
                                                                            <a href="tambah-lpj.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                                                                                <!-- <span class="btn-inner--text">Buat Laporan</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if (($row['lpj_id'] == null && $row['status_id'] != 3 && $row['status_id'] != 6 && $row['status_id'] != 11) || $row['status_id'] == 2 || $row['status_id'] == 7 ) { ?>
                                                                            <!-- <a href="review-pengajuan.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-info my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-eye"></i></span>
                                                                                <span class="btn-inner--text">Lihat Pengajuan</span>
                                                                            </a> -->
                                                                            <form method="post">
                                                                                <button type="submit" name="move" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                                                    <span class="btn-inner--icon"><i class="fa fa-eye"></i></span>
                                                                                </button>
                                                                                <?php
                                                                                    $kd_p = $row['kd_proposal'];
                                                                                    if (isset($_POST['move'])) {
                                                                                        $_SESSION['page_before'] = get_current_url();
                                                                                        echo "<meta http-equiv='refresh' content='1;url=review-pengajuan.php?id=" . $kd_p . "'>";
                                                                                    }
                                                                                ?>
                                                                            </form>
                                                                        <?php } ?>
                                                                        <?php if ($row['status_id'] == 6 && $row['lpj_id'] == null) { ?>
                                                                            <a href="edit-proposal.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-warning my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                                                <!-- <span class="btn-inner--text">Edit Proposal</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if ($row['status_id'] == 11) { ?>
                                                                            <a href="proposal-tersimpan.php" class="btn btn-icon px-3 btn-sm btn-warning my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                                                <!-- <span class="btn-inner--text">Edit Proposal</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if ($row['status_id'] == 6 && $row['lpj_id']) { ?>
                                                                            <a href="edit-lpj.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                                                <!-- <span class="btn-inner--text">Edit LPJ</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <tr>
                                                                <td class="text-center" colspan="7"><div class="h6">Tidak ada pengajuan yang selesai</div></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-tertunda" role="tabpanel" aria-labelledby="nav-tertunda-tab">
                                            <div class="table-responsive p-0">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Kode Proposal</th>
                                                            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-8">Judul</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8 ps-2">Kategori</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Link Proposal</th>
                                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-8">Link LPJ</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Status Pengajuan</th>
                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Diajukan pada</th>
                                                            <th class="text-secondary opacity-8"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            // Perform database connection
                                                            $conn = connect_to_database();
                                                            // jalankan query
                                                            $stmt = $conn->prepare("
                                                                SELECT 
                                                                    ps.*, 
                                                                    lpj.id lpj_id ,
                                                                    lpj.link_foto ,
                                                                    kg.nama kategori , 
                                                                    sp.nama status 
                                                                FROM 
                                                                    tbl_proposal ps 
                                                                    LEFT JOIN 
                                                                        tbl_kategori kg 
                                                                        ON
                                                                            kg.kd_kategori = ps.kd_kategori
                                                                    LEFT JOIN 
                                                                        tbl_status sp 
                                                                        ON
                                                                            sp.id = ps.status_id
                                                                    LEFT JOIN 
                                                                        tbl_lpj lpj 
                                                                        ON
                                                                            lpj.proposal_id = ps.id
                                                                WHERE
                                                                    ps.created_by = :kd_user AND ps.status_id NOT IN (4, 7)
                                                                ORDER BY ps.created_at DESC
                                                            ");
                                                            // bind parameter ke query
                                                            $stmt->bindParam(':kd_user', $_SESSION['user']['kd_user']);
                                                            $stmt->execute();
                                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <?php if (count($results) > 0) {?>
                                                            <?php foreach ($results as $row) { ?>
                                                                <tr>
                                                                    <td class="text-center text-xs"><?php echo $row['kd_proposal'] ? $row['kd_proposal'] : '-'; ?></td>
                                                                    <td class="">
                                                                        <?php 
                                                                            if ($row['judul']) {
                                                                                # code...
                                                                                $originalString = $row['judul']; // Replace with your actual string
                    
                                                                                if (strlen($originalString) > 15) {
                                                                                    $shortenedString = substr($originalString, 0, 15) . '...';
                                                                                } else {
                                                                                    $shortenedString = $originalString;
                                                                                }
                                                                            } else {
                                                                                $shortenedString = '-';
                                                                            }
                                                                        ?>
                                                                        <p class="text-xs font-weight-bold mb-0 <?php echo !$row['judul'] ? 'text-center' : '' ?>"><?php echo $shortenedString ?></p>
                                                                    </td>
                                                                    <td class="">
                                                                        <p class="text-xs text-secondary mb-0"><?php echo $row['kategori'] ? $row['kategori'] : '-' ?></p>
                                                                    </td>
                                                                    <td class="text-center text-xs">
                                                                        <?php if ($row['link_dokumen']) { ?>
                                                                            <a href="<?php echo $row['link_dokumen'] ?>" target="_blank" class="text-xs text-primary mb-0">
                                                                                <u><i class="fa fa-file-pdf-o me-1"></i>Lihat Dokumen</u>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <span class="font-weight-bold">-</span>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td class="align-middle text-center text-xs">
                                                                        <?php if ($row['link_foto']) { ?>
                                                                            <a href="<?php echo $row['link_foto'] ?>" target="_blank" class="text-xs text-primary mb-0">
                                                                                <u><i class="fa fa-file-picture-o me-1"></i>Lihat Foto</u>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <span class="font-weight-bold">-</span>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td class="align-middle text-center text-sm">
                                                                        <?php 
                                                                            $namaStatus = $row['status'];
                                                                            $badgeColor = "success";
                                                                            if ($row["status_id"] == 2) {
                                                                                $badgeColor = "warning";
                                                                            } elseif ($row["status_id"] == 4) {
                                                                                $badgeColor = "danger";
                                                                            } elseif ($row["status_id"] == 6) {
                                                                                $badgeColor = "primary";
                                                                            } elseif ($row["status_id"] == 11) {
                                                                                $badgeColor = "info";
                                                                            } 
                                                                        ?>
                                                                        <span class="badge badge-sm bg-gradient-<?php echo $badgeColor; ?>"><?php echo $namaStatus ?></span>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <span class="text-secondary text-xs font-weight-bold">
                                                                            <?php
                                                                                $timestamp = strtotime($row['created_at']);
                                                                                $formattedDate = date('d-M-Y H:m', $timestamp);
                
                                                                                echo $formattedDate;
                                                                            ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="align-middle text-center">
                                                                        <?php if ($row['status_id'] == 3 && $row['lpj_id'] == null) { ?>
                                                                            <a href="tambah-lpj.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                                                                                <!-- <span class="btn-inner--text">Buat Laporan</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if (($row['lpj_id'] == null && $row['status_id'] != 3 && $row['status_id'] != 6 && $row['status_id'] != 11) || $row['status_id'] == 2 || $row['status_id'] == 7 ) { ?>
                                                                            <!-- <a href="review-pengajuan.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-info my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-eye"></i></span>
                                                                                <span class="btn-inner--text">Lihat Pengajuan</span>
                                                                            </a> -->
                                                                            <form method="post">
                                                                                <button type="submit" name="move" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                                                    <span class="btn-inner--icon"><i class="fa fa-eye"></i></span>
                                                                                </button>
                                                                                <?php
                                                                                    $kd_p = $row['kd_proposal'];
                                                                                    if (isset($_POST['move'])) {
                                                                                        $_SESSION['page_before'] = get_current_url();
                                                                                        echo "<meta http-equiv='refresh' content='1;url=review-pengajuan.php?id=" . $kd_p . "'>";
                                                                                    }
                                                                                ?>
                                                                            </form>
                                                                        <?php } ?>
                                                                        <?php if ($row['status_id'] == 6 && $row['lpj_id'] == null) { ?>
                                                                            <a href="edit-proposal.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-warning my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                                                <!-- <span class="btn-inner--text">Edit Proposal</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if ($row['status_id'] == 11) { ?>
                                                                            <a href="proposal-tersimpan.php" class="btn btn-icon px-3 btn-sm btn-warning my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                                                <!-- <span class="btn-inner--text">Edit Proposal</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                        <?php if ($row['status_id'] == 6 && $row['lpj_id']) { ?>
                                                                            <a href="edit-lpj.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                                                <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                                                <!-- <span class="btn-inner--text">Edit LPJ</span> -->
                                                                            </a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <tr>
                                                                <td class="text-center" colspan="7"><div class="h6">Tidak ada pengajuan yang sedang berlangsung</div></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border">
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'includes/footer.php' ?>
            </div>
        </main>

        <!--   Core JS Files   -->
        <script src="./assets/js/core/popper.min.js"></script>
        <script src="./assets/js/core/bootstrap.min.js"></script>
        <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
    </body>
</html>