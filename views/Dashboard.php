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
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>ChiikaMart Admin Dashboard</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Caveat:wght@600&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal; font-style: normal; font-size: 24px; line-height: 1;
            letter-spacing: normal; text-transform: none; display: inline-block;
            white-space: nowrap; word-wrap: normal; direction: ltr; font-feature-settings: 'liga';
            -webkit-font-feature-settings: 'liga'; -webkit-font-smoothing: antialiased;
        }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f8f2ee; }
        ::-webkit-scrollbar-thumb { background: #d4e5f2; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #b5c8e2; }
        .paper-edge { clip-path: polygon(0% 2%, 5% 0%, 10% 3%, 15% 1%, 20% 4%, 25% 0%, 30% 3%, 35% 1%, 40% 4%, 45% 0%, 50% 3%, 55% 1%, 60% 4%, 65% 0%, 70% 3%, 75% 1%, 80% 4%, 85% 0%, 90% 3%, 95% 1%, 100% 2%, 100% 98%, 95% 100%, 90% 97%, 85% 100%, 80% 96%, 75% 99%, 70% 97%, 65% 100%, 60% 96%, 55% 99%, 50% 97%, 45% 100%, 40% 96%, 35% 99%, 30% 97%, 25% 100%, 20% 96%, 15% 99%, 10% 97%, 5% 100%, 0% 98%); }
        .washi-tape { position: absolute; width: 80px; height: 24px; background-color: rgba(190, 230, 249, 0.4); transform: rotate(-5deg); top: -10px; left: -20px; z-index: 10; clip-path: polygon(2% 0, 98% 2%, 100% 100%, 0 98%); }
        .washi-tape.right { transform: rotate(15deg); top: -5px; left: auto; right: -25px; background-color: rgba(209, 228, 255, 0.4); }
        .washi-tape.warning { background-color: rgba(253, 230, 138, 0.6); }
        .washi-tape.error { background-color: rgba(255, 218, 214, 0.6); }
        .dymo-tag { background-color: #3d6374; color: white; padding: 2px 8px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; transform: rotate(-3deg); box-shadow: 1px 1px 3px rgba(0,0,0,0.2); }
        .chart-container { position: relative; height: 300px; width: 100%; }
        .chart-container.doughnut { height: 250px; }
        #myTable_wrapper { color: #1d1b19; padding: 16px; }
</style>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-bright": "#fef8f4", "on-tertiary-fixed-variant": "#394953", "error-container": "#ffdad6", "on-surface": "#1d1b19", "error": "#ba1a1a", "on-primary": "#ffffff", "primary-fixed-dim": "#b5c8e2", "outline": "#71787c", "surface-container-highest": "#e7e1dd", "on-tertiary-fixed": "#0d1d27", "on-tertiary": "#ffffff", "tertiary-fixed-dim": "#b8c9d6", "surface-container-low": "#f8f2ee", "on-secondary-fixed": "#001f29", "on-surface-variant": "#41484b", "on-secondary": "#ffffff", "surface-variant": "#e7e1dd", "inverse-surface": "#32302e", "on-secondary-fixed-variant": "#244c5b", "on-primary-fixed": "#081d30", "surface-tint": "#4e6076", "secondary-fixed-dim": "#a5ccdf", "surface-dim": "#dfd9d5", "on-background": "#1d1b19", "surface": "#fef8f4", "surface-container-lowest": "#ffffff", "surface-container": "#f3ede9", "primary-container": "#66788f", "inverse-on-surface": "#f6f0ec", "tertiary": "#50606b", "tertiary-fixed": "#d4e5f2", "tertiary-container": "#697985", "secondary-fixed": "#c1e8fc", "secondary": "#3d6374", "on-primary-fixed-variant": "#36485d", "primary-fixed": "#d1e4ff", "inverse-primary": "#b5c8e2", "on-error-container": "#93000a", "background": "#fef8f4", "secondary-container": "#bee6f9", "surface-container-high": "#ede7e3", "primary": "#4d6076", "outline-variant": "#c1c7cb", "on-tertiary-container": "#00060b", "on-error": "#ffffff", "on-secondary-container": "#426878", "on-primary-container": "#ffffff"
                    },
                    "borderRadius": { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px", "2xl": "1.25rem", "3xl": "1.5rem" },
                    "fontFamily": { "headline": ["Plus Jakarta Sans"], "display": ["Plus Jakarta Sans"], "body": ["Plus Jakarta Sans"], "label": ["Plus Jakarta Sans"], "handwriting": ["Caveat", "cursive"] }
                }
            }
        }
