<?php
require '../vendor/autoload.php';

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

    if (Sale::create($data)) {
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

    if (Sale::create($data)) {
        try {
            Stock::where('id', $id)->decrement('quantity', $qty);
            $feedback['success'] = true;
            $feedback['message'] = 'New sale has been added successfully';
        } catch (Exception $e) {
            echo $e;
        }
    } else {
        $feedback['success'] = false;
        $feedback['message'] = 'Could not add a new sale';
    }

    echo json_encode($feedback);
}

if (isset($_GET['allSales'])) {

    if (!isset($_GET['staffId'])) {

        $sales = Sale::select(
            'staffs.fname as fname',
            'staffs.lname as lname',
            'stock.name',
            'stock.price',
            'stock.quantity as remain',
            'sales.quantity',
            'sales.amount as total',
            'sales.paid_with',
            'sales.created_at'
        )
            ->join('stock', 'stock.id', 'sales.stock_id')
            ->join('staffs', 'staffs.id', 'sales.signed_by')
            ->orderBy('created_at', 'DESC')
            ->get();

        echo json_encode($sales);

    } else {

        $staffId = $_GET['staffId'];
        $sales = Sale::where('sales.signed_by', $staffId)
            ->select(
                'sales.id',
                'staffs.fname as fname',
                'staffs.lname as lname',
                'stock.name',
                'stock.price',
                'stock.quantity as remain',
                'sales.quantity',
                'sales.amount',
                'sales.paid_with',
                'sales.created_at'
            )
            ->join('stock', 'stock.id', 'sales.stock_id')
            ->join('staffs', 'staffs.id', 'sales.signed_by')
            ->orderBy('created_at', 'DESC')
            ->get();

            echo json_encode($sales);
    }
}

if(isset($_GET['updateSale'])) {
    
    $id = $_GET['id'];
    $qty = $_GET['qty'];

    $data = ['quantity' => $qty];

    
    if(Sale::where('id', $id)->update($data)) 
    {
        $feedback['success'] = true;
        $feedback['message'] = 'item updated successfully';
    }
    else
    {
        $feedback['success'] = false;
        $feedback['message'] = 'item failed to update';
    }

    echo json_encode($feedback);
    
}

?>
