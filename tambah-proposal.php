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
    // if ($_GET['id']) {
    //     $kd_proposal = $_GET['id'];
    // }
    // Include the functions.php file from the main theme directory
    require_once 'helpers/authorize.php';
    require_once 'helpers/functions.php';
    require_once 'config/database.php';
    // Perform database connection
    $conn = connect_to_database();
    // jalankan query
    $stmt = $conn->prepare("SELECT ps.* FROM tbl_proposal ps WHERE ps.status_id = 11 AND ps.created_by = :kd_user");
    // bind parameter ke query
    $stmt->bindParam(':kd_user', $_SESSION['user']['kd_user']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) header('Location: proposal-tersimpan.php');
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
                        <form action="services/add-proposal-service.php" method="POST">
                            <div class="card mb-4">
                                <div class="card-header border pb-3">
                                    <div class="row">
                                        <div class="col-auto pe-0">
                                            <a href="dashboard.php" class="btn btn-sm border my-auto btn-default me-2 px-3"><i class="fa fa-arrow-left"></i></a>
                                        </div>
                                        <div class="col-10 ps-1 my-auto">
                                            <h6 class="mb-0">Tambah proposal baru</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-2">
                                    <div class="row">
                                        <div class="col">
                                            <?php 
                                                if (isset($_SESSION['add_proposal_error'])) {
                                                    $message = $_SESSION['add_proposal_error'];
                                                    echo "<div class='alert alert-danger text-white' role='alert'><strong>Pemberitahuan!</strong> " . $message . "</div>";
                                                    unset($_SESSION['add_proposal_error']);
                                                } 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="judul" class="form-control-label">Judul Proposal <span class="text-danger">*</span></label>
                                                <input 
                                                    id="judul"
                                                    name="judul"
                                                    class="form-control" 
                                                    type="text" 
                                                    placeholder="Masukkan judul proposal" 
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="tahun" class="form-control-label">Tahun Ajaran<span class="text-danger">*</span></label>
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
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['tahun'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="semester" class="form-control-label">Semester <span class="text-danger">*</span></label>
                                                <select name="semester" id="semester" class="form-select" required>
                                                    <option value="" disabled selected>-- Pilih semester --</option>
                                                    <option value="ganjil">Ganjil</option>
                                                    <option value="genap">Genap</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="kategori" class="form-control-label">Kategori <span class="text-danger">*</span></label>
                                                <?php
                                                    // Perform database connection
                                                    $conn = connect_to_database();
                                                    // jalankan query
                                                    $stmt = $conn->prepare("
                                                        SELECT kd_kategori, nama FROM tbl_kategori WHERE is_active = 1");
                                                    $stmt->execute();
                                                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                ?>
                                                <select name="kategori" id="kategori" class="form-control" required>
                                                    <option value="" disabled selected>-- Pilih kategori --</option>
                                                    <?php 
                                                        foreach ($results as $item) {
                                                    ?>
                                                        <option value="<?php echo $item['kd_kategori'] ?>"><?php echo $item['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="url" class="form-control-label">Link Proposal <span class="text-danger">*</span></label>
                                                <input class="form-control" type="url" id="url" name="url" required />
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
                                            <button type="submit" name="save" class="btn btn-sm btn-default">Simpan</button>
                                            <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
                                        </div>
                                    </div>
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