<?php
session_start();

if (!isset($_SESSION['cashier_id'])) {
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
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-cyan-100">
    <?php include '../components/navbar.php'; ?>

    <div
        x-data="adminSections()"
        class="mx-5 mt-5">
        <div class="space-x-1 print:hidden">
            <button
                @click="activeSection = 'inventory'"
                class="px-3 py-1 bg-amber-50 hover:bg-amber-50 duration-150 cursor-pointer select-none"
                :class="activeSection === 'inventory' ? 'bg-amber-50' : 'bg-amber-200'">
                Inventory
            </button>

            <button
                @click="activeSection = 'cashiers'"
                class="px-3 py-1 bg-amber-50 hover:bg-amber-50 duration-150 cursor-pointer select-none"
                :class="activeSection === 'cashiers' ? 'bg-amber-50' : 'bg-amber-200'">
                Cashiers
            </button>

            <button
                @click="activeSection = 'transactions'"
                class="px-3 py-1 bg-amber-50 hover:bg-amber-50 duration-150 cursor-pointer select-none"
                :class="activeSection === 'transactions' ? 'bg-amber-50' : 'bg-amber-200'">
                Transactions
            </button>
        </div>

        <div id="mainSection" class="bg-amber-50">
            <span
                x-data="inventoryComponent()"
                x-show="activeSection === 'inventory'"
                x-transition:enter.duration.300ms
                x-transition:leave.duration.0ms>
                <?php include 'components/inventory.php'; ?>
            </span>

            <span
                x-data="cashierComponent()"
                x-show="activeSection === 'cashiers'"
                x-transition:enter.duration.300ms
                x-transition:leave.duration.0ms>
                <?php include 'components/cashiersManagement.php'; ?>
            </span>

            <span
                x-data="transactionComponent()"
                x-show=" activeSection==='transactions'"
                x-transition:enter.duration.300ms
                x-transition:leave.duration.0ms>
                <?php include 'components/transactionHistory.php'; ?>
            </span>
        </div>
    </div>

    <script src="../scripts/script.js"></script>
    <script>
        const CURRENT_CASHIER_ID = "<?= $_SESSION['cashier_id'] ?>";
        const CURRENT_USER_ROLE = "<?= $_SESSION['user_role'] ?>";

        function adminSections() {
            return {
                activeSection: 'inventory' // default active section
            }
        }
    </script>
    <script src="../scripts/addItemModalHandler.js"></script>
    <script src="../scripts/addCashierModalHandler.js"></script>
    <script src="../scripts/inventoryComponent.js"></script>
    <script src="../scripts/cashierComponent.js"></script>
    <script src="../scripts/transactionComponent.js"></script>
</body>

</html>