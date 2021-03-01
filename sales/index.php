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
     <link rel="stylesheet" href="../assets/bootstrap-4.6.0-dist/css/bootstrap.css">
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
                        <th>Revenue</th>
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
include '../partials/scripts.php';
?>

<script src = "../assets/js/Inventory.js"></script>
<script src = "../assets/js/main.js"></script>

<script>
 console.log(window)

  window.onload = function() {
    getData();
  }

  function getData() {
    
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200){
            let arr = xhr.response;
            if(arr.length > 0) {
              // console.log(arr)
              createTableRows(JSON.parse(arr))
            }
        }
    };

    xhr.open("post", '../server/api/stocks.php?allStocks=true', true);
    xhr.send(null);
  }


  function createTableRows(data) {
      let tbody = document.querySelector('tbody');
      var tr = null;
      var td = null
      // console.log(data.length)
      let arr = [];
      for(var i=0; i < data.length; i++) {
         tr = document.createElement('tr');

        let fullName = `${data[i].fname} ${data[i].lname}`;
        let id = data[i].id;


         var dropDown = `<div class="nav-item dropdown">
                            <a class="text-info dropdown-toggle" href="#" id="more${i}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">more</a>
                            <div class="dropdown-menu" aria-labelledby="more${i}">
                              <a class="dropdown-item text-info" onclick="showEditModal(${id})" data-toggle="modal" data-target="#editModal">Edit</a>
                              <a class="dropdown-item text-danger" onclick="showDeleteModal(${id})" data-toggle="modal" data-target="#deleteModal">Delete</a>
                            </div>
                        </div>`;
          
          
                        
                        let  myArr = [
                        i+1, 
                        data[i].name, 
                        data[i].price, 
                        data[i].quantity, 
                        parseFloat(data[i].price) * data[i].quantity,
                        "0.00"
                      ]
                      arr = [...arr, myArr];
                      
                      for(let j=0; j < myArr.length; j++) {
                        td = document.createElement('td');
                        td.innerHTML =  myArr[j];
                        
              tr.appendChild(td);
              
            }
            
            tbody.appendChild(tr);
          }
        }

    </script>

</body>
</html>