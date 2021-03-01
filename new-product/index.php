<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTORY SYSTEM</title>

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="../assets/bootstrap-4.6.0-dist/css/bootstrap.css">

</head>

<body>

  <?php
    include '../partials/top-nav.php';
    include '../partials/lead.php';
   ?>

<h2 class="lead my-3 container text-center" style="font-style: italic;">
  This page is where you enter the details of every goods in your store. Be sure to enter item details here!
</h2>
<div class="container d-flex justify-content-center my-5">
  <fieldset class="border w-75">
    <legend class="border w-75 text-center text-muted display-4" style="font-size: 2.5em;"> Details of Stock Items</legend>
    <form class="container p-5">
      <div class="form-group w-75">
        <label class="h5 text-muted" for="item1">Item Name</label>
        <input type="text" class="form-control" id="item1" placeholder="Enter Item Name" name="email">
      </div>

      <div class="form-group w-75">
        <label class="h5 text-muted" for="price1">Price (<del>N</del>)</label>
        <input type="number" class="form-control" id="price1" placeholder="Enter Price" name="pswd">
      </div>

      <div class="form-group w-75">
        <label class="h5 text-muted" for="qty1">Quantity</label>
        <input type="number" class="form-control" id="qty1" placeholder="Enter Quantity" name="email">
      </div>

      <div class="form-group w-75">
        <label class="h5 text-muted" for="dat1">Date</label>
        <input type="date" class="form-control" id="dat1" placeholder="Enter Date" name="email">
      </div>

      <div class="form-group w-75">
        <label class="h5 text-muted" for="seller1">Data Entry Officer</label>
        <input type="text" class="form-control" id="seller1" placeholder="Enter Your Name" name="email">
      </div>

      <button class="btn btn-success rounded-0 px-3 mr-2" onclick="btn1()">Save Item</button>

      <button onclick="clos()" class="btn btn-danger rounded-0">Reset</button>

      <a href="../inventory/" target="_blank" class="btn btn-info rounded-0" style="float: right;">Preview</a>

    </form>
  </fieldset>
</div>
    
</div> 


<?php
  include '../partials/footer.php';
  include '../partials/scripts.php';
?>

<script src = "../assets/js/Inventory.js"></script>
</body>
</html>