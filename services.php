<?php
session_start();
include('partial/header2.php');
include('./class/database.php');

$stmt = $con->query('SELECT s.*, c.id as customerid, c.firstname, c.lastname FROM `tbl_services` s JOIN `tbl_customers` c ON s.customerid = c.id');
$services = $stmt->fetchAll();
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
        <a href="create_serv.php" class="inline-block bg-red-600 text-white font-bold px-4 py-2 rounded hover:bg-red-800">Add New</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-lg">
            <thead class="bg-blue-800 text-white">
                <tr>
                    <th class="w-1/12 px-4 py-2 text-left">ID</th>
                    <th class="w-1/12 px-4 py-2 text-left">Customer ID</th>
                    <th class="w-2/12 px-4 py-2 text-center">Customer</th>
                    <th class="w-2/12 px-4 py-2 text-left">Service Type</th>
                    <th class="w-2/12 px-4 py-2 text-left">Service Date</th>
                    <th class="w-4/12 px-4 py-2 text-left">Description</th>
                    <th class="w-1/12 px-4 py-2 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100 text-gray-800">
                <?php foreach ($services as $row): ?>
                    <tr class="border-b hover:bg-gray-200">
                        <td class="px-4 py-2"><?php echo $row["id"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["customerid"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["firstname"] . ' ' . $row["lastname"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["servicetype"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["servicedate"]; ?></td>
                        <td class="px-4 py-2"><?php echo $row["description"]; ?></td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="view_cus.php?id=<?php echo $row['customerid']; ?>" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">View</a>
                                <a href="update_serv.php?id=<?php echo $row['id']; ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Update</a>
                                <a href="delete_serv.php?id=<?php echo $row['id']; ?>" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require('partial/footer.php'); ?>