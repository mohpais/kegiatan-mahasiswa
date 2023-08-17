<aside class="sidenav shadow-lg bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main" data-color="ubk">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-2 m-0 text-center" href="https://www.ubk.ac.id/index.html" target="_blank">
            <img src="./assets/img/logo-ubk-2.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Universitas Bung Karno</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <?php if ($_SESSION['user']['role'] == "Mahasiswa") { ?>
                <li class="nav-item">
                    <a class="nav-link px-2 <?php echo get_current_url() == 'dashboard' ? 'active' : '' ?>" href="dashboard.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <?php } ?>
            <?php if ($_SESSION['user']['role'] == "Kaprodi") { ?>
            <li class="nav-item">
                <a class="nav-link px-2 <?php echo get_current_url() == 'laporan' ? 'active' : '' ?>" href="laporan.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 <?php echo get_current_url() == 'approval' ? 'active' : '' ?>" href="approval.php">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-notification-70 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Persetujuan</span>
                </a>
            </li>
            <?php } ?>
            <?php if ($_SESSION['user']['role'] == "Admin") { ?>
                <li class="nav-item">
                    <a class="nav-link px-2 <?php echo get_current_url() == 'monitoring' ? 'active' : '' ?>" href="monitoring.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Monitoring</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-3 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master Data</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 <?php echo get_current_url() == 'master kategori' ? 'active' : '' ?>" href="master-kategori.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-support-16 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 <?php echo get_current_url() == 'master status' ? 'active' : '' ?>" href="master-status.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-support-16 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Status</span>
                    </a>
                    <a class="nav-link px-2 <?php echo get_current_url() == 'master tahun ajaran' ? 'active' : '' ?>" href="master-tahun-ajaran.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-support-16 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tahun Ajaran</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="sidenav-footer mx-3 position-relative mt-4" style="height: 7.875rem;">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-30 mx-auto rounded" src="assets/img/photo-profile-baru.png" alt="..." />
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0"><?php echo $_SESSION['user']['nama'] ?></h6>
                    <p class="text-xs font-weight-bold mb-0"><?php echo $_SESSION['user']['role'] ?></p>
                </div>
            </div>
        </div>
        <!-- <a href="" target="_blank" class="btn btn-ubk btn-sm w-100 mb-3">View Profile</a> -->
    </div>
</aside>