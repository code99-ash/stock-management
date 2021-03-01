<?php
require '../vendor/autoload.php';

if (isset($_GET['details'])) {
    $title = $_GET['title'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $pass = $_GET['pass'];

    $check = Staff::where('email', $email)->get();
    if (count($check) == 0) {
        if (
            Staff::create([
                'role_id' => 2,
                'title' => $title,
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'phone_no' => $phone,
                'password' => password_hash($pass, PASSWORD_BCRYPT),
            ])
        ) {
            echo 'Staff was successfully added';
        } else {
            echo 'Failed to add new Staff';
        }
    } else {
        echo 'Credentials already exist';
    }
}

if (isset($_GET['login'])) {
    $email = $_GET['email'];
    $pass = $_GET['pass'];
    $hash = null;

    $staff = Staff::where('email', $email)->get();
    
    
    if(count($staff) > 0) {
        $hash = $staff->first()->password;
    }

    $isValidPassword = password_verify($pass, $hash);

    if((count($staff) > 0) && $isValidPassword) {
        $data = [
            'success' => true,
            'message' => [
                'id' => $staff[0]['id'],
                'email' => $staff[0]['email'],
                'fname' => $staff[0]['fname'],
                'lname' => $staff[0]['lname'],
            ]
        ];
    } else {
        $data = [
            'success' => false,
            'message' => 'Incorrect Email/Password'
        ];
    }

    echo  json_encode($data);

}

?>
