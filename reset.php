<?php
if(isset($_GET['token'])){
    include 'connection.php';
    $token=$_GET['token'];
    $sql="SELECT * FROM RESET WHERE token='$token'";
$result=$conn->query($sql);
if($result->num_rows>0){
    $email=$result->fetch_all()[0][1];
}else{
    header('location:login.php');
}
}else{
    header('location:login.php');
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $password = $_POST['p'];
    $cpassword = $_POST['cp'];

    if ($password == $cpassword) {
        // Construct and execute the update query
        $query = "UPDATE users SET PASSWORD='$password' WHERE email='$email'";
        $result = $conn->query($query);

        if ($result) {
            $sql="DELETe * FROM reset where token='$token'";
            header('location: index.php');
            exit;
        } else {
            echo "<div class='alert alert-danger'>";
            echo "<h6>Error updating password: " . $conn->error . "</h6>";
            echo "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>";
        echo "<h6>Passwords do not match.</h6>";
        echo "</div>";
    }
}
?>
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORGET PASSWORD</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">UPDATE PASSWORD</h2>
            <form action="" method="POST" >
           
              
     
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" class="form-control" id="password" name="p" required>
                </div>
   <div class="form-group">
                    <label for="password">CONFIRM PASSWORD</label>
                    <input type="password" class="form-control" id="password" name="cp" required>
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
