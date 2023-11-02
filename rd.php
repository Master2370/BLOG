<?php

include 'connection.php';
$sql="SELECT P.CONTENT,P.PICTURE,U.username,U.ProfilePicture FROM POST P JOIN USER U On U.id=P.uid WHERE U.username='Rashmika' ORDER by P.createdAt DESC LIMIT 5 ";
$result=mysqli_query($sql,$conn);

?>





<!DOCTYPE html>
<html>
<head>
    <!-- Include Bootstrap CSS (you may need to adjust the path) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Center vertically in the viewport */
        }
    </style>
</head>
<body>
    <div class="centered-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- User Profile Section -->
                    <div class="user-profile text-center">
                        <img src="user-profile-image.jpg" alt="User Profile" class="img-fluid">
                        <h2><?php echo $row['Username'] ?></h2>
                        <p>Posts: 100</p>
                        <p>Followers: 1000</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Posts and Content Cards Section -->
                    <div class="row">
                        <?php
                       
                        while ($row=mysqli_fetch_assoc($result)) {
                            $picture=$row['PICTURE'];
                            echo '<div class="col-md-4">';
                            echo '<div class="card mb-4">';
                            
                            echo '<div class="card-body">';
                            echo '<p class="card-text">'</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $i++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (you may need to adjust the path) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
