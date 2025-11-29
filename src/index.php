<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixelshop</title>

    <link href="./styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-cyan-100">
    <div class="grid grid-cols-12">
        <div class="col-span-12 md:col-span-9">
            <?php include 'components/navbar.php'; ?>

            <div id="inventoryBody" class="flex flex-row flex-wrap mx-12 mt-8 justify-center">
            </div>
        </div>

        <?php include 'components/shoppingCart.php'; ?>
    </div>

    <script src="scripts/script.js"></script>
    <script src="scripts/loadInventory.js"></script>
    <script>
        $(document).ready(function () {
            loadInventory(search = "", layout = "customer");
        });
    </script>
    <script src="scripts/cartHandler.js"></script>
</body>
</html>