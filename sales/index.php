<?php
$rel = '../'; ?>

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
     <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
     <link rel="stylesheet" href="../assets/css/style.css">
     <link rel="stylesheet" href="../assets/css/modal.css">

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
       element.style, .progress-bar {
           height: auto !important;
       }
       .print {
           box-shadow: none !important;
       }
     </style>


</head>

<body>
  

  <!-- Edit modal -->
  <?php include '../partials/edit-modal.php'; ?>

  <!-- Delete modal -->
  <?php include '../partials/delete-modal.php'; ?>
  

  <?php include '../partials/top-nav.php'; ?>

    <div class="jumbotron custom-jumbotron bg-info text-light rounded-0">
        
          <div class="container">
            <h1 class="display-3 ">Ace Supermarket<h1> 
            <h3>Sales from Stock</h3>   
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <div class="col-12">
                            <button class="btn btn-default p-0 mb-3 print float-right" style="width: 80px; height: 50px" onclick="printIt()">
                                <div class="progress h-100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="button"
                                        style="width: 100%;">PRINT</div>
                                </div>
                            </button>
                    </div>
                </div> 
                
                <div class="row">
                    <table class="table col-12 mx-auto table-responsive-md table-bordered table-striped">    
                    <thead class="thead-info">
                        <tr>
                        <th>S/N</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remaining</th>
                        <th>Paid With</th>
                        <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody id="tab">
                        
                    </tbody>
                    </table>
                </div>

                <h3 class="display-4 text-success" style="float: right; font-size: 2.5em;"  id="grand1"></h3>
        </div>
        </div>
    </div>

<?php
include '../partials/footer.php';
?>

<script src = "../assets/js/jquery.js"></script>
<script src = "../assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src = "../assets/bootstrap/js/bootstrap.js"></script>
<script src = "../assets/js/Inventory.js"></script>
<script src = "../assets/js/main.js"></script>

<script>
 console.log(window)

  window.onload = function() {
    getData();
  }

  function getData() {
    
    var xhr = new XMLHttpRequest();
    var tbody = document.querySelector('tbody#tab');

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200){
            var sales = JSON.parse(xhr.response);
            console.log("sales",sales);

            for (let i = 0; i < sales.length; i++) {
              const element = sales[i];
              
              var tr = document.createElement('tr');

              let tdZero = document.createElement('td'); // Zero td For item Name
                  tdZero.innerHTML = i + 1;
                  tr.appendChild(tdZero);
  
              let tdFirst = document.createElement('td'); // First td For item Name
                  tdFirst.innerHTML = element['name'];
                  tr.appendChild(tdFirst);
                  
              let tdSecond = document.createElement('td'); // Second td For Price
                  tdSecond.innerHTML = element['price'];
                  tr.appendChild(tdSecond);
                  
              let tdThird = document.createElement('td'); // Third td For Quantity
                  tdThird.innerHTML = element['quantity'];
                  tr.appendChild(tdThird);
                  
              let tdFourth = document.createElement('td'); // Fourth td For Total
                  tdFourth.innerHTML = element['total'];
                  tr.appendChild(tdFourth);

                  
              let tdFifth = document.createElement('td'); // Fifth td For Remaining
                  tdFifth.innerHTML = element['remain'];
                  tr.appendChild(tdFifth);
                  
              let tdSixth = document.createElement('td'); // Sixth td For Payment mode
                  tdSixth.innerHTML = element['paid_with'];
                  tr.appendChild(tdSixth);
                  
              let tdSeventh = document.createElement('td'); // Seventh td For Timestamp
                  tdSeventh.innerHTML = element['created_at'];
                  tr.appendChild(tdSeventh);
                  
                  tbody.appendChild(tr)
            }

            }
        }

        xhr.open("get", `../server/api/sales.php?allSales=true`, true);
        xhr.send(null);
    };



    </script>

</body>
</html>