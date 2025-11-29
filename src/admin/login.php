<?php 
session_start();

if(isset($_SESSION['cashier_id'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixelshop - Admin Dashboard</title>

    <link href="../styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-cyan-100">
    <?php include '../components/navbar.php'; ?>

    
    <div class="sm:mx-24 md:mx-48 lg:mx-72 mt-5">
        <button class="ml-5 px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none" onclick="window.location.href='../'">Return to Shopping</button>
        <form onsubmit="loginUser(event)" class="flex flex-col mx-12 mt-5 p-3 rounded-xl bg-amber-50 space-y-3 drop-shadow-lg">
            <h3 class="mt-2 text-center font-semibold text-2xl">
                Admin Login
            </h3>
        
            <div class="flex flex-col">
                <label for="emailField">Email</label>
                <input
                    type="email"
                    id="emailField"
                    name="email"
                    class="px-2 py-1 border"
                    required
                >
            </div>

            <div class="flex flex-col">
                <label for="passwordField">Password</label>
                <input
                    type="password"
                    id="passwordField"
                    name="password"
                    class="px-2 py-1 border"
                    required
                >
            </div>

            <div class="flex mt-3 justify-end">
                <input type="submit" class="px-3 py-1 border-2 border-black rounded-4xl hover:bg-black hover:text-amber-50 duration-150 cursor-pointer select-none" value="Login">
            </div>
        </form>

        <p class="mt-3 text-center">
            Think you have a problem?
            <a href="#" class="text-blue-700 hover:text-blue-900 hover:underline">
                Contact your super-administrators.
            </a>
        </p>
    </div>

    <script src="../scripts/script.js"></script>
    <script src="../scripts/loginCashier.js"></script>
</body>
</html>