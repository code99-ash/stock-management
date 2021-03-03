<?php
$rel = ''; ?>

<!DOCTYPE html>
<html lang="en">
<head>

<script>
  var staff = sessionStorage.getItem('_ud');
  
    console.log("staff",staff)
    if(staff == undefined || staff == null) {
        window.location = '../login/';
    }  
</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTORY SYSTEM</title>
    
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="assets/bootstrap-4.6.0-dist/css/bootstrap.css">
     <link rel="stylesheet" href="assets/css/style.css">

     <style>
       @media print {
        .jumbotron {
          text-align: center;
          color: #000 !important;
        }

         #view-btn, #print-btn, footer {
           display: none;
         }
         
       }
       .dropdown-item{
         cursor:pointer;
       }
     </style>


</head>

<body>
    <?php include 'partials/top-nav.php'; ?>
    <div class="jumbotron custom-jumbotron bg-success text-light rounded-0">
          <div class="container">
            <h1 class="display-3 ">Ace Supermarket<h1> 
            <h4 class="lead">Stock Inventory System</h4>   
        </div>
    </div>

<div class="container">
  <h2 class="display-4 text-muted">Stock Items Summary</h2>
  
  <div class="row">
    <table class="table col-12 mx-auto table-responsive-md table-bordered table-striped">    
      <thead class="thead-info">
        <tr>
          <th>S/N</th>
          <th>Item Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Entered By</th>
          <th>Date</th>
          <th>Actions</th>
          <!-- <th>Total (<del>N</del>)</th> -->
        </tr>
      </thead>
      <tbody id="tab">
        
      </tbody>
    </table>
  </div>
      
  </div>
<?php
include 'partials/footer.php';
include 'partials/scripts.php';
?>

<script src = "assets/js/Inventory.js"></script>
<script src = "assets/js/main.js"></script>

</body>
</html>