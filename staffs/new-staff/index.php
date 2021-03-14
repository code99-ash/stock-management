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
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/guest.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <?php include '../../partials/top-nav.php'; ?>

    <div class="jumbotron custom-jumbotron bg-primary text-light rounded-0">
        
          <div class="container">
            <h1 class="display-3 ">Ace Supermarket<h1> 
            <h3>New Staff</h3>   
        </div>
    </div>

<div class="container lift-upward">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow p-5">

 
                <form class="container mx-auto needs-validation" onsubmit="addStaff(event)" novalidate method="post">
                
                    <div class="alert alert-primary alert-dismissible fade show" style="display: none" role="alert">
                        <button type="button" class="close" onclick="closeAlert()">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Notification: </strong> <span id="notification"></span>
                    </div>
                    
                  <div class="form-group my-3">
                      <div class="row">
                          
                            <div class="col-md-2 my-3">
                                <select name="title" id="title" class="form-control px-3">
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Mrss">Mrss</option>
                                </select>
                            </div>
                            <div class="col-md-5 my-3">
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                                <div class="invalid-feedback">
                                First Name is required
                                </div>
                            </div>
                            <div class="col-md-5 my-3">
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                                <div class="invalid-feedback">
                                Last Name is required
                                </div>
                            </div>
                            <div class="col-md-6 my-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                <div class="invalid-feedback">
                                    Enter a valid email address
                                </div>
                            </div>
                            <div class="col-md-6 my-3">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Mobile Number">
                            </div>
                            <div class="col-md-12 my-3">
                                <input type="password" class="form-control" minLength="5" id="password" name="password" placeholder="Password" required>
                                <div class="invalid-feedback">
                                    Password should not be less than 5 characters
                                </div>
                            </div>


                      </div>
                  </div>
            
                  <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary rounded-0 w-100" id="submit">Add Staff</button>
                  </div>
            
                </form>
            </div>
        </div>
    </div>
</div>
    
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/bootstrap/js/bootstrap.js"></script>
<script src="../../assets/js/main.js"></script>
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

   const addStaff = (event) => {

    event.preventDefault();

    var fd = new FormData();
    var title =  document.querySelector('#title').value
    var fname =  document.querySelector('#fname').value
    var lname =  document.querySelector('#lname').value
    var email =  document.querySelector('#email').value
    var phone =  document.querySelector('#phone').value
    var pass = document.querySelector('#password').value
    
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200){
            // console.log(xhr.response)
            document.querySelector('.alert').classList.remove('d-none');
            document.querySelector('#notification').innerHTML = JSON.parse(xhr.response).message;
        }
    };

    xhr.open("post", `../../server/api/staffs.php?details=true&title=${title}&fname=${fname}&lname=${lname}&email=${email}&phone=${phone}&pass=${pass}`, true);
    xhr.send(null);
       
   }

</script>

</body>
</html>