<?php
require '../vendor/autoload.php';

if (isset($_GET['newStock'])) {
    $name = $_GET['name'];
    $price = $_GET['price'];
    $qty = $_GET['qty'];

    $check = Stock::where('name', $name)->get();

    if (count($check) > 0) {
        echo 'Item name already Exist';
    } else {
        if (
            Stock::create([
                'name' => $name,
                'price' => $price,
                'quantity' => $qty,
                'added_by' => 1,
                'updated_by' => 1,
            ])
        ) {
            echo 'New Stock was added Successfully';
        } else {
            echo 'Failed to add new stock';
        }
    }
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
        echo json_encode(['status' => true, 'message' => 'Update Successful']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to update']);
    }
}


if (isset($_GET['deleteItem'])) {
    $id = $_GET['id'];

    if (Stock::where('id', $id)->delete()) {
        echo json_encode(['status' => true, 'message' => 'Delete Successful']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to delete']);
    }
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
        ->join('staffs', 'added_by', '=', 'staffs.id')
        ->get();

    echo json_encode($stocks);
}
