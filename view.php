<?php
session_start();
include('partial/header2.php');
?>

<nav class="navbar bg-gray-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="logo text-xl font-bold">AppLet.com</div>
        <ul class="flex space-x-4">
            <li><a href="home.php" class="hover:bg-gray-900 text-white px-4 py-2 rounded font-bold">Home</a></li>
            <li><a href="view.php" class="hover:bg-gray-900 text-white px-4 py-2 rounded font-bold">Records</a></li>
            <li><a href="index.php" class="hover:bg-gray-900 text-white px-4 py-2 rounded font-bold">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container mx-auto py-8">
    <h1 class="text-4xl font-bold py-8 text-white">Records</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gray-700 p-6 rounded-lg shadow-lg flex flex-col items-center justify-between transition-transform transform hover:scale-105">
            <h2 class="text-2xl font-bold mb-4 text-white">Customers</h2>
            <a href="customers.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition-colors">View Records</a>
        </div>

        <div class="bg-gray-700 p-6 rounded-lg shadow-lg flex flex-col items-center justify-between transition-transform transform hover:scale-105">
            <h2 class="text-2xl font-bold mb-4 text-white">Services</h2>
            <a href="services.php" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded transition-colors">View Records</a>
        </div>
    </div>
</div>

<?php require('partial/footer.php'); ?>