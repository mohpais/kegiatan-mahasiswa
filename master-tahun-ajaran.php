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
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header border pb-3">
                            <div class="row">
                                <div class="col-auto my-auto">
                                    <h6 class="mb-0">Tahun Ajaran Akademik</h6>
                                    <p class="text-xs mb-0 text-secondary font-weight-bold">Datfar tahun ajaran akademik.</p>
                                </div>
                                <div class="col-md-auto my-auto ms-auto d-md-block d-none">
                                    <a class="btn btn-icon px-3 btn-sm btn-success my-auto" href="tambah-tahun-ajaran.php">
                                        <span class="btn-inner--icon"><i class="fa fa-plus me-1"></i>Buat Tahun Ajaran</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th width="10" class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-5">#</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Tahun Ajaran</th>
                                            <th width="20" class="text-secondary opacity-8"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            // Perform database connection
                                            $conn = connect_to_database();
                                            // jalankan query
                                            $stmt = $conn->prepare("SELECT * FROM tbl_tahun_ajar ORDER BY tahun DESC");
                                            // bind parameter ke query
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                        <?php if (count($results) > 0) {?>
                                            <?php foreach ($results as $row) { ?>
                                                <tr>
                                                    <td class="text-center text-xs font-weight-bold"><?php echo $no; ?></td>
                                                    <td class="ps-4 text-xs font-weight-bold"><?php echo $row['tahun']; ?></td>
                                                    <td class="align-middle text-center">
                                                        <a href="edit-status.php?id=<?php echo $row['id'] ?>" class="btn btn-icon px-3 btn-sm btn-warning my-auto" type="button">
                                                            <span class="btn-inner--icon me-1"><i class="fa fa-pencil"></i></span>
                                                            <span class="btn-inner--text">Edit</span>
                                                        </a>
                                                        <a href="tambah-lpj.php?id=<?php echo $row['id'] ?>" class="btn btn-icon px-3 btn-sm btn-danger my-auto" type="button">
                                                            <span class="btn-inner--icon me-1"><i class="fa fa-trash"></i></span>
                                                            <span class="btn-inner--text">Hapus</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $no++; ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td class="text-center" colspan="3"><div class="h6">Tidak ada tahun ajaran</div></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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