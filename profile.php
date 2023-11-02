<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location:index.php");
}
include"Connection.php";
$name=$_GET['id'];
$sln="SELECT uid FROM POST P JOIN users u ON u.id=p.uid WHERE u.username='$name' ";
$id=mysqli_query($conn,$sln);
$id1=mysqli_fetch_assoc($id);
$id2=$id1['uid'];
$sql="SELECt p.CreatedAt, p.Picture As Recent,P.content As RC,P.Title as Pt From Post P  Where uid='$id2' ORDER BY P.CREATEDAT DESC LIMIT 1";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
    $CreatedAt=substr($row['CreatedAt'],0,19);

$recent=$row['Recent'];
$rc=$row['RC'];
$Pt=$row['Pt'];

}
$data="SELECT * from users WHERE id=$id2";
$dataresult=mysqli_query($conn,$data);
while ($row=mysqli_fetch_assoc($dataresult)) {
	// code...
	$name=$row['Username'];
	$pic=$row['ProfilePicture'];
}



$sql="SELECt Count(P.uid) AS Total From Post P  WHERE Uid=$id2";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
    $total= $row["Total"];
}
$sql="SELEct P.Title,P.id ,P.Content ,P.Picture From Post P Where uid=$id2 LIMIT 5";
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
                    <img src="<?php echo $pic; ?>" class="card-img-top" alt="Profile Picture">
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
                    <?php while ($row = mysqli_fetch_array($res)) { 
                       $pid=$row['id'];
                       ?>
                        <div class="card mb-3">
                      <a href="update.php?id=<?php echo $pid ?>">UPDATE  <i class="fa-regular fa-pen-to-square"></i></a>
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
    <script src="https://kit.fontawesome.com/c2a4c4f905.js" crossorigin="anonymous"></script>
</body>
</html>


