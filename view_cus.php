<?php
session_start();
include('partial/header2.php');
include('./class/database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $con->prepare('SELECT * FROM `tbl_customers` WHERE id = ?');
    $stmt->execute([$id]);
    $customer = $stmt->fetch();

    if (!$customer) {
        header('Location: error.php');
        exit();
    }

    $stmt = $con->prepare('SELECT * FROM `tbl_services` WHERE customerid = ? ORDER BY servicedate DESC');
    $stmt->execute([$id]);
    $services = $stmt->fetchAll();
} else {
    header('Location: error.php');
    exit();
}
?>

<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4 text-white">View Records</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="mb-6">
            <h2 class="text-xl font-bold mb-2">Customer Details</h2>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($customer['id']); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($customer['firstname']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($customer['lastname']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($customer['username']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer['phone']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($customer['address']); ?></p>
            
            <div class="mt-4">
                <strong>Uploaded File:</strong>
                <?php if (!empty($customer['upload'])): ?>
                    <?php 
                    $filePath = htmlspecialchars($customer['upload']);
                    if (file_exists($filePath)) {
                        echo "<a href='$filePath' class='text-blue-600' target='_blank'>View File</a>";
                    } else {
                        echo "<p class='text-red-600'>File not found.</p>";
                    }
                    ?>
                <?php else: ?>
                    <p>No file uploaded</p>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-2">Services</h2>
            <?php if (count($services) > 0): ?>
                <ul class="space-y-4">
                    <?php foreach ($services as $service): ?>
                        <li class="bg-gray-100 p-4 rounded shadow-md">
                            <p><strong>Service Type:</strong> <?php echo htmlspecialchars($service['servicetype']); ?></p>
                            <p><strong>Service Date:</strong> <?php echo htmlspecialchars($service['servicedate']); ?></p>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($service['description']); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No services found for this customer.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require('partial/footer.php'); ?>