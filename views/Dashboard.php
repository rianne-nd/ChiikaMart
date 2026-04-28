<?php
    session_start();
    require_once '../bl/userManagement.php';

    $usermanagement = new UserManagement();
    $users = $usermanagement->getUser();
    $orderStatuses = $usermanagement->getCardOrderStatus();

    $kpiTotalSales = $usermanagement->getTotalSalesRevenue();
    $kpiTotalOrders = $usermanagement->getTotalOrders();
    $kpiLowStock = $usermanagement->getLowStockCount();
    $kpiOutOfStock = $usermanagement->getOutOfStockCount();
    $kpiTotalUsers = $usermanagement->getTotalUsers();
    $kpiMostWishlisted = $usermanagement->getMostWishlisted();
    $kpiAverageRating = $usermanagement->getAverageRating();

    $monthlySales = $usermanagement->getSalesByMonth();
    $monthlyRegistrations = $usermanagement->getRegistrationsByMonth();
    $topSellingProducts = $usermanagement->getTopSellingProducts();
    $revenueByCharacter = $usermanagement->getRevenueByCharacter();
    $revenueByCollection = $usermanagement->getRevenueByCollection();
    $reviewStarDistribution = $usermanagement->getReviewStarDistribution();
    $lowestStockWatchlist = $usermanagement->getLowestStockWatchlist();

    $salesLabels = array_column($monthlySales, 'order_month');
    $salesData = array_column($monthlySales, 'total_revenue');
    $registrationLabels = array_column($monthlyRegistrations, 'reg_month');
    $registrationData = array_column($monthlyRegistrations, 'total_users');
    $statusLabels = array_column($orderStatuses, 'statusName');
    $statusData = array_column($orderStatuses, 'total_orders');
    $topSellingLabels = array_column($topSellingProducts, 'productName');
    $topSellingData = array_column($topSellingProducts, 'total_sold');
    $characterRevenueLabels = array_column($revenueByCharacter, 'charName');
    $characterRevenueData = array_column($revenueByCharacter, 'total_revenue');
    $collectionRevenueLabels = array_column($revenueByCollection, 'collectionName');
    $collectionRevenueData = array_column($revenueByCollection, 'total_revenue');
    $reviewStarLabels = array_column($reviewStarDistribution, 'ratingValue');
    $reviewStarData = array_column($reviewStarDistribution, 'total_reviews');
    $lowestStockLabels = array_column($lowestStockWatchlist, 'productName');
    $lowestStockData = array_column($lowestStockWatchlist, 'stockQuantity');
?>

<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard | ChiikaMart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-image: radial-gradient(#e7e1dd 1px, transparent 1px);
            background-size: 24px 24px;
        }
        #myTable_wrapper {
            color: #1d1b19;
        }
    </style>
