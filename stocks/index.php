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
     </style>


</head>

<body>
  

  <!-- Edit modal -->
  <?php include '../partials/edit-modal.php'; ?>

  <!-- Delete modal -->
  <?php include '../partials/delete-modal.php'; ?>
  

  <?php include '../partials/top-nav.php'; ?>

    <div class="jumbotron custom-jumbotron bg-success text-light rounded-0">
          <div class="container">
            <h1 class="display-3 ">Ace Supermarket<h1> 
            <h4 class="lead">Stock Inventory System</h4>   
        </div>
    </div>

<div class="container">
  <h2 class="display-4 text-muted">Stock Items Summary</h2>
  <!-- <p>
    <button onclick="viewStore()" class="btn btn-success rounded-0" id="view-btn">View Saved Item</button> 
  </p> -->
  
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
  
    <h3 class="display-4 text-success" style="float: right; font-size: 2.5em;"  id=grand1></h3>
      
    <button onclick="printIt()" id="print-btn" class="btn btn-primary rounded-0 px-3 shadow-md mt-5" onclick="btn2()">Print</button><br>
  
  </div>
<?php
include '../partials/footer.php';
?>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/bootstrap/js/bootstrap.js"></script>
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
        let id = data[i].id;

        tr = document.createElement('tr');
        tr.setAttribute('id', `tr_${id}`);

        let fullName = `${data[i].fname} ${data[i].lname}`;


         var dropDown = `<div class="nav-item dropdown">
                            <a class="text-info dropdown-toggle" href="#" id="more${i}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">more</a>
                            <div class="dropdown-menu" aria-labelledby="more${i}">
                              <a class="dropdown-item text-info" onclick="showEditModal(${id})" data-toggle="modal" data-target="#editModal">Edit</a>
                              <a class="dropdown-item text-danger" onclick="showDeleteModal(${id})" data-toggle="modal" data-target="#deleteModal">Delete</a>
                            </div>
                        </div>`;
          
          
                        
                        let  myArr = [
                        ['S/N', i+1], 
                        ['name', data[i].name], 
                        ['price', data[i].price], 
                        ['quantity', data[i].quantity], 
                        ['fullName', fullName] , 
                        ['date', data[i].created_at],
                        ['option', dropDown]
                      ]
                      arr = [...arr, myArr];
                      
                      for(let j=0; j < myArr.length; j++) {
                        td = document.createElement('td');

                        td.innerHTML =  myArr[j][1];
                        td.setAttribute('id',  `td_${myArr[j][0]}_${id}`); // Set class name for each

                      tr.appendChild(td);
              
            }
            
            tbody.appendChild(tr);
          }
        }
      function editModalDetails(stockDetails){
        document.querySelector('.modal-title').innerText = `Edit ${stockDetails.name} Info`
        document.querySelector('#id').value = stockDetails.id
        document.querySelector('#qty').value = stockDetails.quantity
        document.querySelector('#price').value = stockDetails.price

      }

      function showEditModal(id){
          var xhr = new XMLHttpRequest();

          xhr.onreadystatechange = () => {
              if (xhr.readyState == 4 && xhr.status == 200){
                let stockDetails = xhr.response;
                if(stockDetails) {
                    editModalDetails(JSON.parse(stockDetails))
                  }
                }
              };

          xhr.open("post", `../server/api/stocks.php?findStocks=true&id=${id}`, true);
          xhr.send(null);
        }
        
        function update(qty, price){
        let id = document.querySelector('#id').value;
        
        var xhr = new XMLHttpRequest();
        let updatedBy = JSON.parse(sessionStorage.getItem('_ud')).id
        
        xhr.onreadystatechange = () => {
          if (xhr.readyState == 4 && xhr.status == 200){
            if(JSON.parse(xhr.response).status){
              
              let res = JSON.parse(xhr.response);
              
              let id = res.id;
              let price = res.price;
              let qty = res.quantity;
              
              document.querySelector(`#td_price_${id}`).innerHTML = price;

              document.querySelector(`#td_quantity_${id}`).innerHTML = qty;

              document.querySelector('.closeBtn').click()
              
            }
          }
        };

        xhr.open("post", `../server/api/stocks.php?updateStock=true&id=${id}&qty=${qty}&price=${price}&updatedBy=${updatedBy}`, true);
        xhr.send(null);
      }


      function showDeleteModal(id){
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200){
                let stockDetails = JSON.parse(xhr.response);
                console.log(stockDetails)
                if(stockDetails) {
                  document.querySelector('.delete-modal-title').innerText = `Delete ${stockDetails.name} from stock`
                  document.querySelector('#itemId').value = id
                }
            }
        };

        xhr.open("post", `../server/api/stocks.php?findStocks=true&id=${id}`, true);
        xhr.send(null);
      }

      function deleteItem(){
        let id = document.querySelector('#itemId').value;
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200){
                if(JSON.parse(xhr.response).status){
                  document.querySelector('#tab').innerHTML = ""
                  document.querySelector('.deleteCloseBtn').click()
                  getData();
                }
            }
        };

        xhr.open("post", `../server/api/stocks.php?deleteItem=true&id=${id}`, true);
        xhr.send(null);
      }
      </script>

</body>
</html>