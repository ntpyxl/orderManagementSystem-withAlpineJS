<?php
header('Content-Type: application/json');
require_once 'dbConn.php';

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$formData = $input['data'] ?? '';

if ($action === "addCashier") {
    if($formData['password'] !== $formData['confirmPassword']) {
        echo json_encode(['success' => false, 'message' => "Password does not match!"]);
        exit;
    }

    $hashedPassword = password_hash($formData['password'], PASSWORD_DEFAULT);

    $statement = $pdo->prepare(
        'INSERT INTO cashier (first_name, last_name, user_email, user_password, user_role, contact_number)
        VALUES (?, ?, ?, ?, ?, ?)'
    );
    $statement->execute([
        $formData['firstName'],
        $formData['lastName'],
        $formData['email'],
        $hashedPassword,
        $formData['userRole'],
        $formData['contactNumber']
    ]);

    echo json_encode(['success' => true]);
    exit;
}

if($action == "loginCashier") {
    $statement = $pdo->prepare('SELECT * FROM cashier WHERE user_email = ?');

    $statement->execute([$formData['email']]);
    $userData = $statement->fetch();

    // email check
    if($userData === false) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Email is not registered.']);
        exit;
    }

    // password check
    if(!password_verify($formData['password'], $userData['user_password'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
        exit;
    }

    // account status check
    if($userData['user_status'] === 'suspended') {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Account is suspended.']);
        exit;
    }

    $_SESSION['cashier_id'] = $userData['cashier_id'];
    $_SESSION['first_name'] = $userData['first_name'];
    $_SESSION['user_role'] = $userData['user_role'];

    echo json_encode(['success' => true]);
}

if($action == "getCashiers") {
    $search = '%' . ($input['search'] ?? '') . '%';
    $statement = $pdo->prepare(
        'SELECT 
            cashier_id,
            first_name, last_name,
            user_email, user_role, user_status,
            contact_number,
            date_added
        FROM cashier ORDER BY cashier_id ASC'
    );
    $statement->execute();
    $inventoryItems = $statement->fetchAll();

    echo json_encode(['success' => true, 'data' => $inventoryItems]);
}

if($action == "getCashierById") {
    $statement = $pdo->prepare(
        'SELECT 
            cashier_id,
            first_name, last_name,
            user_email, user_role, user_status,
            contact_number,
            date_added
        FROM cashier WHERE cashier_id = ?'
    );
    $statement->execute([$formData['cashier_id']]);
    $cashierData = $statement->fetch();

    echo json_encode(['success' => true, 'data' => $cashierData]);
}

if($action == "changeCashierStatus") {
    if($formData['new_cashier_status'] === "suspend") {
        $formData['new_cashier_status'] = "suspended";
    } else if($formData['new_cashier_status'] === "unsuspend") {
        $formData['new_cashier_status'] = "normal";
    }

    $statement = $pdo->prepare(
        'UPDATE cashier
        SET
            user_status = ? 
        WHERE cashier_id = ?'
    );
    $statement->execute([$formData['new_cashier_status'], $formData['cashier_id']]);
    $cashierData = $statement->fetch();

    echo json_encode(['success' => true]);
}