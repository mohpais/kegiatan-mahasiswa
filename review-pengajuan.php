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
    $kd_proposal = $_GET['id'];
    // Include the functions.php file from the main theme directory
    require_once 'helpers/authorize.php';
    require_once 'helpers/functions.php';
    require_once 'config/database.php';
    // Perform database connection
    $conn = connect_to_database();
    // jalankan query
    $stmt = $conn->prepare("
        SELECT 
            ps.*, 
            lpj.link_foto ,
            kg.nama kategori , 
            sp.nama status 
        FROM 
            tbl_proposal ps 
            JOIN 
                tbl_kategori kg 
                ON
                    kg.kd_kategori = SUBSTRING_INDEX(kd_proposal, '-', 1)
            JOIN 
                tbl_status sp 
                ON
                    sp.id = ps.status_id
            LEFT JOIN
                tbl_lpj lpj
                ON
                    lpj.kd_proposal = ps.kd_proposal
        WHERE
            ps.kd_proposal = :kd_proposal
    ");
    // bind parameter ke query
    $params = array(
        ":kd_proposal" => $kd_proposal
    );
    $stmt->execute($params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=3.0.6" rel="stylesheet" />
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
                <div class="row">
                    <div class="col-md-7 col-sm-12">
                        <form method="POST">
                            <div class="card mb-4">
                                <div class="card-header border pb-3">
                                    <div class="row">
                                        <div class="col-auto pe-0 my-auto">
                                            <?php if ($_SESSION['user']['role'] == "Kaprodi") { ?>
                                                <a href="approval.php" class="btn btn-sm border my-auto btn-default me-2 px-3"><i class="fa fa-arrow-left"></i></a>
                                            <?php } else { ?>
                                                <a href="dashboard.php" class="btn btn-sm border my-auto btn-default me-2 px-3"><i class="fa fa-arrow-left"></i></a>
                                            <?php } ?>
                                        </div>
                                        <div class="col-10 ps-1 my-auto">
                                            <h6 class="mb-0">Review Pengajuan <?php echo $result['status_id'] != 7 ? $result['link_foto'] == null ? 'Proposal' : 'LPJ' : '' ?> - <span class="badge badge-pill bg-gradient-success px-2" style="font-size: 11px"><?php echo $_GET['id'] ?></span></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-4">
                                    <div class="form-group">
                                        <label for="kd_proposal" class="form-control-label">Kode Proposal</label>
                                        <input 
                                            id="judul"
                                            name="judul"
                                            class="form-control" 
                                            type="text" 
                                            value="<?php echo $result['kd_proposal'] ?>" 
                                            disabled
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="judul" class="form-control-label">Judul Proposal</label>
                                        <input 
                                            id="judul"
                                            name="judul"
                                            class="form-control" 
                                            type="text" 
                                            value="<?php echo $result['judul'] ?>" 
                                            disabled
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="judul" class="form-control-label">Tahun Ajar</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="semester" id="semester" class="form-select" disabled>
                                                    <option value="" disabled>-- Pilih salah satu --</option>
                                                    <option value="ganjil" <?php echo $result['semester'] == 'ganjil' ? 'selected' : '' ?>>Ganjil</option>
                                                    <option value="genap" <?php echo $result['semester'] == 'genap' ? 'selected' : '' ?>>Genap</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <input 
                                                    id="tahun"
                                                    name="tahun"
                                                    class="form-control" 
                                                    type="text" 
                                                    value="<?php echo $result['tahun'] ?>" 
                                                    disabled
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $seperateCode = explode("-", $result['kd_proposal']);
                                        $kd_kategori = $seperateCode[0];
                                    ?>
                                    <?php
                                            // Perform database connection
                                            $conn = connect_to_database();
                                            // jalankan query
                                            $stmt = $conn->prepare("
                                                SELECT kd_kategori, nama FROM tbl_kategori WHERE kd_kategori = :kd_kategori");
                                            $params = array(
                                                ":kd_kategori" => $kd_kategori
                                            );
                                            $stmt->execute($params);
                                            $item = $stmt->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                    <div class="form-group">
                                        <label for="kategori" class="form-control-label">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control" disabled>
                                            <option value="" disabled>-- Pilih salah satu --</option>
                                            <option value="<?php echo $item['kd_kategori'] ?>" selected><?php echo $item['nama'] ?></option>
                                        </select>
                                    </div>
                                    <div class="w-100">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-0">
                                                    <label for="link_dokumen" class="form-control-label">Perlengkapan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <a href="<?php echo $result['link_dokumen'] ?>" target="_blank" class="btn btn-primary w-100 btn-sm mb-0">
                                                    <u><i class="fa fa-file-pdf-o me-1"></i>Lihat Dokumen</u>
                                                </a>
                                            </div>
                                            <?php if ($result['link_foto']) { ?>
                                                <div class="col">
                                                    <a href="<?php echo $result['link_foto'] ?>" target="_blank" class="btn btn-primary w-100 btn-sm mb-0">
                                                        <u><i class="fa fa-file-picture-o me-1"></i>Lihat Foto</u>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="link_dokumen" class="form-control-label">Link Proposal</label>
                                        <input class="form-control" type="link_dokumen" id="link_dokumen" name="link_dokumen" value="<?php echo $result['link_dokumen'] ?>" disabled />
                                    </div> -->
                                    <!-- <?php if ($result['link_foto']) { ?> -->
                                        <!-- <div class="form-group">
                                            <label for="link_foto" class="form-control-label">Link Foto</label>
                                            <input class="form-control" type="link_foto" id="link_foto" name="link_foto" value="<?php echo $result['link_foto'] ?>" disabled />
                                        </div> -->
                                    <!-- <?php } ?> -->
                                </div>
                                <div class="card-footer border pt-1">
                                    <?php if ($_SESSION['user']['role'] == "Kaprodi" && $result['status_id'] == 2) { ?>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <?php if ($result['link_foto'] == null) { ?>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#reject-pengajuan">Tolak</button>
                                            <?php } ?>
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#revisi-pengajuan">Revisi</button>
                                            <button name="terima" class="btn btn-sm btn-primary">Terima</button>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php 
                                        if (isset($_POST['terima'])) {
                                            $status_proposal = 7;
                                            $status_proses = 3;
                                            // Prepare and execute the query to insert data to tbl_proses
                                            $query = "INSERT INTO tbl_proposal_status (kd_proposal, akun_id, status_id) VALUES (:kd_proposal, :akun_id, :status_proses)";
                                            $stmt = $conn->prepare($query);
                                            // bind parameter ke query
                                            $params = array(
                                                ":kd_proposal" => $kd_proposal,
                                                ":akun_id" => $_SESSION['user']['id'],
                                                ":status_proses" => $status_proses
                                            );
                                            $stmt->execute($params);
                                            if ($conn->lastInsertId() > 0) {
                                                if ($result['link_foto']) {
                                                    // Prepare and execute the query to insert data to tbl_proses
                                                    $query = "INSERT INTO tbl_proposal_status (kd_proposal, akun_id, status_id) VALUES (:kd_proposal, :akun_id, 7)";
                                                    $stmt = $conn->prepare($query);
                                                    // bind parameter ke query
                                                    $params = array(
                                                        ":kd_proposal" => $kd_proposal,
                                                        ":akun_id" => $_SESSION['user']['id']
                                                    );
                                                    $stmt->execute($params);
                                                }
                                                $query = "UPDATE tbl_proposal_status SET is_shown = 0 WHERE kd_proposal = :kd_proposal AND status_id = 2 AND is_shown = 1";
                                                $stmt = $conn->prepare($query);
                                                // Bind parameters
                                                $stmt->bindParam(':kd_proposal', $kd_proposal);
                                                $success = $stmt->execute();
                                                if ($success) {
                                                    // Prepare and execute the query to update data tbl_proposal based on kd_proposal
                                                    $query = "UPDATE tbl_proposal SET status_id = :status_proposal WHERE kd_proposal = :kd_proposal";
                                                    $stmt = $conn->prepare($query);
                                                    // bind parameter ke query
                                                    $params = array(
                                                        ":status_proposal" => $result['link_foto'] ? $status_proposal : $status_proses,
                                                        ":kd_proposal" => $kd_proposal);
                                                    $stmt->execute($params);
                                                    $isSubmit = false;

                                                    echo "<div class='alert alert-success'>Data berhasil tersimpan</div>";
                                                    echo "<meta http-equiv='refresh' content='1;url=approval.php'>";
                                                } else {
                                                    echo "<div class='alert alert-danger'>Data gagal tersimpan</div>";
                                                }
                                            } else {
                                                echo "<div class='alert alert-danger'>Data gagal tersimpan</div>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="card" style="height: 380px">
                            <div class="card-header border pb-2">
                                <div class="row">
                                    <div class="col"><h6 class="">Status Pengajuan</h6></div>
                                </div>
                            </div>
                            <div class="card-body pb-2 px-2" style="overflow: auto; height: 100%">
                                <div class="container">
                                    <div class="row ps-2 py-2">
                                        <div class="col">
                                            <?php 
                                                $stmt = $conn->prepare("
                                                    SELECT 
                                                        ps.*,
                                                        ak.nama user,
                                                        ak.role,
                                                        st.nama `status`
                                                    FROM 
                                                        tbl_proposal_status ps 
                                                        JOIN (
                                                            SELECT ak.*, rl.nama `role` FROM tbl_akun ak JOIN tbl_role rl ON rl.id = ak.role_id
                                                        ) ak
                                                            ON
                                                                ak.id = ps.akun_id
                                                        JOIN
                                                            tbl_status st
                                                            ON
                                                                st.id = ps.status_id
                                                    WHERE 
                                                        ps.kd_proposal = :kd_proposal AND ps.is_shown = 1
                                                    ORDER BY ps.id DESC
                                                ");
                                                $i = 1;
                                                // bind parameter ke query
                                                $stmt->bindParam(':kd_proposal', $kd_proposal);
                                                $stmt->execute();
                                                $hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($hasil as $row) {
                                            ?>
                                            <div class="row">
                                                <div class="col pb-3 px-1 <?php echo $i != count($hasil) ? 'border-start' : '' ?> <?php echo $i == 1 ? 'border-success' : 'border-primary-200' ?>">
                                                    <div class="position-relative">
                                                        <div class="rounded-circle position-absolute <?php echo $i == 1 ? 'bg-success' : 'bg-primary-200' ?>" style="width: 15px; height: 15px; top: 0px; z-index: 2; left: -12px;"></div>
                                                    </div>
                                                    <div class="ps-3 position-relative text-dark">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-0 text-bold" style="font-size: 14px; margin-top: -5px;"><?php echo $row['role'] ?></p>
                                                            <?php
                                                                $timestamp = strtotime($row['created_at']);
                                                                $formattedDate = date('d-M-Y H:m', $timestamp);
                                                            ?>
                                                            <span class="text-muted my-auto" style="font-size: 11px">
                                                                <!-- <span class="badge bg-info p-1" style="font-size: 10px"><?php echo $result['link_foto'] == null ? 'Proposal' : 'LPJ' ?></span> -  -->
                                                                <span style="font-size: 11px"><?php echo $formattedDate ?></span>
                                                            </span>
                                                        </div>
                                                        <p class="text-muted mb-0" style="font-size: 12px">
                                                            <span class="text-dark text-bold"><?php echo $row['user'] ?></span> - <i><?php echo $row['status'] ?></i>
                                                        </p>
                                                        <?php if ($row['catatan']) { ?>
                                                            <div class="card card-body mt-1 p-2 border-0 shadow-none" style="border-radius: 7px; background-color: #e2e3e5;">
                                                                <p class="mb-0 text-dark text-bold" style="font-size: 10px">Komentar: </p>
                                                                <p class="mb-0 text-dark" style="font-size: 12px"><?php echo $row['catatan'] ?></p>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++ ?>
                                            <?php } ?>
                                            <!-- <div class="row">
                                                <div class="col pb-3">
                                                    <div class="position-relative">
                                                        <div class="rounded-circle position-absolute bg-primary-200" style="width: 15px; height: 15px; top: 0px; z-index: 2; left: -19.9px;"></div>
                                                    </div>
                                                    <div class="ps-3 position-relative text-dark">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-0 text-bold" style="font-size: 14px; margin-top: -2px;">HR</p>
                                                            <span class="text-muted my-auto" style="font-size: 11px">
                                                                <span style="font-size: 11px">21 Jul 2023, 18:41</span>
                                                            </span>
                                                        </div>
                                                        <p class="text-muted text-xs mb-0">
                                                            <span class="text-dark">Arga Nugraha</span> - <i>Pengajuan Selesai</i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border"></div>
                        </div>
                    </div>
                </div>
                <?php include 'includes/footer.php' ?>
            </div>
        </main>
        <!-- Modal Revisi -->
        <div class="modal fade" id="revisi-pengajuan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="revisiPengajuanLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h6 class="modal-title" id="rejectPengajuanLabel">Revisi pengajuan - <span class="badge bg-success"><?php echo $_GET['id'] ?></span></h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <div class="h6">Apakah anda yakin ingin menolak pengajuan <span class="badge bg-success"><?php echo $_GET['id'] ?></span> ?</div> -->
                            <div class="form-group">
                                <label for="catatan" class="form-control-label">Masukkan Alasan</label>
                                <textarea name="catatan" id="catatan" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                            <button name="revisi" class="btn bg-gradient-primary">Simpan</button>
                        </div>
                        <?php 
                            if (isset($_POST['revisi'])) {
                                $query = "INSERT INTO tbl_proposal_status (kd_proposal, akun_id, status_id, catatan) VALUES (:kd_proposal, :akun_id, 5, :catatan), (:kd_proposal, :akun_id, 6, null)";
                                $stmt = $conn->prepare($query);
                                // bind parameter ke query
                                $params = array(
                                    ":kd_proposal" => $kd_proposal,
                                    ":akun_id" => $_SESSION['user']['id'],
                                    ":catatan" => $_POST['catatan']
                                );
                                $stmt->execute($params);
                                if ($conn->lastInsertId() > 0) {
                                    $query = "UPDATE tbl_proposal_status SET is_shown = 0 WHERE kd_proposal = :kd_proposal AND status_id = 2 AND is_shown = 1";
                                    $stmt = $conn->prepare($query);
                                    // Bind parameters
                                    $stmt->bindParam(':kd_proposal', $kd_proposal);
                                    $success = $stmt->execute();
                                    if ($success) {
                                        // Prepare and execute the query to update data tbl_proposal based on kd_proposal
                                        $query = "UPDATE tbl_proposal SET status_id = 6 WHERE kd_proposal = :kd_proposal";
                                        $stmt = $conn->prepare($query);
                                        // Bind parameters
                                        $stmt->bindParam(':kd_proposal', $kd_proposal);
                                        $stmt->execute();
    
                                        echo "<div class='alert alert-success'>Data berhasil tersimpan</div>";
                                        echo "<meta http-equiv='refresh' content='1;url=approval.php'>";
                                    } else {
                                        echo "<div class='alert alert-danger'>Data gagal tersimpan</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Data gagal tersimpan</div>";
                                }
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Reject -->
        <div class="modal fade" id="reject-pengajuan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="rejectPengajuanLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h6 class="modal-title" id="rejectPengajuanLabel">Apakah anda yakin ingin menolak pengajuan <span class="badge bg-success"><?php echo $_GET['id'] ?></span> ?</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <div class="h6">Apakah anda yakin ingin menolak pengajuan <span class="badge bg-success"><?php echo $_GET['id'] ?></span> ?</div> -->
                            <div class="form-group">
                                <label for="catatan" class="form-control-label">Masukkan Alasan</label>
                                <textarea name="catatan" id="catatan" cols="30" rows="3" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                            <button name="tolak" class="btn bg-gradient-primary">Yakin</button>
                        </div>
                        <?php 
                            if (isset($_POST['tolak'])) {
                                if (empty($_POST['catatan'])) {
                                    $_SESSION['add_proposal_error'] = "Mohon untuk memasukan alasan!";
                                    // Redirect back to the add proposal page
                                    echo "<div class='alert alert-danger'>Data gagal tersimpan</div>";
                                    exit;
                                }
                                $query = "INSERT INTO tbl_proposal_status (kd_proposal, akun_id, status_id, catatan) VALUES (:kd_proposal, :akun_id, 4, :catatan)";
                                $stmt = $conn->prepare($query);
                                // bind parameter ke query
                                $params = array(
                                    ":kd_proposal" => $kd_proposal,
                                    ":akun_id" => $_SESSION['user']['id'],
                                    ":catatan" => $_POST['catatan']
                                );
                                $stmt->execute($params);
                                if ($conn->lastInsertId() > 0) {
                                    $query = "UPDATE tbl_proposal_status SET is_shown = 0 WHERE kd_proposal = :kd_proposal AND status_id = 2 AND is_shown = 1";
                                    $stmt = $conn->prepare($query);
                                    // Bind parameters
                                    $stmt->bindParam(':kd_proposal', $kd_proposal);
                                    $success = $stmt->execute();
                                    if ($success) {
                                        // Prepare and execute the query to update data tbl_proposal based on kd_proposal
                                        $query = "UPDATE tbl_proposal SET status_id = 4 WHERE kd_proposal = :kd_proposal";
                                        $stmt = $conn->prepare($query);
                                        // Bind parameters
                                        $stmt->bindParam(':kd_proposal', $kd_proposal);
                                        $stmt->execute();
    
                                        echo "<div class='alert alert-success'>Data berhasil tersimpan</div>";
                                        echo "<meta http-equiv='refresh' content='1;url=approval.php'>";
                                    } else {
                                        echo "<div class='alert alert-danger'>Data gagal tersimpan</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Data gagal tersimpan</div>";
                                }
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>

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