<?php
if (!defined('BASE_PATH')) {
    exit('No direct script access allowed');
}

$mainController = new MainController($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Karunia Berca Indonesia - ERP System</title>
    <link rel="stylesheet" href="/erp/public/assets/css/App.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="App">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="logo" onclick="window.location.href='/'">
                <img src="/erp/public/assets/images/logo.png" alt="Company Logo">
                <h1>PT KARUNIA BERCA INDONESIA</h1>
            </div>
            <div class="nav-icons">
                <button class="icon-button">
                    <i class="fas fa-th-large"></i>
                </button>
                <button class="icon-button">
                    <i class="fas fa-chart-bar"></i>
                </button>
                <button class="icon-button">
                    <i class="fas fa-calendar"></i>
                </button>
                <div class="user-profile-dropdown">
                    <div class="user-profile" onclick="toggleProfileMenu()">
                        <img src="/erp/public/assets/images/user-avatar.png" alt="User avatar">
                        <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <i class="fas fa-chevron-down profile-arrow"></i>
                    </div>
                    <div id="profileMenu" class="profile-menu" style="display: none;">
                        <!-- Profile menu items -->
                    </div>
                </div>
            </div>
        </nav>

        <div class="main-container">
            <!-- Sidebar -->
            <?php 
            $menuItems = $mainController->getMenuItems();
            include BASE_PATH . '/includes/sidebar.php'; 
            ?>

            <!-- Main Content -->
            <main class="content">
                <?php include $content_path; ?>
            </main>
        </div>

        <!-- Footer -->
        <?php include BASE_PATH . '/includes/footer.php'; ?>
    </div>

    <?php include BASE_PATH . '/includes/main.php'; ?>
</body>
</html> 