</script>
</head>
<body class="bg-surface-bright font-body text-on-surface flex h-screen overflow-hidden selection:bg-secondary-container selection:text-on-secondary-container">
<nav class="hidden md:flex h-screen w-64 fixed left-0 top-0 z-50 border-r-2 border-dashed border-[#3d6374]/20 bg-[#f3ede9] text-[#4d6076] font-['Plus_Jakarta_Sans'] antialiased flex flex-col py-8 gap-2">
<div class="px-8 mt-2 mb-8 flex flex-col items-start gap-2">
<div class="w-12 h-12 rounded-xl bg-surface-container-highest flex items-center justify-center overflow-hidden border-2 border-dashed border-secondary/30 rotate-[-2deg]">
<span class="material-symbols-outlined text-3xl text-primary" data-icon="storefront">storefront</span>
</div>
<div>
<h1 class="text-xl font-black text-[#2F4156] rotate-[-1deg] tracking-tight">ChiikaMart</h1>
<p class="text-sm text-on-surface-variant/70 font-medium">Curated Admin</p>
</div>
</div>
<div class="flex-1 flex flex-col gap-1 w-full">
<a class="bg-white text-[#2F4156] font-bold rounded-l-full ml-4 shadow-[-4px_0_10px_rgba(0,0,0,0.02)] px-6 py-3 flex items-center gap-3 relative z-10" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span>Dashboard</span>
</a>
<a class="text-[#41484b] hover:translate-x-1 transition-transform duration-300 px-6 py-3 flex items-center gap-3" href="#" onclick="redirectFunc(4)">
<span class="material-symbols-outlined" data-icon="home">home</span>
<span>Home Page</span>
</a>
<a class="text-[#41484b] hover:translate-x-1 transition-transform duration-300 px-6 py-3 flex items-center gap-3" href="#" onclick="redirectFunc(3)">
<span class="material-symbols-outlined" data-icon="person_add">person_add</span>
<span>Registration</span>
</a>
<a class="text-[#41484b] hover:translate-x-1 transition-transform duration-300 px-6 py-3 flex items-center gap-3" href="#" onclick="redirectFunc(1)">
<span class="material-symbols-outlined" data-icon="logout">logout</span>
<span>Logout</span>
</a>
</div>
<div class="px-6 mt-auto">
<button class="w-full bg-gradient-to-br from-primary to-primary-container text-white rounded-full py-3 px-4 font-bold text-sm hover:opacity-90 active:scale-95 transition-all shadow-[0_8px_16px_rgba(77,96,118,0.2)] flex justify-center items-center gap-2">
<span class="material-symbols-outlined text-sm">add</span> New Collection
</button>
</div>
</nav>

