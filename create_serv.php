<?php
session_start();
include('./partial/header2.php');
include('./class/database.php');

try {
    $stmt = $con->query('SELECT id, firstname, lastname FROM `tbl_customers`');
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error fetching customers: ' . $e->getMessage();
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerid = $_POST['customerid'] ?? '';
    $servicetype = $_POST['servicetype'] ?? '';
    $servicedate = $_POST['servicedate'] ?? '';
    $description = $_POST['description'] ?? '';

    if ($customerid && $servicetype && $servicedate && $description) {
        try {
            $stmt = $con->prepare('INSERT INTO `tbl_services` (customerid, servicetype, servicedate, description) VALUES (?, ?, ?, ?)');
            $stmt->execute([$customerid, $servicetype, $servicedate, $description]);
            header('Location: services.php');
            exit();
        } catch (PDOException $e) {
            echo 'Error inserting service: ' . $e->getMessage();
            die();
        }
    } else {
        $error_message = 'Please fill in all required fields.';
    }
}

$customerid = $customerid ?? '';
$servicetype = $servicetype ?? '';
$servicedate = $servicedate ?? '';
$description = $description ?? '';
?>

<div class="container mx-auto px-4 py-8 w-full min-h-screen flex items-center justify-between">
    <div class="max-w-xl mx-auto">
        <div class="bg-gray-700 shadow-md rounded px-8 py-8">
            <h1 class="text-2xl font-bold mb-4 text-white">Create New</h1>
        
            <?php if (isset($error_message)): ?>
            <div class="mb-4 text-red-600"><?php echo $error_message; ?></div>
            <?php endif; ?>
        
            <form action="" method="POST">
                <div class="flex flex-wrap -mx-3 mb-4">
                    <label for="customerid" class="block text-white font-bold mb-2">Customer</label>
                        <select name="customerid" id="customerid" required class="shadow appearance-none border w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Customer</option>
                            <?php foreach ($customers as $customer): ?>
                        <option value="<?php echo htmlspecialchars($customer['id']); ?>"><?php echo htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']); ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex flex-wrap -mx-3 mb-4">
                <label for="servicetype" class="block text-white font-bold mb-2">Service Type</label>
                <input type="text" name="servicetype" id="servicetype" placeholder="Enter service type" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-indigo-500 focus:border-white bg-white text-gray-200" value="<?php echo htmlspecialchars($servicetype); ?>">
            </div>
            <div class="flex flex-wrap -mx-3 mb-4">
                <label for="servicedate" class="block text-gray-700 font-bold mb-2">Service Date</label>
                <input type="date" name="servicedate" id="servicedate" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($servicedate); ?>">
            </div>
            <div class="flex flex-wrap -mx-3 mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" id="description" placeholder="Enter description" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            <div class="flex items-center justify-center -mx-3">
                <button type="submit" name="btn" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php require './partial/footer.php'; ?>