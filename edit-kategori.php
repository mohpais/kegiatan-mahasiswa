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
    $id = $_GET['id'];
    // Include the functions.php file from the main theme directory
    require_once 'helpers/authorize.php';
    require_once 'helpers/functions.php';
    require_once 'config/database.php';
    // Perform database connection
    $conn = connect_to_database();
    // jalankan query
    $stmt = $conn->prepare("SELECT * FROM tbl_kategori WHERE id = :id");
    // bind parameter ke query
    $stmt->bindParam(':id', $id);
    $stmt->execute();
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
                <div class="row mt-4">
                    <div class="col-12">
                        <form method="POST">
                            <div class="card mb-4">
                                <div class="card-header border pb-3">
                                    <div class="row">
                                        <div class="col-auto pe-0">
                                            <a href="master-kategori.php" class="btn btn-sm border my-auto btn-default me-2 px-3"><i class="fa fa-arrow-left"></i></a>
                                        </div>
                                        <div class="col-10 ps-1 my-auto">
                                            <h6 class="mb-0">Edit Kategori</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-2">
                                    <div class="row">
                                        <div class="col">
                                            <?php 
                                                if (isset($_SESSION['edit_kategori_error'])) {
                                                    $message = $_SESSION['edit_kategori_error'];
                                                    echo "<div class='alert alert-danger text-white' role='alert'><strong>Pemberitahuan!</strong> " . $message . "</div>";
                                                    unset($_SESSION['edit_kategori_error']);
                                                } 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="judul" class="form-control-label">Kode <span class="text-danger">*</span></label>
                                                <input 
                                                    id="kd_kategori"
                                                    name="kd_kategori"
                                                    class="form-control" 
                                                    type="text" 
                                                    minlength="2"
                                                    onkeypress="return onlyNumberKey(event)"
                                                    placeholder="Masukkan kode kategori ..."
                                                    value="<?php echo $result['kd_kategori'] ?>"
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="judul" class="form-control-label">Nama <span class="text-danger">*</span></label>
                                                <input 
                                                    id="nama"
                                                    name="nama"
                                                    class="form-control" 
                                                    type="text" 
                                                    placeholder="Masukkan nama kategori ..."
                                                    value="<?php echo $result['nama'] ?>"
                                                    required
                                                />
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
                                        <div class="col-12 text-center">
                                            <button name="update" class="btn btn-sm btn-primary">Edit</button>
                                        </div>
                                    </div>
                                    <?php
                                        if (isset($_POST['update'])) {
                                            if (empty($_POST['nama'])) {
                                                $_SESSION['edit_kategori_error'] = "Mohon untuk lengkapi data!";
                                                echo "<meta http-equiv='refresh' content='1;url=tambah-kategori.php'>";
                                                exit;
                                            }
                                            // Prepare and execute the query to insert data to tbl_proses
                                            $query = "UPDATE tbl_kategori SET kd_kategori=:kd_kategori, nama=:nama WHERE kd_kategori=:id";
                                            $stmt = $conn->prepare($query);
                                            // bind parameter ke query
                                            $params = array(
                                                ":kd_kategori" => $_POST['kd_kategori'],
                                                ":nama" => $_POST['nama'],
                                                ":id" => $id
                                            );
                                            $success = $stmt->execute($params);
                                            if ($success) {
                                                $_SESSION['edit_kategori_success'] = "Data master kategori berhasil tersimpan!";
                                                echo "<meta http-equiv='refresh' content='1;url=master-kategori.php'>";
                                            } else {
                                                $_SESSION['edit_kategori_error'] = "Data master kategori gagal tersimpan!";
                                                echo "<meta http-equiv='refresh' content='1;url=edit-kategori.php?id=" . $id . "'>";
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