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
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header border pb-3">
                                <div class="row">
                                    <div class="col-xl-10 col-12 my-auto">
                                        <h6 class="mb-1">Master Kategori</h6>
                                        <p class="text-xs mb-0 text-secondary font-weight-bold">Datfar kategori untuk pengajuan.</p>
                                    </div>
                                    <div class="col-xl-auto my-auto ms-auto">
                                        <a class="btn btn-icon px-3 btn-sm btn-success my-auto" href="tambah-kategori.php">
                                            <span class="btn-inner--icon"><i class="fa fa-plus me-1"></i>Buat Kategori Baru</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <?php 
                                    if (isset($_SESSION['add_kategori_success'])) {
                                        $message = $_SESSION['add_kategori_success'];
                                        echo "<div class='alert alert-success mx-4 my-2' role='alert'>" . $message . "</div>";
                                        unset($_SESSION['add_kategori_success']);
                                    }
                                    if (isset($_SESSION['edit_kategori_success'])) {
                                        $message = $_SESSION['edit_kategori_success'];
                                        echo "<div class='alert alert-success mx-4 my-2' role='alert'>" . $message . "</div>";
                                        unset($_SESSION['edit_kategori_success']);
                                    }
                                    if (isset($_SESSION['delete_kategori_success'])) {
                                        $message = $_SESSION['delete_kategori_success'];
                                        echo "<div class='alert alert-success mx-4 my-2' role='alert'>" . $message . "</div>";
                                        unset($_SESSION['delete_kategori_success']);
                                    }
                                ?>
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th width="15" class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-5">Kode</th>
                                                <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-8">Nama</th>
                                                <th width="30" class="text-secondary opacity-8"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // Perform database connection
                                                $conn = connect_to_database();
                                                // jalankan query
                                                $stmt = $conn->prepare("SELECT * FROM tbl_kategori WHERE is_active = 1");
                                                $stmt->execute();
                                                $hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                
                                            ?>
                                            <?php if (count($hasil) > 0) {?>
                                                <?php foreach ($hasil as $row) { ?>
                                                    <tr>
                                                        <td class="text-center text-xs"><?php echo $row['kd_kategori']; ?></td>
                                                        <td class="text-xs font-weight-bold"><?php echo $row['nama']; ?></td>
                                                        <td class="align-middle text-center">
                                                            <a href="edit-kategori.php?id=<?php echo $row['kd_kategori'] ?>" class="btn btn-icon px-3 btn-sm btn-warning my-auto" type="button">
                                                                <span class="btn-inner--icon me-1"><i class="fa fa-pencil"></i></span>
                                                                <span class="btn-inner--text">Edit</span>
                                                            </a>
                                                            <a href="hapus-kategori.php?id=<?php echo $row['kd_kategori'] ?>" class="btn btn-icon px-3 btn-sm btn-danger my-auto" type="button">
                                                                <span class="btn-inner--icon me-1"><i class="fa fa-trash"></i></span>
                                                                <span class="btn-inner--text">Hapus</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td class="text-center" colspan="3"><div class="h6">Tidak ada kategori</div></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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