<?php
session_start();
include('partial/header2.php');
include('./class/database.php');

$stmt = $con->query('SELECT * FROM `tbl_customers`');
$customers = $stmt->fetchAll();
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
    <div class="flex justify-between items-center mb-4">
        <a href="create_cus.php" class="inline-block bg-red-600 text-white font-bold px-4 py-2 rounded hover:bg-red-800">Add New</a>
        <h1 class="text-3xl font-bold text-gray-800">Customer Records</h1>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-lg">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="w-1/12 px-4 py-2 text-left">ID</th>
                    <th class="w-2/12 px-4 py-2 text-left">First Name</th>
                    <th class="w-2/12 px-4 py-2 text-left">Last Name</th>
                    <th class="w-2/12 px-4 py-2 text-left">Username</th>
                    <th class="w-2/12 px-4 py-2 text-left">Phone</th>
                    <th class="w-2/12 px-4 py-2 text-left">Address</th>
                    <th class="w-1/12 px-4 py-2 text-left">Uploaded File</th>
                    <th class="w-1/12 px-4 py-2 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100 text-gray-800">
                <?php foreach ($customers as $row): ?>
                    <tr class="border-b hover:bg-gray-200">
                        <td class="px-4 py-2"><?php echo $row["id"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["firstname"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["lastname"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["username"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["phone"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["address"]; ?></td>
                        <td class="px-4 py-2">
                            <?php 
                            if (!empty($row["upload"])) {
                                echo "File Attached";
                            } else {
                                echo "No file uploaded";
                            }
                            ?>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="view_cus.php?id=<?php echo $row['id']; ?>" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">View</a>
                                <a href="update_cus.php?id=<?php echo $row['id']; ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Update</a>
                                <a href="delete_cus.php?id=<?php echo $row['id']; ?>" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require('partial/footer.php'); ?>