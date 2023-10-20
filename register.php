<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Register</h2>
            <form action="" method="POST" enctype="multipart/form-data">
           
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

     
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

        
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                <div class="form-group">
                    <label for="profilepicture">Profile Picture</label>
                    <input type="file" class="form-control" id="profilepicture" name="profilepicture" required>
</div>

                <div class="form-group">
    <p class="m-10">Already registered? <a href="index.php">Click here</a> to log in.</p>
</div>          
                <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery (optional, but may be required for some Bootstrap features) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php

if(isset($_POST['submit'])){
    include 'connection.php';
$username=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
$email=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
$pass=$_POST['password'];
$cpass=$_POST['confirmPassword'];
$targetfolder='images/';
$query="SELEct `username` from users WHere username='$username'";
$unique=mysqli_query($conn,$query);
if (mysqli_num_rows($unique)>0) {
    echo "<br>";
    echo "<div class='alert alert-danger'>";
    echo "<h6>username Already Exist<h6>";
    echo "</div>";
}else{
$profile=$targetfolder.basename($_FILES['profilepicture']['name']);
if($pass!=$cpass){
    echo "<div class='alert alert-danger'>";
    echo "<h6>Password not Matched<h6>";
    echo "</div>";
}else{
    if (move_uploaded_file($_FILES['profilepicture']['tmp_name'],$targetfolder.basename($_FILES['profilepicture']['name']))) {
        $sql="INSERT INTO users (`Username`,`Email`,`Password`,`ProfilePicture`) VALUES('$username','$email','$pass','$profile')";
        $result=mysqli_query($conn,$sql);
        if ($result) {
  echo '<meta http-equiv="refresh" content="3;url=index.php">';
  echo "<div class='alert alert-success'>";
                    echo "<h6>Registration successful. Redirecting to login page...</h6>";
                    echo "</h6>";

         }
    }
}}
}
















?>