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
    <title>Engineering Consumable PR - ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
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

    <div class="pr-container">
        <h4 class="pr-title">Daftar Consumable PR</h4>
        <div class="header-section">
            <div class="pr-info">
                <div class="pr-info-row">
                    <span class="pr-info-label">No. PR</span>
                    <span>:</span>
                    <span class="pr-number-box" id="pr_number">-</span>
                </div>
                <div class="pr-info-row">
                    <span class="pr-info-label">Periode</span>
                    <span>:</span>
                    <div class="input-group input-period">
                        <input type="date" class="form-control" id="start_date" name="start_date">
                        <span class="input-group-text">s/d</span>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                </div>
            </div>
            <div class="pr-buttons-group">
                <button class="btn btn-secondary" id="btnDetail">
                    <i class="fas fa-list me-1"></i> Detail
                </button>
                <button class="btn btn-info text-white" id="btnPreview">
                    <i class="fas fa-eye me-1"></i> Preview PR
                </button>
                <button class="btn btn-success" id="btnAddNew">
                    <i class="fas fa-plus me-1"></i> Add New
                </button>
                <button class="btn btn-primary" id="btnRefresh">
                    <i class="fas fa-sync-alt me-1"></i> Refresh
                </button>
            </div>
        </div>

        <div class="table-responsive pr-table">
            <table class="table table-bordered table-hover mb-0" id="tblConsumablePR">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">NO</th>
                        <th width="20%">NOMOR</th>
                        <th width="15%">TANGGAL</th>
                        <th width="70%">PROJECT</th>
                        <th width="20%">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Add hover effect to buttons
        $('.pr-buttons .btn').hover(
            function() { $(this).addClass('shadow-sm'); },
            function() { $(this).removeClass('shadow-sm'); }
        );

        // Initialize date inputs with current month
        const now = new Date();
        const firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
        const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0);
        
        $('#start_date').val(firstDay.toISOString().split('T')[0]);
        $('#end_date').val(lastDay.toISOString().split('T')[0]);

        // Add subtle animation to table rows on load
        $('#tblConsumablePR tbody tr').each(function(index) {
            $(this).css({
                'opacity': 0,
                'transform': 'translateY(20px)'
            }).delay(index * 100).animate({
                'opacity': 1,
                'transform': 'translateY(0)'
            }, 500);
        });

        // Smooth button click effect
        $('.pr-buttons .btn').on('mousedown', function() {
            $(this).css('transform', 'scale(0.95)');
        }).on('mouseup mouseleave', function() {
            $(this).css('transform', 'translateY(-2px)');
        });
    });
    </script>
</body>
</html>
