<?php
session_start();
include('partial/header2.php');
include('./class/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $customerid = $_POST['customerid'] ?? '';
    $servicetype = $_POST['servicetype'] ?? '';
    $servicedate = $_POST['servicedate'] ?? '';
    $description = $_POST['description'] ?? '';

    $stmt = $con->prepare('UPDATE `tbl_services` SET customerid=?, servicetype=?, servicedate=?, description=? WHERE id=?');
    $stmt->execute([$customerid, $servicetype, $servicedate, $description, $id]);

    header('Location: services.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $con->prepare('SELECT * FROM `tbl_services` WHERE id = ?');
    $stmt->execute([$id]);
    $service = $stmt->fetch();

    $customersStmt = $con->query('SELECT * FROM `tbl_customers`');
    $customers = $customersStmt->fetchAll();

    $customerid = $service['customerid'] ?? '';
    $servicetype = $service['servicetype'] ?? '';
    $servicedate = $service['servicedate'] ?? '';
    $description = $service['description'] ?? '';
} else {
    header('Location: services.php');
    exit();
}
?>

<div class="container mx-auto px-4 py-8 w-full min-h-screen flex items-center justify-between">
    <div class="max-w-xl mx-auto">
        <div class="bg-gray-700 shadow-md rounded px-8 py-8">
            <h1 class="text-2xl font-bold mb-4 text-white">UPDATE</h1>
            <form action="" method="POST" name="frmUpdate">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="flex flex-wrap -mx-3 mb-4">
                    <label for="customerid" class="block text-white font-bold mb-2">Customer</label>
                    <select name="customerid" id="customerid" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?php echo $customer['id']; ?>" <?php if ($customerid == $customer['id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex flex-wrap -mx-3 mb-4">
                    <label for="servicetype" class="block text-white font-bold mb-2">Service Type</label>
                    <input type="text" name="servicetype" id="servicetype" placeholder="Enter service type" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-indigo-500 focus:border-white bg-white text-gray-200" value="<?php echo htmlspecialchars($servicetype); ?>">
                </div>
                <div class="flex flex-wrap -mx-3 mb-4">
                    <label for="servicedate" class="block text-white font-bold mb-2">Service Date</label>
                    <input type="date" name="servicedate" id="servicedate" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-indigo-500 focus:border-white bg-white text-gray-200" value="<?php echo htmlspecialchars($servicedate); ?>">
                </div>
                <div class="flex flex-wrap -mx-3 mb-4">
                    <label for="description" class="block text-white font-bold mb-2">Description</label>
                    <textarea name="description" id="description" placeholder="Enter description" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-indigo-500 focus:border-white bg-white text-gray-200"><?php echo htmlspecialchars($description); ?></textarea>
                </div>
                <div class="flex flex-wrap items-center justify-center -mx-3">
                    <button type="submit" name="btn" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require './partial/footer.php'; ?>