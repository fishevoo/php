<aside class="sidebar">
    <div class="menu-item <?php echo $page === 'dashboard' ? 'active' : ''; ?>" 
         onclick="window.location.href='index.php'">
        <i class="fas fa-home"></i>
        <span>Dashboard</span>
    </div>
    
    <div class="menu-item-dropdown">
        <div class="menu-item" onclick="toggleInputMenu(event)">
            <i class="fas fa-database"></i>
            <span>Input Data</span>
            <i class="fas fa-chevron-down menu-arrow"></i>
        </div>
        
        <div id="inputMenu" class="submenu" style="display: none;">
            <?php
            $menuItems = [
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

            foreach ($menuItems as $category => $items): ?>
                <div class="submenu-category">
                    <div class="submenu-header" onclick="toggleCategory(event, '<?php echo $category; ?>')">
                        <span><?php echo $category; ?></span>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <div id="category-<?php echo $category; ?>" class="submenu-items" style="display: none;">
                        <?php foreach ($items as $item): ?>
                            <div class="submenu-item" onclick="handleMenuClick('<?php echo $item; ?>')">
                                <?php echo $item; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</aside> 