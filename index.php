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
            <h2 class="mb-4">Login</h2>
            <form action="" method="POST">
           
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

     
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

        
                <div class="form-group">
    <p>Not registered? <a href="register.php">Click here</a> to register.</p>
</div>         
<div class="form-group">
    <p class="m-10">Forget Password? <a href="resetpassword.php">Click here</a> to Reset.</p>
</div>  
                <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
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
include 'connection.php';
if (isset($_POST['submit'])) {
$username=$_POST['username'];
$pass=$_POST['password'];
$sql="SElect * FROM `Users` Where username='$username' AND password='$pass'";
$result=mysqli_query($conn,$sql);
if ($result&&mysqli_num_rows($result)>0) {
    session_start();
    $row=mysqli_fetch_assoc($result);
    $image=$row['ProfilePicture'];
    $_SESSION['username']=$username;
    $_SESSION['photo']=$image;
    echo '<meta http-equiv="refresh" content="3;url=home.php">';
  echo "<div class='alert alert-success'>";
                    echo "<h6>Registration successful. Redirecting to login page...</h6>";
                    echo "</h6>";


}else{
    echo "<br>";
    echo "<div class='alert alert-danger'>";
    echo "<h6>Username Or Password Does not Matched";
    echo "</div>";
}

}

?>