<div class="flex-1 md:ml-64 flex flex-col h-screen relative bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0iIzQxNDg0YiIgZmlsbC1vcGFjaXR5PSIwLjA1Ii8+PC9zdmc+')]">
<header class="docked full-width top-0 sticky z-40 border-b-2 border-dashed border-[#3d6374]/20 shadow-[0px_20px_40px_rgba(47,65,86,0.06)] bg-[#fef8f4]/80 backdrop-blur-md text-[#4d6076] font-['Plus_Jakarta_Sans'] flex justify-between items-center px-8 h-20 w-full">
<div class="flex items-center gap-4 w-1/3">
<div class="relative w-full max-w-md hidden md:block">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant" data-icon="search">search</span>
<input class="w-full bg-surface-container-high border-none rounded-xl py-2 pl-12 pr-4 text-on-surface focus:ring-2 focus:ring-dashed focus:ring-secondary transition-all placeholder:text-outline-variant font-medium" placeholder="Search records..." type="text"/>
</div>
<h1 class="text-xl font-bold tracking-tight text-[#2F4156] md:hidden">ChiikaMart</h1>
</div>
<div class="flex items-center gap-6">
<button class="hover:bg-[#f3ede9]/50 transition-all active:scale-95 duration-200 p-2 rounded-full relative text-on-surface-variant">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
<span class="absolute top-1 right-2 w-2 h-2 bg-error rounded-full"></span>
</button>
<button class="hover:bg-[#f3ede9]/50 transition-all active:scale-95 duration-200 p-2 rounded-full text-on-surface-variant">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
</button>
<div class="h-8 w-px bg-outline-variant/30 mx-2"></div>
<div class="w-10 h-10 rounded-full bg-secondary-container border-2 border-dashed border-secondary/50 overflow-hidden flex items-center justify-center cursor-pointer hover:rotate-6 transition-transform">
<img alt="Admin Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2rpYOXoR2E6Vce2IoSb4y0FJ9ToH2MrXrEQ_yzkqFh-ZbbBHKeJkP1o78AUu2h_JOyeuAm_N5KkoHTlqHCTH5qHBIhBPtuvi8ZxTJYm8NurMHNgAuGxtSa0AnZ8Qy5cuVk85Zew5HDdbhdOFhKZxSy-PhISu4SFfFnMHCd6Ta0G1fzT3E3Sm_MV9R08hpddF_mK8GxAYTy3bQ4PrlOMD2mWF9N_bRDoSEipJuWmQ5ed5Av7p8FXrhHgi_0jKpRPX5G1yf6a1rS3U"/>
</div>
</div>
</header>

<main class="flex-1 overflow-y-auto p-6 md:p-10 lg:p-12 space-y-12">
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-4">
<div class="relative">
<div class="washi-tape"></div>
<h2 class="text-4xl font-extrabold text-[#2F4156] tracking-tight -rotate-1 relative z-10">Morning, Chiika!</h2>
<p class="text-on-surface-variant mt-2 max-w-md font-medium">Let's check on the plushie empire.</p>
</div>
<div class="flex gap-3">
<button class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface font-semibold hover:bg-surface-dim transition-colors flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]">calendar_today</span> Today
</button>
</div>
</div>

<!-- KPI Cards using PHP values -->
<div class="space-y-6">
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
<div class="bg-surface-container-lowest rounded-3xl p-6 relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden group">
<div class="absolute -right-6 -top-6 w-24 h-24 bg-primary-fixed/20 rounded-full blur-2xl group-hover:bg-primary-fixed/40 transition-all"></div>
<div class="flex justify-between items-start mb-4 relative z-10">
<div class="p-3 bg-surface-container rounded-2xl"><span class="material-symbols-outlined text-primary" data-icon="payments">payments</span></div>
<span class="text-xs font-bold uppercase tracking-wider text-secondary bg-secondary-container/50 px-2 py-1 rounded-md">+12%</span>
</div>
<p class="text-sm font-bold text-on-surface-variant/80 uppercase tracking-wider mb-1 relative z-10">Total Revenue</p>
<h3 class="text-3xl font-extrabold text-on-primary-fixed relative z-10">₱ <?= number_format($kpiTotalSales['total_sales'] ?? 0, 2) ?></h3>
</div>

<div class="bg-surface-container-lowest rounded-3xl p-6 relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden group">
<div class="absolute w-8 h-3 bg-tertiary-fixed/60 -top-1 left-8 -rotate-3 z-20"></div>
<div class="flex justify-between items-start mb-4 relative z-10">
<div class="p-3 bg-surface-container rounded-2xl"><span class="material-symbols-outlined text-tertiary" data-icon="local_shipping">local_shipping</span></div>
</div>
<p class="text-sm font-bold text-on-surface-variant/80 uppercase tracking-wider mb-1 relative z-10">Orders</p>
<h3 class="text-3xl font-extrabold text-on-primary-fixed relative z-10"><?= $kpiTotalOrders['total_orders'] ?? 0 ?></h3>
</div>

