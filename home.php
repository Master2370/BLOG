<?php
require_once("Entry/entry.php");
$name=$_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <style type="text/css">
       h1{
        font-style: italic;
        font-family: Arial;

       }
       .ds{
        justify-content: space-between;
        display: flex;
       }
   </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<h1 >Welcome Boss !     <?php echo $_SESSION['username']; ?></h1>
<div class="ds">
    <div class="profile">
        <?php 
echo "<a href='mypage.php?id=" . $name . "'>" . "PROFILE" . "</a>";

        ?>
</div>
    <div class="logout">
<a href="logout.php"><button class="btn btn-warning">CLICK HERE TO LOG OUT</button></a></div>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-4">Blogging Area</h2>
            <form action="" method="POST" enctype="multipart/form-data">
           
     
            

        
                <div class="form-group">
                    <label for="picture">Profile Picture</label>
                    <input type="file" class="form-control" accept="image/*" id="picture" name="picture" required>
</div>
<div class="form-group">
        
                    <label for="title">Post Title</label>
    <input type="text" class="form-control" id="title" name="title" required>
                </div>
<div class="form-group">
        
                    <label for="exampleFormControlTextarea1">Write Your Blog Here</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="10"></textarea>
                </div>
<br>        
                <button type="submit" name="submit" class="btn btn-primary  btn-block">POST YOUR BLOG</button>
            </form>
        </div>
    </div>
</div>



</form>
</body>
</html>
<?php
include 'connection.php';
if(isset($_POST['submit'])){
    $target='bloggingkarenge/';
    $title=filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $content=filter_var($_POST['content'],FILTER_SANITIZE_STRING);
$picture=$target.basename($_FILES['picture']['name']);
$author=$_SESSION['username'];
$sql="SELECT `ID` from users WHERE username='$author'";
$result1=mysqli_query($conn,$sql);
$row1=mysqli_fetch_array($result1);
$id=$row1['ID'];


if($_FILES['picture']['size']<5*1024*1024){
if(move_uploaded_file($_FILES['picture']['tmp_name'],$target.basename($_FILES['picture']['name']))){
    $sql="INSERT INTO `post`(`Title`, `Content`, `uid`,`Picture`) VALUES ('$title','$content',$id,'$picture')";
$result=$conn->query($sql);
if($result){
  
        echo '<meta http-equiv="refresh" content="3;url=home.php">';
        echo "<div class='alert alert-success'>";
                          echo "<h6>Blog Posted SuccessFully...</h6>";
                          echo "</h6>";
      
}
}
}else{
    echo '<meta http-equiv="refresh" content="10;url=home.php">';
    echo "<div class='alert alert-success'>";
                      echo "<h6>Size Bhut Bada h Chacha</h6>";
                      echo "</h6>";
  
}
}
?>