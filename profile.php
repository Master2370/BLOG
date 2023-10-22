<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location:index.php");
}
include"Connection.php";
$name=$_SESSION["username"];
$sql="SELECt p.CreatedAt, p.Picture As Recent,P.content As RC,P.Title as Pt,U.username,U.ProfilePicture From Post P Join Users U On u.Id=P.uid Where Username='$name' ORDER BY P.CREATEDAT DESC LIMIT 1";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
    $name=$row['username'];
    $CreatedAt=substr($row['CreatedAt'],0,19);
$picture=$row['ProfilePicture'];
$recent=$row['Recent'];
$rc=$row['RC'];
$Pt=$row['Pt'];

}



$sql="SELECt Count(P.uid) AS Total From Post P Join USERS u on u.id=p.uid WHERE Username='$name'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
    $total= $row["Total"];
}
$sql="SELEct P.Title ,P.Content ,P.Picture From Post P JOIN users u On u.id=p.uid Where Username='$name' LIMIT 5";
$res=mysqli_query($conn,$sql);

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
                    <img src="<?php echo $picture; ?>" class="card-img-top" alt="Profile Picture">
                    <div class="card-body">
                        <!-- User's Name -->
                        <h5 class="card-title"><?php echo $name; ?></h5>
                        <!-- Total Posts -->
                        <p class="card-text">Total Posts: <?php echo $total; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Most Recent Post -->
                        <h5 class="card-title">Most Recent Post</h5>
                        <p class="card-text">Posted on: <?php echo $CreatedAt; ?></p>
                    </div>
                    <!-- You can customize the layout of the post content here -->
                    <img src="<?php echo $recent; ?>" class="card-img-top" alt="Post Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $Pt; ?></h5>
                        <p class="card-text"><?php echo $rc; ?></p>
                    </div>
                </div>
                <div class="mt-4">
                    <h5 class="mb-4">Recent Posts</h5>
                    <!-- Loop through and display a list of recent posts -->
                    <?php while ($row = mysqli_fetch_array($res)) { ?>
                        <div class="card mb-3">
                            <img src="<?php echo $row['Picture']; ?>" class="card-img-top" alt="Post Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['Title']; ?></h5>
                                <p class="card-text"><?php echo $row['Content']; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <a href="home.php"><button class="btn btn-info">GO Back</button></a>
    </div>
    <!-- Add Bootstrap JS and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


