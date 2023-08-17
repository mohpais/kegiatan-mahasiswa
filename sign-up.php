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
    // Start the session
    session_start();

    // Check if the user is already logged in, redirect to the dashboard
    if (isset($_SESSION['user'])) {
        header('Location: dashboard.php');
        exit;
    } else {
        session_destroy();
    }
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
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 col-md-8 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Daftar</h4>
                                    <p class="mb-0">Daftar terlebih dahulu untuk mendapatkan akses ke web ini.</p>
                                </div>
                                <div class="card-body">
                                    <?php 
                                        if (isset($_SESSION['registration_error'])) {
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Danger!</strong> <?php echo $_SESSION['registration_error'] ?>
                                        </div>
                                    <?php } ?>
                                    <form method="POST" action="services/register-service.php">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Kode Mahasiswa" aria-label="kd_user" name="kd_user">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Masukkan nama" aria-label="nama" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Kata sandi" aria-label="Password" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Ulangi kata sandi" aria-label="Password" name="repassword">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-ubk btn-lg w-100 mt-4 mb-0">Daftar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Sudah punya akun?
                                        <a href="sign-in.php" class="text-primary text-gradient font-weight-bold">Login disini!</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-ubk h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://portal.ubk.ac.id/siakad/logo_backg1.jpg');
                        background-position: center; background-repeat: no-repeat; background-size: cover;">
                                <span class="mask bg-gradient-ubk opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
</body>

</html>