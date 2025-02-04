<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">ERP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button">
                            Input Data
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu" onmouseover="this.querySelector('.dropdown-menu').style.display='block'" onmouseout="this.querySelector('.dropdown-menu').style.display='none'">
                                <a class="dropdown-item" href="#">HRD &raquo;</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="hrd_cuti.php">Cuti Karyawan</a></li>
                                    <li><a class="dropdown-item" href="hrd_consumable.php">Consumable PR</a></li>
                                    <li><a class="dropdown-item" href="hrd_ijin.php">Keterlambatan & Ijin</a></li>
                                    <li><a class="dropdown-item" href="hrd_potong_gaji.php">Cuti Potong Gaji</a></li>
                                    <li><a class="dropdown-item" href="hrd_recruitment.php">Recruitment</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu" onmouseover="this.querySelector('.dropdown-menu').style.display='block'" onmouseout="this.querySelector('.dropdown-menu').style.display='none'">
                                <a class="dropdown-item" href="#">PROCUREMENT &raquo;</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="procurement_po.php">PO</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu" onmouseover="this.querySelector('.dropdown-menu').style.display='block'" onmouseout="this.querySelector('.dropdown-menu').style.display='none'">
                                <a class="dropdown-item" href="#">LOGISTIC &raquo;</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="logistic_consumable.php">Consumable RAIR</a></li>
                                    <li><a class="dropdown-item" href="logistic_rair.php">LOGISTIC RAIR</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu" onmouseover="this.querySelector('.dropdown-menu').style.display='block'" onmouseout="this.querySelector('.dropdown-menu').style.display='none'">
                                <a class="dropdown-item" href="#">ENGINEERING &raquo;</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="eng_raw_mto.php">Raw Material MTO</a></li>
                                    <li><a class="dropdown-item" href="eng_raw_pr.php">Raw Material PR</a></li>
                                    <li><a class="dropdown-item" href="eng_cons_pr.php">Consumable PR</a></li>
                                    <li><a class="dropdown-item" href="eng_cons_rair.php">Consumable RAIR</a></li>
                                    <li><a class="dropdown-item" href="eng_exp.php">Expense Statement</a></li>
                                    <li><a class="dropdown-item" href="eng_rair_surplus.php">RAIR Surplus</a></li>
                                    <li><a class="dropdown-item" href="eng_conv_nc.php">Convert NC to NC1</a></li>
                                    <li><a class="dropdown-item" href="eng_cuti.php">Cuti Karyawan</a></li>
                                    <li><a class="dropdown-item" href="eng_spj.php">Surat Perintah Jalan</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <h1>Welcome to Dashboard <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
