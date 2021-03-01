<?php
$rel = '../../'; ?>
<!DOCTYPE html>
<html lang="en">
<head>

<script>
  var staff = sessionStorage.getItem('_ud');
  
    console.log("staff",staff)
    if(staff == undefined || staff == null) {
        window.location = '../../login/';
    }  
</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTORY SYSTEM</title>

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/bootstrap-4.6.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/guest.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <?php include '../../partials/top-nav.php'; ?>

    <div class="jumbotron custom-jumbotron bg-danger text-light rounded-0">
        
          <div class="container">
            <h1 class="display-3 ">Ace Supermarket<h1> 
            <h3>New Stock</h3>   
        </div>
    </div>

<div class="container lift-upward">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow p-5">

            <form class="container mx-auto needs-validation" novalidate method="post" onsubmit="newStock(event)">
                <div class="alert alert-primary alert-dismissible fade show" style="display: none" role="alert">
                    <button type="button" class="close" onclick="closeAlert()">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Notification: </strong> <span id="notification"></span>
                </div>

                <div class="form-group my-3">
                    <label class="form-label" for="item1">Item Name</label>
                    <span class="invalid-feedback">Item name is required</span>
                    <input type="text" class="form-control" id="name" placeholder="Item Name" required>
                </div>

                <div class="form-group my-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="item1">Price</label>
                            <span class="invalid-feedback">Item price is required</span>
                            <input type="number" class="form-control" id="price" placeholder="100" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="item1">Quantity</label>
                            <span class="invalid-feedback">Item quantity is required</span>
                            <input type="number" min="1" class="form-control" id="qty" required>
                        </div>
                    </div>
                </div>

                <div class="form-group my-3">
                    <button type="submit" class="btn btn-danger rounded-0 w-100" id="submit">Add Stock</button>
                </div>

                <button type="button" onclick="reset()" class="btn btn-sm btn-outline-danger rounded-0">Reset</button>

                <a href="../" class="btn btn-sm btn-info" style="float: right;">
                    Preview <i class="fa fa-eye" aria-hidden="true"></i>
                </a>

            </form>
 
               
            </div>
        </div>
    </div>
</div>
    
<script src="../../assets/bootstrap-4.6.0-dist/js/jquery.js"></script>
<script src="../../assets/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/bootstrap-4.6.0-dist/js/bootstrap.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/inventory.js"></script>
<script>

    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation');
  var err = document.querySelectorAll('.invalid-feedback');
 
  var btn = document.querySelector('#submit');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      btn.addEventListener('click', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)

    });

    
})();

    const reset = () => {
        document.querySelector('#name').value = '';
        document.querySelector('#price').value = '';
        document.querySelector('#qty').value = '';
    }

   const newStock = (event) => {

    event.preventDefault();

    var fd = new FormData();
    var name =  document.querySelector('#name').value
    var price =  document.querySelector('#price').value
    var qty =  document.querySelector('#qty').value
    
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200){
            // console.log(xhr.response)
            document.querySelector('.alert').style.display = 'block';
            document.querySelector('#notification').innerHTML = xhr.response;
        }
    };

    xhr.open("post", `../../server/api/stocks.php?newStock=true&name=${name}&price=${price}&qty=${qty}`, true);
    xhr.send(null);
       
   }

   function closeAlert() {
        document.querySelector('.alert').style.display = 'none';
   }

</script>

</body>
</html>