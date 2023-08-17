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
    // Perform database connection
    $conn = connect_to_database();
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
                <div class="row mt-4">
                    <div class="col-12">
                        <form method="POST">
                            <div class="card mb-4">
                                <div class="card-header border pb-3">
                                    <div class="row">
                                        <div class="col-auto pe-0">
                                            <a href="master-tahun-ajaran.php" class="btn btn-sm border my-auto btn-default me-2 px-3"><i class="fa fa-arrow-left"></i></a>
                                        </div>
                                        <div class="col-10 ps-1 my-auto">
                                            <h6 class="mb-0">Tambah Tahun Ajaran</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-2">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="tahun_awal" class="form-control-label">Tahun Awal</label>
                                                <input 
                                                    id="tahun_awal"
                                                    name="tahun_awal"
                                                    minlength="4"
                                                    maxlength="4"
                                                    onkeypress="return onlyNumberKey(event)"
                                                    class="form-control" 
                                                    type="text" 
                                                    placeholder="Masukkan tahun ajaran awal ..."
                                                    required
                                                />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="tahun_akhir" class="form-control-label">Tahun Akhir</label>
                                                <input 
                                                    id="tahun_akhir"
                                                    name="tahun_akhir"
                                                    minlength="4"
                                                    maxlength="4"
                                                    onkeypress="return onlyNumberKey(event)"
                                                    class="form-control" 
                                                    type="text" 
                                                    placeholder="Masukkan tahun ajaran akhir ..."
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button name="save" class="btn btn-sm btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                    <?php
                                        if (isset($_POST['save'])) {
                                            if (empty($_POST['tahun_awal']) || empty($_POST['tahun_akhir'])) {
                                                echo "<div class='alert alert-danger'>Lengkapi data tahun</div>";
                                            } else {
                                                $tahun = $_POST['tahun_awal'] . '/' . $_POST['tahun_akhir'];
                                                // Prepare and execute the query to insert data to tbl_proses
                                                $query = "INSERT INTO tbl_tahun_ajar (tahun) VALUES (:tahun)";
                                                $stmt = $conn->prepare($query);
                                                // bind parameter ke query
                                                $stmt->bindParam(':tahun', $tahun);
                                                $stmt->execute();
                                                if ($conn->lastInsertId() > 0) {
    
                                                    echo "<div class='alert alert-success text-white'>Tahun ajaran berhasil tersimpan</div>";
                                                    echo "<meta http-equiv='refresh' content='1;url=master-tahun-ajaran.php'>";
                                                } else {
                                                    echo "<div class='alert alert-danger'>Tahun ajaran gagal tersimpan</div>";
                                                }
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