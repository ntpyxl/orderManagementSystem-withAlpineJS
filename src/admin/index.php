<?php 
session_start();

if(!isset($_SESSION['cashier_id'])) {
    header("Location: login.php");
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

    <div class="mx-5 mt-5">
        <div class="space-x-1 print:hidden">
            <button id="inventoryNavButton" onclick="showComponent(event, 'inventory')" class="px-3 py-1 bg-amber-50 hover:bg-amber-50 duration-150 cursor-pointer select-none">Inventory</button>
            <button id="cashiersNavButton" onclick="showComponent(event, 'cashiers')" class="px-3 py-1 bg-amber-200 hover:bg-amber-50 duration-150 cursor-pointer select-none">Cashiers</button>
            <button id="transactionsNavButton" onclick="showComponent(event, 'transactions')" class="px-3 py-1 bg-amber-200 hover:bg-amber-50 duration-150 cursor-pointer select-none">Transactions</button>
        </div>
        <div id="mainSection" class="bg-amber-50">
            <span class="inventoryComponent"><?php include 'components/inventory.php'; ?></span>
            <span class="cashiersComponent hidden"><?php include 'components/cashiersManagement.php'; ?></span>
            <span class="transactionsComponent hidden"><?php include 'components/transactionHistory.php'; ?></span>
        </div>
    </div>
    
    <span class="inventoryComponent"><?php include 'components/addItemModal.php'; ?></span>
    <span class="cashiersComponent"><?php include 'components/addCashierModal.php'; ?></span>

    <script src="../scripts/script.js"></script>
    <script>
        const CURRENT_CASHIER_ID = "<?= $_SESSION['cashier_id']?>";
        const CURRENT_USER_ROLE = "<?= $_SESSION['user_role']?>";
    </script>
    <script src="../scripts/adminComponentHandler.js"></script>
    <script src="../scripts/manageInventory.js"></script>
    <script src="../scripts/manageCashiers.js"></script>
</body>
</html>