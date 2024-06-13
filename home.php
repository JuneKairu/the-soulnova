<?php
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

<div class="container mx-auto py-8 bg-gray-800 px-8">
    <h1 class="text-4xl font-bold text-gray-100 mb-8">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gray-700 rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-200 mb-4">Marketing Overview</h2>
            <div class="graph" id="marketingGraph">
                <canvas id="marketingCanvas"></canvas>
            </div>
            <table class="w-full mt-4 text-gray-200">
                <thead>
                    <tr class="bg-gray-600">
                        <th class="text-left p-2">Metric</th>
                        <th class="text-left p-2">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2">Reach</td>
                        <td class="p-2">1500</td>
                    </tr>
                    <tr class="bg-gray-600">
                        <td class="p-2">Engagement</td>
                        <td class="p-2">200</td>
                    </tr>
                    <tr>
                        <td class="p-2">Conversions</td>
                        <td class="p-2">50</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-gray-700 rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-200 mb-4">Product Performance</h2>
            <div class="graph" id="productsGraph">
                <canvas id="productsCanvas"></canvas>
            </div>
            <table class="w-full mt-4 text-gray-200">
                <thead>
                    <tr class="bg-gray-600">
                        <th class="text-left p-2">Metric</th>
                        <th class="text-left p-2">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2">Total Products</td>
                        <td class="p-2">120</td>
                    </tr>
                    <tr class="bg-gray-600">
                        <td class="p-2">Active Products</td>
                        <td class="p-2">90</td>
                    </tr>
                    <tr>
                        <td class="p-2">Out of Stock</td>
                        <td class="p-2">30</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-gray-700 rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-200 mb-4">Sales Analytics</h2>
            <div class="graph" id="salesGraph">
                <canvas id="salesCanvas"></canvas>
            </div>
            <table class="w-full mt-4 text-gray-200">
                <thead>
                    <tr class="bg-gray-600">
                        <th class="text-left p-2">Metric</th>
                        <th class="text-left p-2">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2">Total Sales</td>
                        <td class="p-2">$15,000</td>
                    </tr>
                    <tr class="bg-gray-600">
                        <td class="p-2">Monthly Sales</td>
                        <td class="p-2">$3,000</td>
                    </tr>
                    <tr>
                        <td class="p-2">Returns</td>
                        <td class="p-2">$500</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/dashboard.js"></script>

<?php require('partial/footer.php'); ?>