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
    $query = "
        SELECT 
            ps.*, 
            lpj.id lpj_id ,
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
            status_id IN (4, 7) 
    ";

    $dataFilters = [];
    $id = "";
    $kategori = "";
    $tahun = "";
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        array_push($dataFilters, (object)['kd_proposal' => $id]);
    }
    if (!empty($_GET['kategori'])) {
        $kategori = $_GET['kategori'];
        array_push($dataFilters, (object)['kd_kategori' => $kategori]);
    }
    if (!empty($_GET['tahun'])) {
        $tahun = $_GET['tahun'];
        array_push($dataFilters, (object)['tahun' => $tahun]);
    }

    if (count($dataFilters) > 0) {
        $filter = " AND ";
        foreach ($dataFilters as $index => $object) {
            foreach($object as $keyOfObject=>$valueOfObject) {
                $filter = $filter . "ps." . $keyOfObject . "='" . $valueOfObject . "'";
            }
            if ($index < count($dataFilters) - 1) $filter = $filter . ' AND ';
        }
        $query = $query . $filter;
    }
    $query = $query . " ORDER BY ps.created_at DESC";
    // Perform database connection
    $conn = connect_to_database();
    // jalankan query
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pengajuan Selesai</p>
                                            <?php
                                                $condition = function($x) {
                                                    return $x['status_id'] == 7;
                                                };
                                            ?>
                                            <h5 class="font-weight-bolder"><?php echo count(array_filter($results, $condition)) ?></h5>
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
                    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pengajuan Ditolak</p>
                                            <?php
                                                $condition = function($x) {
                                                    return $x['status_id'] == 4;
                                                };
                                            ?>
                                            <h5 class="font-weight-bolder"><?php echo count(array_filter($results, $condition)) ?></h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                            <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header border pb-0">
                                <div class="row">
                                    <div class="col-auto my-auto">
                                        <h6 class="mb-0">Daftar Pengajuan</h6>
                                        <p class="text-xs mb-0 text-secondary font-weight-bold">Pengajuan yang telah diajukan oleh Mahasiswa per tahun.</p>
                                    </div>
                                </div>
                                <form method="post">
                                    <div class="row mt-2 border-top pt-3">
                                        <div class="col">
                                            <input id="kd_proposal" name="kd_proposal" type="text" class="form-control" placeholder="Masukkan kode" value="<?php echo $id; ?>" />
                                        </div>
                                        <div class="col">
                                            <?php
                                                // Perform database connection
                                                $conn = connect_to_database();
                                                // jalankan query
                                                $stmt = $conn->prepare("
                                                    SELECT kd_kategori, nama FROM tbl_kategori WHERE is_active = 1");
                                                $stmt->execute();
                                                $hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <select name="kd_kategori" id="kd_kategori" class="form-control">
                                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                                <?php 
                                                    foreach ($hasil as $item) {
                                                ?>
                                                    <option value="<?php echo $item['kd_kategori'] ?>" <?php echo $kategori == $item['kd_kategori'] ? 'selected' : '' ?>><?php echo $item['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <input name="tahun" type="text" class="form-control" placeholder="Masukkan tahun" value="<?php echo $tahun; ?>"
                                                        onkeypress="return onlyNumberKey(event)" maxlength="4" minlength="4"  />
                                        </div>
                                        <div class="col-auto">
                                            <?php if (!empty($id) ||!empty($kategori) || !empty($tahun)) { ?>
                                                <a href="laporan.php" type="button" class="btn btn-success">Reset</a>
                                            <?php } else { ?>
                                                <button name="search" class="btn btn-success">Cari data</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php 
                                        if (isset($_POST['search'])) {
                                            $dataFilters = [];
                                            if (!empty($_POST['kd_proposal'])) {
                                                array_push($dataFilters, (object)['id' => $_POST['kd_proposal']]);
                                            }
                                            if (!empty($_POST['kd_kategori'])) {
                                                array_push($dataFilters, (object)['kategori' => $_POST['kd_kategori']]);
                                            }
                                            if (!empty($_POST['tahun'])) {
                                                array_push($dataFilters, (object)['tahun' => $_POST['tahun']]);
                                            }

                                            if (count($dataFilters) > 0) {
                                                $filter = "";
                                                foreach ($dataFilters as $index => $object) {
                                                    foreach($object as $keyOfObject=>$valueOfObject) {
                                                        $filter = $filter . $keyOfObject . '=' . $valueOfObject;
                                                    }
                                                    if ($index < count($dataFilters) - 1) $filter = $filter . '&';
                                                }
                                                echo "<meta http-equiv='refresh' content='1;url=laporan.php?" . $filter . "'>";
                                                // header('Location: edit-proposal.php?' . $filter);
                                            }
                                        }
                                    ?>
                                </form>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <!-- <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-5">#</th> -->
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Kode Proposal</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8 ps-2">Kategori</th>
                                                <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-8">Judul</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8 ps-2">Link Proposal</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-8 ps-2">Link LPJ</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-8">Status Proposal</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-8 ps-2">Proposal diajukan pada</th>
                                                <th class="text-secondary opacity-8"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                
                                            ?>
                                            <?php if (count($results) > 0) {?>
                                            <?php foreach ($results as $row) { ?>
                                            <tr>
                                                <!-- <td class="text-center text-xs"><?php echo $no; ?></td> -->
                                                <td class="text-center text-xs"><?php echo $row['kd_proposal']; ?></td>
                                                <td class="">
                                                    <?php 
                                                        $originalString = $row['judul']; // Replace with your actual string

                                                        if (strlen($originalString) > 40) {
                                                            $shortenedString = substr($originalString, 0, 40) . '...';
                                                        } else {
                                                            $shortenedString = $originalString;
                                                        }
                                                    ?>
                                                    <p class="text-xs font-weight-bold mb-0"><?php echo $shortenedString ?></p>
                                                </td>
                                                <td class="">
                                                    <p class="text-xs text-secondary mb-0"><?php echo $row['kategori'] ?></p>
                                                </td>
                                                <td class="text-center text-xs">
                                                    <a href="<?php echo $row['link_dokumen'] ?>" target="_blank" class="text-xs text-primary mb-0">
                                                        <u><i class="fa fa-file-pdf-o me-1"></i>Lihat Dokumen</u>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-xs">
                                                    <?php if ($row['link_foto']) { ?>
                                                        <a href="<?php echo $row['link_foto'] ?>" target="_blank" class="text-xs text-primary mb-0">
                                                            <u><i class="fa fa-file-picture-o me-1"></i>Lihat Foto</u>
                                                        </a>
                                                    <?php } else { ?>
                                                        <span class="badge bg-secondary">Belum ada data LPJ</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <?php 
                                                        $namaStatus = $row['status'];
                                                        $badgeColor = "success";
                                                        if ($row["status_id"] == 2) {
                                                            $badgeColor = "warning";
                                                        } elseif ($row["status_id"] == 4) {
                                                            $badgeColor = "danger";
                                                        } elseif ($row["status_id"] == 6) {
                                                            $badgeColor = "primary";
                                                        } 
                                                    ?>
                                                    <span class="badge badge-sm bg-gradient-<?php echo $badgeColor; ?>"><?php echo $namaStatus ?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        <?php
                                                            $timestamp = strtotime($row['created_at']);
                                                            $formattedDate = date('d-M-Y H:m', $timestamp);

                                                            echo $formattedDate;
                                                        ?>
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <?php if ($row['status_id'] == 3 && $row['lpj_id'] == null) { ?>
                                                        <a href="tambah-lpj.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                            <span class="btn-inner--icon me-1"><i class="fa fa-plus"></i></span>
                                                            <span class="btn-inner--text">Buat Laporan</span>
                                                        </a>
                                                    <?php } ?>
                                                    <?php if ($row['status_id'] != 3 || $row['lpj_id'] ) { ?>
                                                        <a href="review-pengajuan.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-info my-auto" type="button">
                                                            <span class="btn-inner--icon me-1"><i class="fa fa-eye"></i></span>
                                                            <!-- <span class="btn-inner--text">Lihat <?php echo $row['lpj_id'] ? 'LPJ' : 'Proposal' ?></span> -->
                                                            <span class="btn-inner--text">Lihat Pengajuan</span>
                                                        </a>
                                                    <?php } ?>
                                                    <?php if ($row['status_id'] == 6 && $row['lpj_id'] == null) { ?>
                                                        <a href="edit-proposal.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                            <span class="btn-inner--icon me-1"><i class="fa fa-pencil"></i></span>
                                                            <span class="btn-inner--text">Edit Proposal</span>
                                                        </a>
                                                    <?php } ?>
                                                    <?php if ($row['status_id'] == 6 && $row['lpj_id']) { ?>
                                                        <a href="edit-lpj.php?id=<?php echo $row['kd_proposal'] ?>" class="btn btn-icon px-3 btn-sm btn-primary my-auto" type="button">
                                                            <span class="btn-inner--icon me-1"><i class="fa fa-pencil"></i></span>
                                                            <span class="btn-inner--text">Edit LPJ</span>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <tr>
                                                <td class="text-center" colspan="8"><div class="h6">Tidak ada pengajuan</div></td>
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