<?php
require '../vendor/autoload.php';


$feedback = array(
    'success' => false,
    'message' => '' 
);


if (isset($_GET['newStock'])) {
    $name = $_GET['name'];
    $price = $_GET['price'];
    $qty = $_GET['qty'];
    $userId = $_GET['userId'];


    $check = Stock::where('name', $name)->get();

    $data = [
        'name'          => $name,
        'price'         => $price,
        'quantity'      => $qty,
        'added_by'      => $userId,
        'updated_by'    => $userId,
    ];

    if (count($check) > 0) {
        $feedback['success'] = false;
        $feedback['message'] = 'Item name already Exist';
    } else {
        if (Stock::create($data)) {
            $feedback['success'] = true;
            $feedback['message'] = 'New Stock was added Successfully';
        } else {
            $feedback['success'] = false;
            $feedback['message'] = 'Failed to add new stock';
        }
    }

    echo json_encode($feedback);

}

if (isset($_GET['updateStock'])) {
    $id = $_GET['id'];
    $price = $_GET['price'];
    $qty = $_GET['qty'];
    $updatedBy = $_GET['updatedBy'];

    $data = [
        'price' => $price,
        'quantity' => $qty,
        'updated_by' => $updatedBy,
    ];

    if (Stock::where('id', $id)->update($data)) {
        echo json_encode([
            'status' => true, 
            'message' => 'Update Successful',
            'id' => $id,
            'price' => $price,
            'quantity' => $qty
            ]);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to update']);
    }
}


if (isset($_GET['deleteItem'])) {
    $id = $_GET['id'];

    if (Stock::where('id', $id)->delete()) {
        $feedback['success'] = true;
        $feedback['message'] = 'Deleted Successfully';
    } else {
        $feedback['success'] = false;
        $feedback['message'] = 'Failed to delete';
    }

    echo json_encode($feedback);
}

if (isset($_GET['findStocks'])) {
    $id = $_GET['id'];
    $stock = Stock::where('id', $id)
                    ->get()
                    ->first();
                    
    echo json_encode($stock);
}

if (isset($_GET['allStocks'])) {
    $stocks = Stock::select(
        'stock.id as id',
        'stock.name as name',
        'stock.price as price',
        'stock.quantity as quantity',
        'staffs.fname as fname',
        'staffs.lname as lname',
        'stock.created_at as created_at'
    )
        ->orderBy('stock.updated_at', 'DESC')
        ->join('staffs', 'added_by', '=', 'staffs.id')
        ->get();

    echo json_encode($stocks);
}