</head>
<body class="min-h-screen bg-[#fef8f4] text-[#1d1b19]">
    <header class="sticky top-0 z-20 bg-[#fef8f4]/85 backdrop-blur border-b border-[#e7e1dd]">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-extrabold tracking-tight text-[#4d6076]">ChiikaMart Dashboard</h1>
            <div class="flex gap-2">
                <button class="px-3 py-2 rounded-lg bg-[#4d6076] text-white text-sm" type="button" onclick="redirectFunc(4)">Home</button>
                <button class="px-3 py-2 rounded-lg bg-[#3d6374] text-white text-sm" type="button" onclick="redirectFunc(3)">Registration</button>
                <button class="px-3 py-2 rounded-lg bg-[#697985] text-white text-sm" type="button" onclick="redirectFunc(1)">Logout</button>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <section class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-[#4d6076] mb-3">Quick Stats & Alerts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="rounded-2xl bg-[#4d6076] text-white p-5 shadow-md">
                    <p class="text-sm opacity-90">Total Sales Revenue</p>
                    <p class="text-3xl font-extrabold mt-1">PHP <?= number_format($kpiTotalSales['total_sales'] ?? 0, 2) ?></p>
                </div>
                <div class="rounded-2xl bg-[#3d6374] text-white p-5 shadow-md">
                    <p class="text-sm opacity-90">Total Number of Orders</p>
                    <p class="text-3xl font-extrabold mt-1"><?= $kpiTotalOrders['total_orders'] ?? 0 ?></p>
                </div>
                <div class="rounded-2xl bg-[#697985] text-white p-5 shadow-md">
                    <p class="text-sm opacity-90">Total Registered Users</p>
                    <p class="text-3xl font-extrabold mt-1"><?= $kpiTotalUsers['total_users'] ?? 0 ?></p>
                </div>
                <div class="rounded-2xl bg-[#4d6076] text-white p-5 shadow-md">
                    <p class="text-sm opacity-90">Average Shop Rating</p>
                    <p class="text-3xl font-extrabold mt-1"><?= number_format($kpiAverageRating['avg_rating'] ?? 0, 1) ?> / 5</p>
                </div>
                <div class="rounded-2xl bg-[#b45309] text-white p-5 shadow-md">
                    <p class="text-sm opacity-90">Low Stock Alerts (&lt; 5)</p>
                    <p class="text-3xl font-extrabold mt-1"><?= $kpiLowStock['low_stock_count'] ?? 0 ?></p>
                </div>
                <div class="rounded-2xl bg-[#b91c1c] text-white p-5 shadow-md">
                    <p class="text-sm opacity-90">Critically Out of Stock</p>
                    <p class="text-3xl font-extrabold mt-1"><?= $kpiOutOfStock['out_stock_count'] ?? 0 ?></p>
                </div>
                <div class="rounded-2xl bg-[#3d6374] text-white p-5 shadow-md">
                    <p class="text-sm opacity-90">Most Wishlisted Plushie</p>
                    <p class="text-base font-semibold mt-1"><?= $kpiMostWishlisted['productName'] ?? 'No Data' ?></p>
                    <p class="text-2xl font-extrabold mt-1"><?= $kpiMostWishlisted['wishlist_count'] ?? 0 ?> wishlists</p>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-[#4d6076] mb-3">Order Fulfillment</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php foreach ($orderStatuses as $status) : ?>
                    <div class="rounded-2xl bg-[#4d6076] text-white p-5 shadow-md">
                        <p class="text-sm opacity-90"><?= $status['statusName'] ?></p>
                        <p class="text-3xl font-extrabold mt-1"><?= $status['total_orders'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-[#4d6076] mb-3">Charts & Trends</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white border border-[#e7e1dd] rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-[#4d6076] mb-3">Sales Over Time</h3>
                    <div class="h-72">
                        <canvas id="chartSalesOverTime"></canvas>
                    </div>
                </div>
                <div class="bg-white border border-[#e7e1dd] rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-[#4d6076] mb-3">User Registration Trend</h3>
                    <div class="h-72">
                        <canvas id="chartUserRegistrations"></canvas>
                    </div>
                </div>
                <div class="bg-white border border-[#e7e1dd] rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-[#4d6076] mb-3">Order Status Breakdown</h3>
                    <div class="h-72">
                        <canvas id="chartOrderStatus"></canvas>
                    </div>
                </div>
                <div class="bg-white border border-[#e7e1dd] rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-[#4d6076] mb-3">Top Selling Products</h3>
                    <div class="h-72">
                        <canvas id="chartTopSelling"></canvas>
                    </div>
                </div>
                <div class="bg-white border border-[#e7e1dd] rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-[#4d6076] mb-3">Revenue by Character</h3>
                    <div class="h-72">
                        <canvas id="chartRevenueCharacter"></canvas>
                    </div>
                </div>
                <div class="bg-white border border-[#e7e1dd] rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-[#4d6076] mb-3">Revenue by Collection</h3>
                    <div class="h-72">
                        <canvas id="chartRevenueCollection"></canvas>
                    </div>
                </div>
                <div class="bg-white border border-[#e7e1dd] rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-[#4d6076] mb-3">Review Star Distribution</h3>
                    <div class="h-72">
                        <canvas id="chartReviewStars"></canvas>
                    </div>
                </div>
                <div class="bg-white border border-[#e7e1dd] rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-[#4d6076] mb-3">Lowest Stock Watchlist</h3>
                    <div class="h-72">
                        <canvas id="chartLowestStock"></canvas>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white border border-[#e7e1dd] rounded-3xl shadow-lg p-6 md:p-8">
            <h2 class="text-2xl md:text-3xl font-bold text-[#4d6076] mb-2">Registered Users</h2>
            <p class="text-sm text-[#41484b] mb-6">Use Update/Delete directly from this dashboard table.</p>

            <div class="overflow-x-auto">
                <table id="myTable" class="display w-full">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $user['firstName'] ?></td>
                                <td><?= $user['lastName'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['phoneNumber'] ?></td>
                                <td>
                                    <div class="flex gap-2">
                                        <button class="px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm" type="button" onclick="updateFunc(<?= $user['userID'] ?>)">Update</button>
                                        <button class="px-3 py-2 rounded-lg bg-red-600 text-white text-sm" type="button" onclick="deleteFunc(<?= $user['userID'] ?>)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        window.salesOverTimeData = {
            labels: <?= json_encode($salesLabels) ?>,
            data: <?= json_encode($salesData) ?>
        };
        window.userRegistrationData = {
            labels: <?= json_encode($registrationLabels) ?>,
            data: <?= json_encode($registrationData) ?>
        };
        window.orderStatusData = {
            labels: <?= json_encode($statusLabels) ?>,
            data: <?= json_encode($statusData) ?>
        };
        window.topSellingData = {
            labels: <?= json_encode($topSellingLabels) ?>,
            data: <?= json_encode($topSellingData) ?>
        };
        window.revenueByCharacterData = {
            labels: <?= json_encode($characterRevenueLabels) ?>,
            data: <?= json_encode($characterRevenueData) ?>
        };
        window.revenueByCollectionData = {
            labels: <?= json_encode($collectionRevenueLabels) ?>,
            data: <?= json_encode($collectionRevenueData) ?>
        };
        window.reviewStarData = {
            labels: <?= json_encode($reviewStarLabels) ?>,
            data: <?= json_encode($reviewStarData) ?>
        };
        window.lowestStockData = {
            labels: <?= json_encode($lowestStockLabels) ?>,
            data: <?= json_encode($lowestStockData) ?>
        };
    </script>
    <script src="../scripts/Service.js?v=20260401a"></script>
    <script src="../scripts/DashboardService.js?v=20260401a"></script>
</body>
</html>