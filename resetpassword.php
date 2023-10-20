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
            <h2 class="mb-4">FORGET PASSWORD</h2>
            <form action="" method="POST" enctype="multipart/form-data">
           
              
     
                <div class="form-group">
                    <label for="password">Email</label>
                    <input type="email" class="form-control" id="password" name="email" required>
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
    if (isset($_POST['submit'])) {
        // code...


        include 'connection.php';
        $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

        $query="SELECT * FROM users WHERE email='$email'";
        $result=$conn->query($query);
        if ($result->num_rows>0) {
         $token=sha1(microtime());
         $query="insert into reset (email,token) Values('$email','$token')";
         $result=$conn->query($query);
         $link="reset.php?token=$token";
echo "<br>";
         echo "<div class='alert alert-success'>";
         echo "<h6>RESET LINK HAS BEEN SENT TO YOUR EMAIL</h6>";
         echo "</div>";
         echo "<script>
            setTimeout(function() {
                window.location.href = 'reset.php?token=" . $token . "';
            }, 3000); // 3000 milliseconds = 3 seconds
        </script>";
        }else
        {
            echo "<div class='alert alert-danger'>";
            echo "<h6>No User Found Please Enter Your Valid Email</h6>";
            echo "</div>";

        }
    }



    ?>
