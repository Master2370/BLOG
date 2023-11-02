<?php 
require 'Entry/entry.php';
include'CONNECTION.PHP';
$name=$_GET['id'];
$finduserdetails=$conn->query("SELECT * FROM users WHERE username = '$name'");
$userdetails=$finduserdetails->fetch_assoc();
$userid=$userdetails["Id"];
$lastpost=$conn->query("SELECT title,content,Picture,CreatedAt AS LASTPOSTTIME FROM post WHERE uid = $userid ORDER BY CREATEDAT DESC LIMIT 1");
$resultoflastpost=$lastpost->fetch_assoc();
$total=$conn->query("SELECT COUNT(uid) AS TOTAl FROM post WHERE uid = $userid ");
$totalresults=$total->fetch_assoc();
$latest5post=$conn->query("SELECT title,iD,content,Picture FROM POST WHERE uid = $userid ORDER BY CREATEDAT DESC LIMIT 5");
$latest5postRESULTS=$latest5post->fetch_assoc();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <!-- User Profile Image -->
                    <img src="<?php echo $userdetails['ProfilePicture']; ?>" class="card-img-top" alt="Profile Picture">
                    <div class="card-body">
                        <!-- User's Name -->
                        <div class="d-flex justify-content-around">
                        <h5 class="card-title"><?php echo $userdetails['Username'] ?></h5>
                        <a href="editprofile.php?name=<?php echo $name; ?>">Edit PRofile  <i class="fa-regular fa-pen-to-square"></i></a>
                        <!-- Total Posts --></div>
                        <p class="card-text">Total Posts: <?php echo $totalresults['TOTAl']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Most Recent Post -->
                        <h5 class="card-title">Most Recent Post</h5>
                        <p class="card-text">Posted on: <?php echo substr($resultoflastpost['LASTPOSTTIME'],0,19); ?></p>
                    </div>
                    <!-- You can customize the layout of the post content here -->
                    <img src="<?php echo $resultoflastpost['Picture']; ?>" class="card-img-top" alt="Post Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $resultoflastpost['title']; ?></h5>
                        <p class="card-text"><?php echo $resultoflastpost['content']; ?></p>
                    </div>
                </div>
                <div class="mt-4">
                    <h5 class="mb-4">Recent Posts</h5>
                    <!-- Loop through and display a list of recent posts -->
                    <?php while ($latest5postRESULTS = $latest5post->fetch_assoc()) { 
                       $pid=$latest5postRESULTS['iD'];
                       ?>
                        <div class="card mb-3">
                            <div class ="d-flex justify-content-between">
                     <div> <a href="update.php?id=<?php echo $pid ?>">UPDATE  <i class="fa-regular fa-pen-to-square"></i></a></div>
                     <div><a style="color:red"  href="delete.php?id=<?php echo $pid ?>">DELETE  <i class="fa-solid fa-trash" style="color: #e90707;"></i></a>
                     </div>
                            </div>
                            <img src="<?php echo $latest5postRESULTS['Picture']; ?>" class="card-img-top" alt="Post Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $latest5postRESULTS['title']; ?></h5>
                                <p class="card-text"><?php echo $latest5postRESULTS['content']; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <a href="home.php"><button class="btn btn-info">GO Back</button></a>
    </div>
    <script src="https://kit.fontawesome.com/c2a4c4f905.js" crossorigin="anonymous"></script>
</body>
</html>