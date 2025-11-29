<?php
header('Content-Type: application/json');
require_once 'dbConn.php';

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$formData = $input['data'] ?? '';

if ($action === "checkOutCart") {
    $statement = $pdo->prepare(
        'INSERT INTO transactions (item_id, item_quantity) VALUES (?, ?)'
    );

    foreach($formData as $item) {
        $statement->execute([
            $item['itemId'],
            $item['itemQuantity']
        ]);
    }

    echo json_encode(['success' => true]);
}

if ($action === "getTransactionHistory") {
    $query = "
        SELECT
            transactions.transaction_id,
            transactions.item_id,
            inventory.item_name,
            inventory.price,
            transactions.item_quantity,
            transactions.date_transacted
        FROM transactions
        JOIN inventory ON transactions.item_id = inventory.item_id
        WHERE 1=1
    ";

    $params = [];

    if (!empty($formData["start_date_sort"])) {
        $query .= " AND date_transacted >= ?";
        $params[] = $formData["start_date_sort"];
    }

    if (!empty($formData["end_date_sort"])) {
        $query .= " AND date_transacted <= ?";
        $params[] = $formData["end_date_sort"];
    }

    $query .= " ORDER BY date_transacted ASC";

    $statement = $pdo->prepare($query);
    $statement->execute($params);
    $transactionHistory = $statement->fetchAll();

    echo json_encode(['success' => true, 'data' => $transactionHistory]);
}
