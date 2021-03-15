<!DOCTYPE html>
<html lang="en">
<head>
    <script>
      var staff = sessionStorage.getItem('_ud');
      
        console.log("staff",staff)
        if(staff == undefined || staff == null) {
            window.location = 'login/';
        }  
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTORY SYSTEM</title>
    
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
     <link rel="stylesheet" href="assets/css/style.css">
     <link rel="stylesheet" href="assets/css/payment.css">

     <style>
      .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        background: #eaeaea !important;
        color: #28a745 !important;
      }
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
    <?php 
          $rel = './';
          
          // include 'partials/top-nav.php';
          include 'partials/payment-modal.php';
          include 'partials/sale-edit-modal.php';
     ?>
    <div class="jumbotron custom-jumbotron bg-success text-light rounded-0 mb-0">
          <div class="container">
            <h1 class="display-3 ">Ace Supermarket<h1> 
            <h4 class="lead">Stock Inventory System</h4>   
        </div>
    </div>
      <nav style="background: #ddd" class="mb-3">
       <ul class="nav nav-tabs">
         <li class="nav-item">
           <a href="#" class="btn bg-white text-success mr-1 px-5 py-2">Active</a>
         </li>
         <li class="nav-item">
           <a href="#" class="btn bg-white text-success mr-1 px-5 py-2" data-toggle="modal" data-target="#payment">Pay with Card</a>
         </li>
         <li class="nav-item">
           <a href="#" class="btn bg-white text-success mr-1 px-5 py-2" data-toggle="modal" data-target="#payment-by-cash">Pay with Cash</a>
         </li>
       </ul>
      </nav>

<div class="container">
  
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
?>

<script src ="assets/js/jquery.js"></script>
<script src = "assets/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="https://js.paystack.co/v2/popup.js"></script> -->
<script src = "assets/js/Inventory.js"></script>
<script src = "assets/js/main.js"></script>
<script src = "assets/js/payment.js"></script>
<script>

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200){

            var sales = JSON.parse(xhr.response);
            var tbody = document.querySelector('tbody#tab');
            var saleArr = new Array();
            
            for (let i = 0; i < sales.length; i++) {
              const element = sales[i];
              
              // {id, name, price, quantity} = sales[i];
              saleArr = [...saleArr, {
                                        id: element.id, 
                                        name: element.name, 
                                        price: element.price, 
                                        quantity: element.quantity
                                      }];
              

              const id = element['id'];
              
              var editBtn = `<button class="btn btn-sm btn-default btn-primary" 
                              onclick="showSaleEditModal(${id})"
                              data-toggle="modal" data-target="#saleEdit">
                              edit
                            </button>`;

                  tr = document.createElement('tr');
                  

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
                  tdThird.setAttribute('id', `quantity_${id}`);
                  tr.appendChild(tdThird);
                  
              let tdFourth = document.createElement('td'); // Fourth td For Staff name
                  tdFourth.innerHTML = element['fname'] + ' ' + element['lname'];
                  tr.appendChild(tdFourth);
                  
              let tdFifth = document.createElement('td'); // Fifth td For Timestamp
                  tdFifth.innerHTML = element['created_at'];
                  tr.appendChild(tdFifth);
                  
              let tdSixth = document.createElement('td'); // Sixth td For Timestamp
                  tdSixth.innerHTML = editBtn;
                  tr.appendChild(tdSixth);

              tbody.appendChild(tr)
            }
            
            sessionStorage.setItem('mySales', JSON.stringify(saleArr))
        }
    };

    xhr.open("get", `server/api/sales.php?allSales=true&staffId=${staffId}`, true);
    xhr.send(null);

    const showSaleEditModal = (id) => {
      const mySales = JSON.parse(sessionStorage.getItem('mySales'))
      var thisSale = mySales.find(i => i.id == id);
      // console.log("this sale", thisSale)

      document.querySelector('#sale_id').value = thisSale.id;
      document.querySelector('#edit_sold').value = thisSale.name;
      document.querySelector('#edit_qty').value = thisSale.quantity;
    }

    const updateSale = () => {
      const id = document.querySelector('#sale_id').value;
      const qty = document.querySelector('#edit_qty').value;
      
      console.log(`id: ${id}; qty: ${qty}`)
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200){
            const res = JSON.parse(xhr.response);
            if(res.success) {
              document.querySelector('.close').click();
              document.querySelector(`#quantity_${id}`).innerHTML = qty;

            }
        }

        xhr.open("get", `server/api/sales.php?updateSale=true&id=${id}&qty=${qty}`, true);
        xhr.send(null);
      }

  }
</script>
</body>
</html>