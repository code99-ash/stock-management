<?php
require '../vendor/autoload.php';
$sale = new Sale();


$feedback = [
    'success' => false,
    'message' => '',
];

if (isset($_POST['newSale'])) {
    $clientName = $_POST['clientName'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];
    $stockId = $_POST['stockId'];
    $paidWith = $_POST['paidWith'];
    $paymentRef = $_POST['paymentReference'];
    $transactionId = $_POST['transactionId'];
    $signedBy = $_POST['signedBy'];

    $data = [
        'client_name' => $clientName,
        'email' => $email,
        'stock_id' => $stockId,
        'payment_reference' => $paymentRef,
        'transaction_id' => $transactionId,
        'quantity' => $quantity,
        'amount' => $amount,
        'paid_with' => $paidWith,
        'signed_by' => $signedBy,
    ];

    if (\Sale::create($data)) {
        $feedback['success'] = true;
        $feedback['message'] = 'New sale has been added successfully';
    } else {
        $feedback['success'] = false;
        $feedback['message'] = 'Could not add a new sale';
    }

    echo json_encode($feedback);
}

if (isset($_GET['singleCashSale'])) {
    $id = $_GET['id'];
    $staffId = $_GET['staffId'];
    $price = $_GET['price'];
    $qty = $_GET['qty'];
    $total = $_GET['total'];

    $data = [
        'stock_id' => $id,
        'quantity' => $qty,
        'amount' => $total,
        'signed_by' => $staffId,
    ];

    try {
        $sale->create($data);
        $feedback['success'] = true;
        $feedback['message'] = 'New sale has been added successfully';
        echo json_encode($feedback);
    } catch (Exception $e) {
        echo $e;
    }
    // if(Sale::create($data)) {
    //     $feedback['success'] = true;
    //     $feedback['message'] = 'New sale has been added successfully';
    // } else {
    //     $feedback['success'] = false;
    //     $feedback['message'] = 'Could not add a new sale';
    // }

    // echo json_encode($feedback);
}

?>
