<?php
    session_start();
    require_once '../bl/userManagement.php';

    $usermanagement = new UserManagement();
    $users = $usermanagement->getUser();
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
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $index => $user) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($user['firstName']) ?></td>
                                <td><?= htmlspecialchars($user['lastName']) ?></td>
                                <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                                <td><?= htmlspecialchars($user['phoneNumber'] ?? '') ?></td>
                                <td>
                                    <div class="flex gap-2">
                                        <button class="px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm" type="button" onclick="updateFunc(<?= $user['userID'] ?>)">Update</button>
                                        <button class="px-3 py-2 rounded-lg bg-red-600 text-white text-sm" type="button" onclick="deleteFunc(<?= $user['userID'] ?>)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="../scripts/Service.js?v=20260401a"></script>
</body>
</html>