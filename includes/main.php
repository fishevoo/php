<?php
class MainController {
    private $conn;
    
    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }
    
    public function toggleProfileMenu() {
        // Logic untuk mengelola state menu profile di session
        if (!isset($_SESSION['profile_menu_state'])) {
            $_SESSION['profile_menu_state'] = 'hidden';
        }
        $_SESSION['profile_menu_state'] = ($_SESSION['profile_menu_state'] === 'hidden') ? 'visible' : 'hidden';
        return $_SESSION['profile_menu_state'];
    }
    
    public function getMenuItems() {
        return [
            'HRD' => [
                'Cuti Karyawan',
                'Consumable PR',
                'Keterlambatan & Ijin',
                'Cuti Potong Gaji',
                'Recruitment'
            ],
            'PROCUREMENT' => ['PO'],
            'LOGISTIC' => [
                'Consumable RAIR',
                'LOGISTIC RAIR'
            ],
            'ENGINEERING' => [
                'Raw Material MTO',
                'Raw Material PR',
                'Consumable PR',
                'Consumable RAIR',
                'Expense Statement',
                'RAIR Surplus',
                'Convert NC to NC1',
                'Cuti Karyawan',
                'Surat Perintah Jalan'
            ]
        ];
    }
    
    public function isFeatureAvailable($menuItem) {
        $availableFeatures = [
            'raw material mto',
            'raw material pr',
            'consumable pr',
            'consumable rair',
            'expense statement'
        ];
        
        return in_array(strtolower($menuItem), $availableFeatures);
    }
    
    public function formatPageName($menuItem) {
        return str_replace(' ', '-', strtolower($menuItem));
    }
    
    public function handleSignOut() {
        session_destroy();
        header("Location: pages/login.php");
        exit();
    }
    
    public function handleMenuAction($action, $params = []) {
        switch($action) {
            case 'toggle_profile':
                return json_encode(['state' => $this->toggleProfileMenu()]);
                
            case 'check_feature':
                if (!isset($params['menuItem'])) {
                    return json_encode(['error' => 'Menu item not specified']);
                }
                return json_encode([
                    'available' => $this->isFeatureAvailable($params['menuItem']),
                    'pageName' => $this->formatPageName($params['menuItem'])
                ]);
                
            case 'signout':
                $this->handleSignOut();
                break;
                
            default:
                return json_encode(['error' => 'Invalid action']);
        }
    }
}

// Handle AJAX requests
if (isset($_POST['action'])) {
    require_once '../config/database.php';
    session_start();
    
    $controller = new MainController($conn);
    echo $controller->handleMenuAction(
        $_POST['action'], 
        isset($_POST['params']) ? $_POST['params'] : []
    );
    exit();
}
?>

<!-- JavaScript minimal untuk interaksi UI -->
<script>
async function toggleProfileMenu() {
    try {
        const response = await fetch('includes/main.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=toggle_profile'
        });
        const data = await response.json();
        
        const profileMenu = document.getElementById('profileMenu');
        profileMenu.style.display = data.state === 'visible' ? 'block' : 'none';
    } catch (error) {
        console.error('Error toggling profile menu:', error);
    }
}

async function handleMenuClick(menuItem) {
    try {
        const response = await fetch('includes/main.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=check_feature&params[menuItem]=${encodeURIComponent(menuItem)}`
        });
        const data = await response.json();
        
        if (!data.available) {
            alert('Mohon maaf, fitur ini sedang dalam pengembangan dan akan segera tersedia!');
            return;
        }
        
        window.location.href = `index.php?page=${data.pageName}`;
    } catch (error) {
        console.error('Error handling menu click:', error);
    }
}

async function handleSignOut() {
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        try {
            await fetch('includes/main.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=signout'
            });
            window.location.href = 'pages/login.php';
        } catch (error) {
            console.error('Error signing out:', error);
        }
    }
}

function toggleInputMenu(event) {
    event.preventDefault();
    event.stopPropagation();
    const inputMenu = document.getElementById('inputMenu');
    inputMenu.style.display = inputMenu.style.display === 'none' ? 'block' : 'none';
}

function toggleCategory(event, category) {
    event.preventDefault();
    event.stopPropagation();
    const categoryMenu = document.getElementById(`category-${category}`);
    const arrow = event.currentTarget.querySelector('i');
    
    if (categoryMenu.style.display === 'none') {
        categoryMenu.style.display = 'block';
        arrow.classList.replace('fa-chevron-right', 'fa-chevron-down');
    } else {
        categoryMenu.style.display = 'none';
        arrow.classList.replace('fa-chevron-down', 'fa-chevron-right');
    }
}
</script> 