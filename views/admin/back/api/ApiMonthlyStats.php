<?php
header("Content-Type: application/json");
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/views/admin/back/dao/DAOStats.php';

$dao = new StatsDAO();
$rawStats = $dao->getMonthlyStats();

$months = [];
for ($i = 6; $i >= 0; $i--) {
    $months[] = date("Y-m", strtotime("-$i month"));
}

$salesData = array_fill_keys($months, 0);
$revenueData = array_fill_keys($months, 0);
$customersData = array_fill_keys($months, 0);

foreach ($rawStats['sales'] as $row) {
    $month = $row['month'];
    $salesData[$month] = (int) $row['sales_count'];
    $revenueData[$month] = (float) $row['total_revenue'] / 1000; 
}

foreach ($rawStats['customers'] as $row) {
    $customersData[$row['month']] = (int) $row['customer_count'];
}

echo json_encode([
    'months' => array_values($months),
    'sales' => array_values($salesData),
    'revenue' => array_values($revenueData),
    'customers' => array_values($customersData)
]);
