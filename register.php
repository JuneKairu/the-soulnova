<?php
include('./class/database.php');
include('./partial/header.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $con->prepare('SELECT COUNT(*) AS count FROM `tbl_users` WHERE username = ?');
    $stmt->execute([$username]);
    $result = $stmt->fetch();

    if ($result['count'] > 0) {
        $error = 'Username already exists. Please choose a different username.';
    } else {
        $stmt = $con->prepare('INSERT INTO `tbl_users` (username, password) VALUES (?, ?)');
        $stmt->execute([$username, $password]);

        header('Location: index.php');
        exit();
    }
}

?>

<div class="flex items-center justify-start min-h-screen bg-gray-800 px-8">
    <div class="max-w-lg w-full p-8">
        <h2 class="text-3xl font-bold text-white mb-4">Register</h2>
        <form action="register.php" method="post" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-200">Username</label>
                <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-700 text-gray-200">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-700 text-gray-200">
            </div>
            <div>
                <input type="submit" value="Register" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            </div>
        </form>
        <?php if (!empty($error)): ?>
            <div class="mt-4 text-center text-red-500"><?= $error ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="flex-none w-1/3 ml-72">
    <h2 class="text-2xl font-bold text-white mb-6">Register as an Administrator!</h2>
    <p class="text-gray-300 mb-6">Are you ready to join our team as an administrator? We're excited to have you on board and empower you with the tools and resources you need to drive success.</p>
    <img src="./images/customer2.png" alt="CRM Image" class="h-auto w-full">
</div>

<?php include('./partial/footer.php'); ?>