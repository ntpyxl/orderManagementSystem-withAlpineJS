<?php
header('Content-Type: application/json');
require_once 'dbConn.php';

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$formData = $input['data'] ?? '';

if ($action === "addItem") {
    $statement = $pdo->prepare(
        'INSERT INTO inventory (item_name, item_image, price, added_by) VALUES (?, ?, ?, ?)'
    );
    $statement->execute([
        $formData['itemName'],
        $formData['itemImage'],
        $formData['itemPrice'],
        $_SESSION['cashier_id']
    ]);

    echo json_encode(['success' => true]);
    exit;
}

if (isset($_POST['action']) && $_POST['action'] === 'uploadItemImage') {
    if (!empty($_FILES['itemImage']['tmp_name'])) {
        $fileName = $_FILES['itemImage']['name'];
        $tempName = $_FILES['itemImage']['tmp_name'];
        $fileFormat = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueID = sha1(md5(rand(1, 9999999)));
        $newFileName = $uniqueID . "." . $fileFormat;

        $imagesDirectory = "../images/";
        $targetPath = $imagesDirectory . $newFileName;

        if (move_uploaded_file($tempName, $targetPath)) {
            echo json_encode([
                'success' => true,
                'fileName' => $newFileName
            ]);
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Upload failed.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No file received.']);
    }
    exit;
}


if($action == "getInventoryItems") {
    $search = '%' . ($input['search'] ?? '') . '%';
    $statement = $pdo->prepare(
        'SELECT * FROM inventory ORDER BY item_name ASC'
    );
    $statement->execute();
    $inventoryItems = $statement->fetchAll();

    echo json_encode(['success' => true, 'data' => $inventoryItems]);
}