<?php
session_start();
include('partial/header2.php');
include('./class/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = './uploads/';
    $upload = $_FILES['file'];
    $id = $_GET['id'];

    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'text/plain', 'application/msword');
    $maxFileSize = 1000000000;

    $fileType = $upload['type'];
    $fileSize = $upload['size'];

    if (in_array($fileType, $allowedTypes) && $fileSize <= $maxFileSize) {
        $newFileName = uniqid('', true) . '_' . $upload['name'];

        if (move_uploaded_file($upload['tmp_name'], $uploadDir . $newFileName)) {
            $stmt = $con->prepare('INSERT INTO `tbl_customers` (id, upload) VALUES (?, ?)');
            $stmt->execute([$id, $uploadDir . $newFileName]);
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Invalid file type or size.";
    }
}
?>

<div class="flex items-center justify-center h-screen">
    <div class="content bg-white rounded-lg shadow-md p-8 mx-auto max-w-md w-full">
        <h1 class="font-poppins text-3xl font-bold mb-4 text-gray-800 text-center">Upload File</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-6">
                <label for="file" class="font-poppins block mb-2 text-lg text-gray-800">Choose File:</label>
                <label for="file" class="flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md border border-gray-300 cursor-pointer transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Browse
                    <input type="file" name="file" id="file" class="hidden" required>
                </label>
            </div>
            <button type="submit" class="font-poppins bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-900 focus:outline-none focus:bg-gray-900 w-full">Upload</button>
        </form>
    </div>
</div>

<?php require('partial/footer.php'); ?>