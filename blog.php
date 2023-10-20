<!DOCTYPE html>
<html>
<?php
include("connection.php");
$id=$_GET['id'];
$sql="SELECT p.*,u.Username from post p JOIN users u on p.uid=u.ID WHERE p.ID=$id;";
$result=mysqli_query($conn,$sql);	
while($row=mysqli_fetch_array($result)){
$title=$row['Title'];
$content=$row['Content'];
$picture=$row['Picture'];
$name=$row['Username'];

}





?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital@1&display=swap');
        * {
            font-family: 'Poppins', sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.9);
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card text-dark bg-info mb-3" style="width: 38rem;">
        <img src="<?php echo $picture ?>" class="card-img-top" width="300" height="400" alt="Card image">
        <div class="card-body">
            <h5 class="card-title"><?php echo $title;?></h5>
            <p class="card-text"><?php echo $content;?></p>
            <p class="card-text"><?php echo $name?></p>
            <a href="dashboard.php" class="btn btn-primary">GoBack</a>
        </div>
    </div>
</div>
</body>
</html>
