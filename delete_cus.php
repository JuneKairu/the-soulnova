<?php
include('./partial/header2.php');
include('./class/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $con->prepare('SELECT * FROM `tbl_customers` WHERE id = ?');
    $stmt->execute([$id]);
    $customer = $stmt->fetch();

    if ($customer) {
?>
        <div class="container mx-auto flex justify-center items-center h-screen">
            <div class="content bg-white rounded-lg shadow-md p-8 max-w-md mx-auto">
                <h1 class="font-poppins text-2xl font-semibold mb-4 text-black">Delete Customer</h1>
                <p class="font-poppins text-black mb-4">Are you sure you want to delete the following customer?</p>
                <p class="font-poppins text-black mb-4">ID: <?= $customer['id'] ?></p>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $customer['id'] ?>">
                    <div class="flex justify-center">
                        <button type="submit" name="confirm" class="font-poppins bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-800 mr-2">Confirm Delete</button>
                        <a href="customers.php" class="font-poppins bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-800 ml-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        header('Location: customers.php');
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
    $id = $_POST['id'];

    $stmt = $con->prepare('DELETE FROM `tbl_customers` WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: customers.php');
    exit();
} else {
    header('Location: customers.php');
    exit();
}
?>