<div class="bg-surface-container-lowest rounded-3xl p-6 relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden group">
<div class="flex justify-between items-start mb-4 relative z-10">
<div class="p-3 bg-surface-container rounded-2xl"><span class="material-symbols-outlined text-secondary" data-icon="group">group</span></div>
</div>
<p class="text-sm font-bold text-on-surface-variant/80 uppercase tracking-wider mb-1 relative z-10">Active Users</p>
<h3 class="text-3xl font-extrabold text-on-primary-fixed relative z-10"><?= $kpiTotalUsers['total_users'] ?? 0 ?></h3>
</div>

<div class="bg-surface-container-lowest rounded-3xl p-6 relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden group">
<div class="absolute -right-4 -bottom-4 w-20 h-20 bg-secondary-container/30 rounded-full blur-xl z-0"></div>
<div class="flex justify-between items-start mb-4 relative z-10">
<div class="p-3 bg-surface-container rounded-2xl"><span class="material-symbols-outlined text-[#eab308]" data-icon="star" style="font-variation-settings: 'FILL' 1;">star</span></div>
</div>
<p class="text-sm font-bold text-on-surface-variant/80 uppercase tracking-wider mb-1 relative z-10">Avg Rating</p>
<h3 class="text-3xl font-extrabold text-on-primary-fixed relative z-10"><?= number_format($kpiAverageRating['avg_rating'] ?? 0, 1) ?> <span class="text-lg font-medium text-outline-variant">/ 5.0</span></h3>
</div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<div class="bg-surface-container-lowest rounded-3xl p-6 relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] border border-surface-variant/50">
<div class="flex items-center gap-4 mb-2">
<span class="material-symbols-outlined text-tertiary" data-icon="favorite">favorite</span>
<p class="text-sm font-bold text-on-surface-variant/80 uppercase tracking-wider">Most Wishlisted</p>
</div>
<h3 class="text-xl font-extrabold text-on-primary-fixed mt-2"><?= $kpiMostWishlisted['productName'] ?? 'No Data' ?></h3>
<p class="text-sm font-medium opacity-70"><?= $kpiMostWishlisted['wishlist_count'] ?? 0 ?> wishlists</p>
</div>

<div class="bg-[#fff8eb] rounded-3xl p-6 relative shadow-[0px_20px_40px_rgba(47,65,86,0.02)] border-2 border-dashed border-[#fcd34d]/50">
<div class="flex items-center gap-4 mb-2">
<span class="material-symbols-outlined text-[#d97706]" data-icon="warning">warning</span>
<p class="text-sm font-bold text-[#b45309] uppercase tracking-wider">Low Stock</p>
</div>
<h3 class="text-3xl font-extrabold text-[#92400e] mt-2"><?= $kpiLowStock['low_stock_count'] ?? 0 ?> <span class="text-sm font-medium opacity-70">Items &lt; 5</span></h3>
</div>

<div class="bg-error-container/30 rounded-3xl p-6 relative shadow-[0px_20px_40px_rgba(47,65,86,0.02)] border-2 border-dashed border-error/20">
<div class="absolute w-10 h-4 bg-error/10 -top-2 right-8 rotate-3 z-20 backdrop-blur-sm"></div>
<div class="flex items-center gap-4 mb-2">
<span class="material-symbols-outlined text-error" data-icon="error">error</span>
<p class="text-sm font-bold text-error uppercase tracking-wider">Out of Stock</p>
</div>
<h3 class="text-3xl font-extrabold text-on-error-container mt-2"><?= $kpiOutOfStock['out_stock_count'] ?? 0 ?> <span class="text-sm font-medium opacity-70">Items at 0</span></h3>
</div>
</div>
</div>

<section class="space-y-8 mt-8">
<div class="flex items-center gap-3 mb-2">
<span class="material-symbols-outlined text-secondary text-3xl">analytics</span>
<h3 class="font-handwriting text-4xl text-[#2F4156]">Analytics &amp; Trends</h3>
</div>

