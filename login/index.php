<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTORY SYSTEM</title>

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/guest.css">
</head>

<body>
    <div class="jumbotron bg-primary text-light rounded-0">
        <div class="container">
            <h1 class="display-3 ">Ace Supermarket<h1> 
            <h3 class="lead">Stock Inventory System</h3>   
            
        </div>
    </div>

<div class="container lift-upward">
    <div class="row">
        <div class="col-md-10 col-lg-7 mx-auto">
            <div class="card shadow p-5">

                <p class="text-info" id="notification"></p>

                <form class="container mx-auto needs-validation" novalidate method="post" onsubmit="login(event)">
                  <div class="form-group my-3">
                    <label class="h5 text-muted">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                    <span class="invalid-feedback">Enter a valid email</span>
                  </div>
            
                  <div class="form-group my-3">
                    <label class="h5 text-muted">Password</label>
                    <input type="password" class="form-control" id="pass" placeholder="*******" name="pass" required>
                    <span class="invalid-feedback">Password is required</span>
                  </div>
            
                  <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary rounded-0 w-100" id="submit">Login</button>
                  </div>
            
                </form>
            </div>
        </div>
    </div>
</div>
    

<script src="../assets/js/jquery.js"></script>
<script src="../assets/bootstrap/js/bootstrap.js"></script>
<script src = "../assets/js/Inventory.js"></script>
<script src = "../assets/js/main.js"></script>

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

      const login = (event) => {
        event.preventDefault();

        var fd = new FormData();
        var email =  document.querySelector('#email').value
        var pass =  document.querySelector('#pass').value

        var xhr = new XMLHttpRequest();

        // console.log('test', {email, pass})

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200){
                var res = JSON.parse(xhr.response);
                console.log("message",res)
                if(!res.success) {
                  document.querySelector('#notification').innerHTML = res.message;

                } else {
                  
                  sessionStorage.setItem('_ud', JSON.stringify(res.message));
                  window.location = '../';

                }
            }
        };

        xhr.open("post", `../server/api/staffs.php?login=true&email=${email}&pass=${pass}`, true);
        xhr.send(null);
      }


 </script>
</body>
</html>