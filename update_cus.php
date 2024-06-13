<?php
session_start();
include('./partial/header2.php');
include('./class/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $username = $_POST['username'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = './uploads/';
        $upload = $_FILES['file'];

        $allowedTypes = array('image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'text/plain', 'application/msword');
        $maxFileSize = 1000000000;

        $fileType = $upload['type'];
        $fileSize = $upload['size'];

        if (in_array($fileType, $allowedTypes) && $fileSize <= $maxFileSize) {
            $stmt = $con->prepare('SELECT upload FROM `tbl_customers` WHERE id = ?');
            $stmt->execute([$id]);
            $customer = $stmt->fetch();
            $currentFilePath = $customer['upload'];

            echo "Current file path: " . $currentFilePath . "<br>";

            if ($currentFilePath && file_exists($currentFilePath)) {
                unlink($currentFilePath);
                echo "Previous file deleted.<br>";
            } else {
                echo "No file found at " . $currentFilePath . "<br>";
            }

            $newFileName = uniqid('', true) . '_' . basename($upload['name']);

            if (move_uploaded_file($upload['tmp_name'], $uploadDir . $newFileName)) {
                $stmt = $con->prepare('UPDATE `tbl_customers` SET firstname=?, lastname=?, username=?, phone=?, address=?, upload=? WHERE id=?');
                $stmt->execute([$firstname, $lastname, $username, $phone, $address, $uploadDir . $newFileName, $id]);
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type or size.";
        }
    } else {
        $stmt = $con->prepare('UPDATE `tbl_customers` SET firstname=?, lastname=?, username=?, phone=?, address=? WHERE id=?');
        $stmt->execute([$firstname, $lastname, $username, $phone, $address, $id]);
    }

    header('Location: customers.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $con->prepare('SELECT * FROM `tbl_customers` WHERE id = ?');
    $stmt->execute([$id]);
    $customer = $stmt->fetch();

    $firstname = $customer['firstname'] ?? '';
    $lastname = $customer['lastname'] ?? '';
    $username = $customer['username'] ?? '';
    $phone = $customer['phone'] ?? '';
    $address = $customer['address'] ?? '';
} else {
    header('Location: customers.php');
    exit();
}
?>

<div class="container mx-auto px-4 py-8 w-full min-h-screen flex items-center justify-between">
    <div class="max-w-xl mx-auto">
        <div class="bg-gray-700 shadow-md rounded px-8 py-8">
            <h1 class="text-2xl font-bold mb-4 text-white">Update</h1>
            <form action="" method="POST" name="frmUpdate" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="flex flex-wrap -mx-3 mb-4">
                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                        <label for="firstname" class="block text-white font-bold mb-2">First Name</label>
                        <input type="text" name="firstname" id="firstname" placeholder="Enter first name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-indigo-500 focus:border-white bg-white text-gray-200" value="<?php echo htmlspecialchars($firstname); ?>">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="lastname" class="block text-gray-700 font-bold mb-2">Last Name</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Enter last name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-indigo-500 focus:border-white bg-white text-gray-200" value="<?php echo htmlspecialchars($lastname); ?>">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-4">
                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                        <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                        <input type="text" name="username" id="username" placeholder="Enter username" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-indigo-500 focus:border-white bg-white text-gray-200" value="<?php echo htmlspecialchars($username); ?>">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="phone" class="block text-gray-700 font-bold mb-2">Phone Number</label>
                        <input type="tel" name="phone" id="phone" placeholder="Enter phone number" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-indigo-500 focus:border-white bg-white text-gray-200" value="<?php echo htmlspecialchars($phone); ?>">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-bold mb-2">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter address" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-indigo-500 focus:border-white bg-white text-gray-200" value="<?php echo htmlspecialchars($address); ?>">
                </div>
                <div class="mb-4">
                    <label for="file" class="block text-white font-bold mb-2">Upload File</label>
                    <div class="relative">
                        <input type="file" name="file" id="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <label for="file" class="flex items-center justify-center bg-indigo-600 text-white font-bold py-2 px-4 rounded cursor-pointer hover:bg-indigo-700 focus:outline-none focus:shadow-outline">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M8 10l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                            Choose a file
                        </label>
                    </div>
                    <p id="file-name" class="mt-2 text-gray-600"></p>
                </div>
                <div class="flex items-center justify-center">
                    <button type="submit" name="btn" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require './partial/footer.php'; ?>