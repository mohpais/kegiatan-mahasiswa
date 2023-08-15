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
                    <div class="col-12">
                        <form method="POST">
                            <div class="card mb-4">
                                <div class="card-header border pb-3">
                                    <div class="row">
                                        <div class="col-auto pe-0">
                                            <a href="index.php" class="btn btn-sm border my-auto btn-default me-2 px-3"><i class="fa fa-arrow-left"></i></a>
                                        </div>
                                        <div class="col-10 ps-1 my-auto">
                                            <h6 class="mb-0">Review Proposal</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-2">
                                    <!-- <?php 
                                        if (isset($_SESSION['add_proposal_error'])) {
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Pemberitahuan!</strong> <?php echo $_SESSION['add_proposal_error'] ?>
                                        </div>
                                    <?php } ?>
                                    <?php 
                                        if (isset($_SESSION['add_proposal_success'])) {
                                    ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo $_SESSION['add_proposal_success'] ?>
                                        </div>
                                    <?php } ?> -->
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
                                    <div class="form-group">
                                        <label for="link_dokumen" class="form-control-label">Link Dokumen</label>
                                        <input class="form-control" type="link_dokumen" id="link_dokumen" name="link_dokumen" value="<?php echo $result['link_dokumen'] ?>" disabled />
                                    </div>
                                    <div class="form-group">
                                        <label for="url" class="form-control-label">Link Foto</label>
                                        <input class="form-control" type="url" id="url" name="url" placeholder="Masukkan link foto ..." required />
                                    </div>
                                </div>
                                <div class="card-footer border">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button name="submit" class="btn btn-sm btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    <?php
                                        if (isset($_POST['submit'])) {
                                            // Prepare and execute the query to insert data to tbl_lpj
                                            $queryInsertLPJ = "INSERT INTO tbl_lpj (kd_proposal, link_foto, created_by) VALUES (:kd_proposal, :link_foto, :kd_user)";
                                            $insert = $conn->prepare($queryInsertLPJ);
                                            // bind parameter ke query
                                            $params = array(
                                                ":kd_proposal" => $kd_proposal,
                                                ":link_foto" => $_POST['url'],
                                                ":kd_user" => $_SESSION['user']['kd_user']
                                            );
                                            $insert->execute($params);
                                            if ($conn->lastInsertId() > 0) {
                                                // Prepare and execute the query to insert data to tbl_proses
                                                $queryInsertProses = "INSERT INTO tbl_proposal_status (kd_proposal, akun_id, status_id) VALUES (:kd_proposal, :kd_user, 10), (:kd_proposal, :kd_user, 2)";
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
                                                        echo "<div class='alert alert-success'>Data LPJ berhasil tersimpan</div>";
                                                        echo "<meta http-equiv='refresh' content='1;url=dashboard.php'>";
                                                    } else {
                                                        echo "<div class='alert alert-danger'>Data LPJ gagal tersimpan</div>";
                                                    }
                                                } else {
                                                    echo "<div class='alert alert-danger'>Data LPJ gagal tersimpan</div>";
                                                }
                                            } else {
                                                echo "<div class='alert alert-danger'>Data LPJ gagal tersimpan</div>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </form>
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