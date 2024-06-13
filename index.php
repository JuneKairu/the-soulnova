<?php
session_start();
include('./class/database.php');
include('./partial/header.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $con->prepare('SELECT * FROM `tbl_users` WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            header('Location: home.php');
            exit();
        } else {
            $error = 'Invalid password';
        }
    } else {
        $error = 'Account does not exist';
    }
}
?>

<div class="flex items-center justify-between min-h-screen bg-gray-800 px-8">
    <div class="max-w-md w-full p-8">
        <h2 class="text-3xl font-bold text-white mb-6">Login</h2>
        <form action="home.php" method="post" class="space-y-6">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-200">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username" required class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-700 text-gray-200">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required class="w-full px-4 py-2 mt-1 border border-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-700 text-gray-200">
            </div>
            <div>
                <input type="submit" value="Login" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            </div>
            <div class="text-center">
                <a href="register.php" class="inline-block w-full bg-red-600 text-white font-bold py-2 px-4 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Create Account</a>
            </div>
        </form>
        <?php if (!empty($error)): ?>
            <p class="mt-4 text-center text-red-500"><?= $error ?></p>
        <?php endif; ?>
    </div>
</div>

<div class="flex-none w-1/3 ml-72">
    <h2 class="text-2xl font-bold text-white mb-6">Welcome back, Administrator!</h2>
    <p class="text-gray-300 mb-6">We're delighted to have you back on board! As an administrator, you play a crucial role in shaping the success of our CRM system and driving organizational growth.</p>
    <img src="./images/customer.png" alt="CRM Image" class="h-auto w-full">
</div>

<?php include('./partial/footer.php'); ?>