<?php
include("Entry/entry.php");
include("Connection.php");
$username=$_GET["name"];
$name=$_SESSION["username"];
$id=$conn->query("SELECT id FROM users WHERE username='$name'")->fetch_assoc()["id"];

$sql=$conn->query("SELECT email,ProfilePicture from users WHERE username='$username'");

$row=$sql->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn5.vectorstock.com/i/1000x1000/90/54/edit-profile-icon-vector-22989054.jpg" type="image/x-icon">
    <title>EDIT YOUR PROFILE</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Edit Your Profile <i style="color:red;"><?php echo $username; ?></i></h2>
            <form action="" method="POST" enctype="multipart/form-data">
           
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" name="username" disabled required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="<?php echo $row['email']; ?>"  class="form-control" id="email" name="email" required>
                </div>

     
                <div class="form-group">
                    <label for="profilepicture">Profile Picture</label>
                    <input type="file" class="form-control" id="profilepicture" name="profilepicture" >
</div>
<img id="imagePreview" src="<?php echo $row["ProfilePicture"]; ?>" alt="Image Preview" style="max-width: 100%; display: ;">
                <div class="form-group">
    <p class="m-10">Mood Badal Gaya? <a href="mypage.php?id=<?php echo $username; ?>">Click here</a> to go Home.</p>
</div>          
                <button type="submit" name="submit" class="btn btn-primary btn-block">Edit</button>
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

$email=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
$oldpic=$row['ProfilePicture'];
$targetfolder='images/';
$query="SELEct `username` from users WHere username='$username'";

$profile=$targetfolder.basename($_FILES['profilepicture']['name']);
if(empty($_FILES['profilepicture']['name'])){
 $sql=$conn->query(" UPDATE `users` SET `Email`='$email' ,`ProfilePicture`='$oldpic' WHERE Username='$username' AND id=$id");
 if($sql){
    header("Location:mypage.php?id=$username");
 }else{
    echo '<meta http-equiv="refresh" content="3;url=editprofile.php">';
    echo "<div class='alert alert-success'>";
                      echo "<h6>Not Updated...</h6>";
                      echo "</h6>";
 }
}
    else{ 
        if(move_uploaded_file($_FILES['profilepicture']['tmp_name'],$targetfolder.basename($_FILES['profilepicture']['name']))) {
        $sql=$conn->query("UPDATE `users` SET `Email`='$email',`ProfilePicture`='$profile' WHERE Username='$username' AND id=$id");
      
        if ($sql) {
            echo '<meta http-equiv="refresh" content="3;url=mypage.php?id=$username">';
            echo "<div class='alert alert-success'>";
                              echo "<h6>Profile Updated...</h6>";
                              echo "</h6>";

         }else{
            echo '<meta http-equiv="refresh" content="3;url=editprofile.php">';
            echo "<div class='alert alert-success'>";
                              echo "<h6>Not Updated...</h6>";
                              echo "</h6>";
         }
    


    }
}
}