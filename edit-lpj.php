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
            kg.nama kd_kategori , 
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
        <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=3.0.4" rel="stylesheet" />
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
                                        <div class="col-auto pe-0">
                                            <a href="dashboard.php" class="btn btn-sm border my-auto btn-default me-2 px-3"><i class="fa fa-arrow-left"></i></a>
                                        </div>
                                        <div class="col-10 ps-1 my-auto">
                                            <h6 class="mb-0">Edit LPJ</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-2">
                                    <input type="hidden" name="kd_proposal" value="<?php echo $result['kd_proposal'] ?>" />
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="kode" class="form-control-label">Kode Proposal</label>
                                                <input 
                                                    id="kode"
                                                    name="kode"
                                                    class="form-control" 
                                                    type="text" 
                                                    placeholder="Generate Otomatis" 
                                                    value="<?php echo $result['kd_proposal'] ?>"
                                                    disabled
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="judul" class="form-control-label">Judul Proposal</label>
                                                <input 
                                                    id="judul"
                                                    name="judul"
                                                    class="form-control" 
                                                    type="text" 
                                                    placeholder="Masukkan judul proposal" 
                                                    value="<?php echo $result['judul'] ?>"
                                                    disabled
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="tahun" class="form-control-label">Tahun</label>
                                                <?php
                                                    // Perform database connection
                                                    $conn = connect_to_database();
                                                    // jalankan query
                                                    $stmt = $conn->prepare("SELECT * FROM tbl_tahun_ajar ORDER BY tahun DESC");
                                                    // bind parameter ke query
                                                    $stmt->execute();
                                                    $tahunAjaran = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                ?>
                                                <select name="tahun" id="tahun" class="form-select" required>
                                                    <option value="" disabled selected>-- Pilih tahun ajaran --</option>
                                                    <?php foreach ($tahunAjaran as $row) { ?>
                                                        <option value="<?php echo $row['tahun'] ?>" <?php echo $result['tahun'] == $row['tahun'] ? 'selected' : '' ?>><?php echo $row['tahun'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="semester" class="form-control-label">Semester</label>
                                                <select name="semester" id="semester" class="form-select" required>
                                                    <option value="" disabled selected>-- Pilih semester --</option>
                                                    <option value="ganjil" <?php echo $result['semester'] == 'ganjil' ? 'selected' : '' ?>>Ganjil</option>
                                                    <option value="genap" <?php echo $result['semester'] == 'genap' ? 'selected' : '' ?>>Genap</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="kategori" class="form-control-label">Kategori</label>
                                                <?php
                                                    // Perform database connection
                                                    $conn = connect_to_database();
                                                    // jalankan query
                                                    $stmt = $conn->prepare("
                                                        SELECT kd_kategori, nama FROM tbl_kategori WHERE is_active = 1");
                                                    $stmt->execute();
                                                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                ?>
                                                <select name="kategori" id="kategori" class="form-control" disabled>
                                                    <option value="" disabled>-- Pilih salah satu --</option>
                                                    <?php 
                                                        foreach ($results as $item) {
                                                    ?>
                                                        <option value="<?php echo $item['kd_kategori'] ?>" <?php echo $result['kd_kategori'] == $item['kd_kategori'] ? 'selected' : '' ?>><?php echo $item['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="link_dokumen" class="form-control-label">Link Proposal</label>
                                                <input class="form-control" type="text" id="link_dokumen" name="link_dokumen" value="<?php echo $result['link_dokumen'] ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="link_foto" class="form-control-label">Link Foto <span class="text-danger">*</span></label>
                                                <input class="form-control" type="url" id="link_foto" name="link_foto" value="<?php echo $result['link_foto'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <p class="text-xxs text-muted">(<span class="text-danger"><b>*</b></span>) <b>Mandatori</b> wajib diisi.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border">
                                    <div class="row">
                                        <div class="col-auto mx-auto">
                                            <button name="submit" class="btn btn-sm btn-primary">Edit</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <?php
                                                if (isset($_POST['submit'])) {
                                                    if (empty($_POST['link_foto'])) {
                                                        echo "<div class='alert alert-danger'>Data LPJ gagal terupdate</div>";
                                                        exit;
                                                    }
                                                    // Prepare and execute the query to insert data to tbl_lpj
                                                    $queryUpdateLPJ = "UPDATE tbl_lpj SET link_foto = :link_foto WHERE kd_proposal=:kd_proposal";
                                                    $update = $conn->prepare($queryUpdateLPJ);
                                                    // bind parameter ke query
                                                    $params = array(
                                                        ":link_foto" => $_POST['link_foto'],
                                                        ":kd_proposal" => $_POST['kd_proposal']
                                                    );
                                                    $success = $update->execute($params);
                                                    if ($success) {
                                                        // Prepare and execute the query to insert data to tbl_proses
                                                        $queryInsertProses = "INSERT INTO tbl_proposal_status (kd_proposal, akun_id, status_id) VALUES (:kd_proposal, :kd_user, 9), (:kd_proposal, :kd_user, 2)";
                                                        $insert = $conn->prepare($queryInsertProses);
                                                        // bind parameter ke query
                                                        $params = array(
                                                            ":kd_proposal" => $kd_proposal,
                                                            ":kd_user" => $_SESSION['user']['id']
                                                        );
                                                        $insert->execute($params);
                                                        if ($conn->lastInsertId() > 0) {
                                                            $queryUpdate = "UPDATE tbl_proposal SET status_id = 2 WHERE kd_proposal = :kd_proposal";
                                                            $update = $conn->prepare($queryUpdate);
                                                            $update->bindParam(':kd_proposal', $kd_proposal);

                                                            $success = $update->execute();
                                                            if ($success) {
                                                                echo "<div class='alert alert-success'>Data LPJ berhasil terupdate</div>";
                                                                echo "<meta http-equiv='refresh' content='1;url=dashboard.php'>";
                                                            } else {
                                                                echo "<div class='alert alert-danger'>Data LPJ gagal terupdate</div>";
                                                            }
                                                        } else {
                                                            echo "<div class='alert alert-danger'>Data LPJ gagal terupdate</div>";
                                                        }
                                                    } else {
                                                        echo "<div class='alert alert-danger'>Data LPJ gagal terupdate</div>";
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="card">
                            <div class="card-header border pb-3">
                                <div class="row">
                                    <div class="col"><h6 class="">Status Pengajuan</h6></div>
                                </div>
                            </div>
                            <div class="card-body pb-2 px-2">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'includes/footer.php' ?>
            </div>
            </div>
        </main>

        <!--   Core JS Files   -->
        <script src="./assets/js/core/popper.min.js"></script>
        <script src="./assets/js/core/bootstrap.min.js"></script>
        <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            function onlyNumberKey(evt) {
                
                // Only ASCII character in that range allowed
                var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                    return false;
                return true;
            }
        </script>
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