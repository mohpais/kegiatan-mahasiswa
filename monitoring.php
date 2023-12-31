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
                <div class="row">
                    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">User Aktif</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                <?php 
                                                    $query = "SELECT COUNT(*) As JumlahUser FROM tbl_akun WHERE kd_user != :kd_user";
                                                    // jalankan query
                                                    $stmt = $conn->prepare($query);
                                                    // bind parameter ke query
                                                    $stmt->bindParam(':kd_user', $_SESSION['user']['kd_user']);
                                                    $stmt->execute();
                                                    $hasil = $stmt->fetch(PDO::FETCH_ASSOC);
                                                    echo $hasil['JumlahUser'];
                                                ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                            <i class="fa fa-user text-lg opacity-10" aria-hidden="true" style="top: 12px"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Kategori</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?php 
                                            $query = "SELECT COUNT(*) As JumlahKategori FROM tbl_kategori";
                                            // jalankan query
                                            $stmt = $conn->prepare($query);
                                            // bind parameter ke query
                                            $stmt->execute();
                                            $hasil = $stmt->fetch(PDO::FETCH_ASSOC);
                                            echo $hasil['JumlahKategori'];
                                        ?>
                                    </h5>
                                </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Status Pengajuan</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php 
                                                $query = "SELECT COUNT(*) As JumlahStatus FROM tbl_status";
                                                // jalankan query
                                                $stmt = $conn->prepare($query);
                                                // bind parameter ke query
                                                $stmt->execute();
                                                $hasil = $stmt->fetch(PDO::FETCH_ASSOC);
                                                echo $hasil['JumlahStatus'];
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-7 mb-lg-0 mb-4">
                        <div class="card z-index-2 h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-2">Akun Website</h6>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table align-items-center ">
                                        <tbody>
                                            <?php 
                                                $query = "SELECT a.*, r.nama rolename FROM tbl_akun a JOIN tbl_role r ON r.id = a.role_id WHERE kd_user != :kd_user";
                                                // jalankan query
                                                $stmt = $conn->prepare($query);
                                                // bind parameter ke query
                                                $stmt->bindParam(':kd_user', $_SESSION['user']['kd_user']);
                                                $stmt->execute();
                                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <?php
                                                foreach ($results as $row) {
                                            ?>
                                                <tr>
                                                    <td class="w-20">
                                                        <div class="d-flex px-2 py-1 align-items-center">
                                                            <div>
                                                                <img width="30" src="./assets/img/photo-profile-baru.png" alt="...">
                                                            </div>
                                                            <div class="ms-2">
                                                                <p class="text-xs font-weight-bold mb-0">Nama:</p>
                                                                <span class="text-xs mb-0"><?php echo $row['nama'] ?></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="">
                                                            <p class="text-xs font-weight-bold mb-0">Email:</p>
                                                            <span class="text-xs mb-0"><?php echo $row['email'] ? $row['email'] : '-' ?></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="">
                                                            <p class="text-xs font-weight-bold mb-0">Role:</p>
                                                            <span class="text-xs mb-0"><?php echo $row['rolename'] ?></span>
                                                        </div>
                                                    </td>
                                                    <!-- <td class="align-middle text-sm">
                                                        <div class="d-flex">
                                                            <a href="" class="btn btn-link text-warning my-auto px-2"><i class="fa fa-pencil"></i></a>
                                                            <a href="" class="btn btn-link text-danger my-auto px-2"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </td> -->
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-carousel overflow-hidden h-100 p-0">
                            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                                <div class="carousel-inner border-radius-lg h-100">
                                    <div 
                                        class="carousel-item h-100 active" style="background-image: url('./assets/img/galeri-bk.jpg'); background-size: cover;">
                                        <div class="position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 10; background-color: #333; opacity: .5"></div>
                                        <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5" style="z-index: 11">
                                            <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                            </div>
                                            <h5 class="text-white mb-1">Bergabung bersama kami</h5>
                                            <p>Menerapkan tata kelola universitas dengan standar mutu guna peningkatan adaptasi terhadap dinamika kemajuan iptek.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item h-100" style="background-image: url('./assets/img/galeri-bk2.jpg'); background-size: cover;">
                                        <div class="position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 10; background-color: #333; opacity: .5"></div>
                                        <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5" style="z-index: 11">
                                            <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                            </div>
                                            <h5 class="text-white mb-1">Thinking </h5>
                                            <p>Menyiapkan Universitas berbasis digital dalam menunjang atmosfir akademik dengan melalui pengabdian kepada masyarakat.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item h-100" style="background-image: url('./assets/img/galeri-bk3.jpg'); background-size: cover;">
                                        <div class="position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 10; background-color: #333; opacity: .5"></div>
                                        <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5" style="z-index: 11">
                                            <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                <i class="ni ni-trophy text-dark opacity-10"></i>
                                            </div>
                                            <h5 class="text-white mb-1">Cita-cita!</h5>
                                            <p>Menghasilkan lulusan yang berkualifikasi nasional / mandiri sesuai dengan kebutuhan masyarakat.</p>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row mt-4">
                    <div class="col-lg-7 mb-lg-0 mb-4">
                        <div class="card ">
                            <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Mata Kuliah</h6>
                            </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table align-items-center ">
                                <tbody>
                                <tr>
                                    <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                        <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                                        </div>
                                        <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                                        <h6 class="text-sm mb-0">United States</h6>
                                        </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                        <h6 class="text-sm mb-0">2500</h6>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Value:</p>
                                        <h6 class="text-sm mb-0">$230,900</h6>
                                    </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                        <h6 class="text-sm mb-0">29.9%</h6>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                        <img src="./assets/img/icons/flags/DE.png" alt="Country flag">
                                        </div>
                                        <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                                        <h6 class="text-sm mb-0">Germany</h6>
                                        </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                        <h6 class="text-sm mb-0">3.900</h6>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Value:</p>
                                        <h6 class="text-sm mb-0">$440,000</h6>
                                    </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                        <h6 class="text-sm mb-0">40.22%</h6>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                        <img src="./assets/img/icons/flags/GB.png" alt="Country flag">
                                        </div>
                                        <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                                        <h6 class="text-sm mb-0">Great Britain</h6>
                                        </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                        <h6 class="text-sm mb-0">1.400</h6>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Value:</p>
                                        <h6 class="text-sm mb-0">$190,700</h6>
                                    </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                        <h6 class="text-sm mb-0">23.44%</h6>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                        <img src="./assets/img/icons/flags/BR.png" alt="Country flag">
                                        </div>
                                        <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                                        <h6 class="text-sm mb-0">Brasil</h6>
                                        </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                        <h6 class="text-sm mb-0">562</h6>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Value:</p>
                                        <h6 class="text-sm mb-0">$143,960</h6>
                                    </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                        <h6 class="text-sm mb-0">32.14%</h6>
                                    </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Categories</h6>
                            </div>
                            <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <i class="ni ni-mobile-button text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Devices</h6>
                                    <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <i class="ni ni-tag text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                                    <span class="text-xs">123 closed, <span class="font-weight-bold">15 open</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <i class="ni ni-box-2 text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                                    <span class="text-xs">1 is active, <span class="font-weight-bold">40 closed</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                    <i class="ni ni-satisfied text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                                    <span class="text-xs font-weight-bold">+ 430</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                <?php include 'includes/footer.php' ?>
            </div>
        </main>

        <!--   Core JS Files   -->
        <script src="./assets/js/core/popper.min.js"></script>
        <script src="./assets/js/core/bootstrap.min.js"></script>
        <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="./assets/js/plugins/chartjs.min.js"></script>
        <script>
            var ctx1 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
            gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
            new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                legend: {
                    display: false,
                }
                },
                interaction: {
                intersect: false,
                mode: 'index',
                },
                scales: {
                y: {
                    grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                    },
                    ticks: {
                    display: true,
                    padding: 10,
                    color: '#fbfbfb',
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                    }
                },
                x: {
                    grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                    },
                    ticks: {
                    display: true,
                    color: '#ccc',
                    padding: 20,
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                    }
                },
                },
            },
            });
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