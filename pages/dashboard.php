<div class="dashboard-container">
    <div class="welcome-section">
        <h2>Enterprise Resource Planning</h2>
        <h3>PT Karunia Berca Indonesia</h3>
    </div>
    
    <div class="yearly-quotation">
        <div class="quotation-header">
            <h3>Yearly Quotation</h3>
            <select id="yearSelect" onchange="updateQuotationYear(this.value)">
                <?php
                $currentYear = date('Y');
                for ($year = $currentYear; $year >= $currentYear - 2; $year--) {
                    echo "<option value=\"$year\">$year</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="quotation-table-container">
            <?php
            // Fetch quotation data from database
            $sql = "SELECT 
                        CategoryName,
                        SUM(Tonage) as TotalTonage,
                        SUM(Value) as TotalValue
                    FROM QuotationSummary
                    WHERE YEAR(Period) = ?
                    GROUP BY CategoryName";
            
            $params = array($currentYear);
            $stmt = sqlsrv_query($conn, $sql, $params);
            
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            ?>
            
            <table class="quotation-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Tonage (Ton)</th>
                        <th>Value (Mio)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalTonage = 0;
                    $totalValue = 0;
                    
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $totalTonage += $row['TotalTonage'];
                        $totalValue += $row['TotalValue'];
                        
                        $arrowColor = '';
                        switch(strtolower($row['CategoryName'])) {
                            case 'tower - transmission':
                                $arrowColor = 'blue';
                                break;
                            case 'tower - telecommunication':
                                $arrowColor = 'orange';
                                break;
                            case 'bridges':
                                $arrowColor = 'purple';
                                break;
                            case 'steel structure':
                                $arrowColor = 'red';
                                break;
                            default:
                                $arrowColor = 'green';
                        }
                        ?>
                        <tr>
                            <td>
                                <span class="arrow <?php echo $arrowColor; ?>"></span>
                                <?php echo htmlspecialchars($row['CategoryName']); ?>
                            </td>
                            <td><?php echo number_format($row['TotalTonage'], 2); ?></td>
                            <td><?php echo number_format($row['TotalValue'], 2); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr class="total-row">
                        <td><strong>TOTAL</strong></td>
                        <td><strong><?php echo number_format($totalTonage, 2); ?> T</strong></td>
                        <td><strong><?php echo number_format($totalValue, 2); ?> M</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> 