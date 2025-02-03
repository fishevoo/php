<style>
    :root {
        --primary-color: #000000;
    }

    .pr-container {
        padding: 25px;
        background-color: var(--background-color);
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        margin: 20px;
        border: 1px solid var(--border-color);
    }

    .pr-title {
        color: var(--text-color);
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--primary-color);
        font-weight: 600;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
    }

    .pr-buttons .btn {
        margin-left: 10px;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: var(--transition);
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .pr-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .pr-table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    .pr-table thead th {
        background: var(--primary-color) !important;
        color: white;
        font-weight: 500;
        padding: 15px;
        border: none;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }

    .pr-table tbody tr {
        transition: var(--transition);
    }

    .pr-table tbody tr:hover {
        background-color: var(--hover-color);
    }

    .input-period {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .input-period input {
        border: 1px solid #e2e8f0;
        padding: 10px;
        transition: var(--transition);
    }

    .input-period input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
    }

    .input-period .input-group-text {
        background-color: #f8fafc;
        border-color: #e2e8f0;
        color: var(--primary-color);
    }

    .form-label {
        color: var(--primary-color);
        font-weight: 500;
        margin-bottom: 8px;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 20px;
    }
    
    .pr-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .pr-info-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .pr-info-label {
        min-width: 80px;
        font-weight: 500;
        color: var(--primary-color);
    }
    
    .pr-buttons-group {
        display: flex;
        gap: 10px;
    }
    
    .pr-buttons-group .btn {
        white-space: nowrap;
    }
</style>

<div class="pr-container">
    <h4 class="pr-title">Daftar Consumable PR</h4>
    <div class="header-section">
        <div class="pr-info">
            <div class="pr-info-row">
                <span class="pr-info-label">No. PR</span>
                <span>:</span>
                <span id="pr_number">-</span>
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