<div class="bg-surface-container-lowest rounded-xl relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden border-2 border-dashed border-outline-variant/20 p-6">
<div class="washi-tape"></div>
<h4 class="font-bold text-[#2F4156] mb-4">Sales Over Time</h4>
<div class="chart-container"><canvas id="chartSalesOverTime"></canvas></div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
<div class="bg-surface-container-lowest rounded-xl relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden border-2 border-dashed border-outline-variant/20 p-6">
<div class="washi-tape right"></div>
<h4 class="font-bold text-[#2F4156] mb-4">User Registration Trend</h4>
<div class="chart-container"><canvas id="chartUserRegistrations"></canvas></div>
</div>
<div class="bg-surface-container-lowest rounded-xl relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden border-2 border-dashed border-outline-variant/20 p-6">
<h4 class="font-bold text-[#2F4156] mb-4">Top Selling Products</h4>
<div class="chart-container"><canvas id="chartTopSelling"></canvas></div>
</div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<div class="bg-surface-container-lowest rounded-xl relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden border-2 border-dashed border-outline-variant/20 p-6">
<div class="washi-tape"></div>
<h4 class="font-bold text-[#2F4156] mb-4">Revenue by Character</h4>
<div class="chart-container"><canvas id="chartRevenueCharacter"></canvas></div>
</div>
<div class="bg-surface-container-lowest rounded-xl relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden border-2 border-dashed border-outline-variant/20 p-6">
<h4 class="font-bold text-[#2F4156] mb-4">Revenue by Collection</h4>
<div class="chart-container"><canvas id="chartRevenueCollection"></canvas></div>
</div>
<div class="bg-surface-container-lowest rounded-xl relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden border-2 border-dashed border-[#d97706]/40 p-6">
<span class="dymo-tag absolute -top-2 -right-2 z-10 !bg-[#d97706]">Watch</span>
<h4 class="font-bold text-[#2F4156] mb-4">Lowest Stock Watchlist</h4>
<div class="chart-container"><canvas id="chartLowestStock"></canvas></div>
</div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<div class="lg:col-span-2 bg-surface-container-lowest rounded-xl relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden border-2 border-dashed border-outline-variant/20 p-6">
<div class="washi-tape"></div>
<h4 class="font-bold text-[#2F4156] mb-4">Review Star Distribution</h4>
<div class="chart-container"><canvas id="chartReviewStars"></canvas></div>
</div>
<div class="lg:col-span-1 bg-surface-container-lowest rounded-xl relative shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden border-2 border-dashed border-outline-variant/20 p-6 flex flex-col">
<div class="washi-tape right"></div>
<h4 class="font-bold text-[#2F4156] mb-4">Order Status</h4>
<div class="chart-container doughnut flex-1 flex items-center justify-center">
<canvas id="chartOrderStatus"></canvas>
</div>
</div>
</div>
</section>

<div class="bg-surface-container-lowest rounded-3xl shadow-[0px_20px_40px_rgba(47,65,86,0.04)] overflow-hidden relative mt-8">
<div class="p-8 border-b-2 border-dashed border-outline-variant/20 flex justify-between items-center bg-surface-container/30">
<div>
<h3 class="text-2xl font-bold text-on-primary-fixed">Registered Users</h3>
<p class="text-sm text-on-surface-variant mt-1">Manage recent sign-ups and customer accounts.</p>
</div>
</div>
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
<button class="px-3 py-2 rounded-lg bg-[#3d6374] text-white text-sm" type="button" onclick="updateFunc(<?= $user['userID'] ?>)">Update</button>
<button class="px-3 py-2 rounded-lg bg-red-600 text-white text-sm" type="button" onclick="deleteFunc(<?= $user['userID'] ?>)">Delete</button>
</div>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<div class="h-12 w-full flex items-center justify-center opacity-50 mt-4 pb-8">
<span class="text-xs font-bold uppercase tracking-widest text-outline-variant flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="cruelty_free">cruelty_free</span> End of Dashboard
</span>
</div>
</main>
</div>

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