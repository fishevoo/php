<?php
require_once '../config/database.php';

// Fetch PR Data
function getPRData($startDate, $endDate, $searchQuery = '') {
    global $conn;
    
    $sql = "SELECT TOP 1000 
                PR.NO,
                PR.NOMOR,
                PR.TANGGAL,
                PR.PROJECT,
                PR.STATUS
            FROM PR_RAW_MATERIAL PR
            WHERE PR.TANGGAL BETWEEN ? AND ?";
    
    if (!empty($searchQuery)) {
        $sql .= " AND PR.NOMOR LIKE ?";
        $params = array($startDate, $endDate, '%' . $searchQuery . '%');
    } else {
        $params = array($startDate, $endDate);
    }
    
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    $data = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $row['TANGGAL'] = $row['TANGGAL']->format('Y-m-d');
        $data[] = $row;
    }
    
    return $data;
}

// Handle Add New PR
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $prData = $_POST['prData'];
    
    $sql = "INSERT INTO PR_RAW_MATERIAL (NOMOR, TANGGAL, DIVISION, DEPARTMENT, SECTION, REMARK)
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $params = array(
        $prData['nomor'],
        $prData['tanggal'],
        $prData['division'],
        $prData['department'],
        $prData['section'],
        $prData['remark']
    );
    
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    if ($stmt === false) {
        echo json_encode(['success' => false, 'error' => sqlsrv_errors()]);
        exit();
    }
    
    echo json_encode(['success' => true]);
    exit();
}

$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '2025-01-01';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '2025-01-31';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$prData = getPRData($startDate, $endDate, $searchQuery);
?>

<div class="pr-list-container">
    <div class="pr-header">
        <h2>Daftar PR Raw Material</h2>
        <div class="pr-controls">
            <div class="search-box">
                <label>No. PR:</label>
                <input type="text" placeholder="Pencarian..." 
                       value="<?php echo htmlspecialchars($searchQuery); ?>"
                       onchange="updateSearch(this.value)">
            </div>
            <div class="date-range">
                <label>Periode:</label>
                <input type="date" value="<?php echo $startDate; ?>"
                       onchange="updateDateRange('start', this.value)">
                <input type="date" value="<?php echo $endDate; ?>"
                       onchange="updateDateRange('end', this.value)">
            </div>
            <div class="action-buttons">
                <button onclick="showPRForm()">
                    <i class="fas fa-plus"></i> Add New
                </button>
                <button onclick="refreshData()">
                    <i class="fas fa-sync"></i> Refresh
                </button>
            </div>
        </div>
    </div>

    <div class="pr-table-container">
        <table class="pr-table">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NOMOR</th>
                    <th>TANGGAL</th>
                    <th>PROJECT</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prData as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['NO']); ?></td>
                    <td><?php echo htmlspecialchars($item['NOMOR']); ?></td>
                    <td><?php echo htmlspecialchars($item['TANGGAL']); ?></td>
                    <td><?php echo htmlspecialchars($item['PROJECT']); ?></td>
                    <td><?php echo htmlspecialchars($item['STATUS']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function updateSearch(value) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('search', value);
    window.location.search = urlParams.toString();
}

function updateDateRange(type, value) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set(type === 'start' ? 'startDate' : 'endDate', value);
    window.location.search = urlParams.toString();
}

function refreshData() {
    window.location.reload();
}

function showPRForm() {
    // Implementasi form modal
}
</script> 