<?php
include("Entry/entry.php");
include("CONNECTION.PHP");
$id=$_GET["id"];
$fetchdata=$conn->query("SELECT * FROM post WHERE id=$id");

$row=$fetchdata->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>UPDATE POST</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-4">Blogging Area</h2>
            <form action="" method="POST" enctype="multipart/form-data">
           
     
            

        
                <div class="form-group">
                    <label for="picture">Profile Picture</label>
                    <input type="file" class="form-control" accept="image/*" id="picture" name="picture" >
</div> <img id="imagePreview" src="<?php echo $row["Picture"]; ?>" alt="Image Preview" style="max-width: 100%; display: ;">
<div class="form-group">
        
                    <label for="title">Post Title</label>
    <input type="text" value="<?php echo $row["Title"]; ?>" class="form-control" id="title" name="title" required>
                </div>
<div class="form-group">
        
                    <label for="exampleFormControlTextarea1">Write Your Blog Here</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="10"><?php echo $row["Content"]; ?></textarea>
                </div>
<br>        
                <button type="submit" name="submit" class="btn btn-primary  btn-block">UPDATE YOUR BLOG</button>
            </form>
        </div>
    </div>
</div>


</body>
</html>
<?PHP
if(isset($_POST['submit'])){
    $target='bloggingkarenge/';
    $title=filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $content=filter_var($_POST['content'],FILTER_SANITIZE_STRING);
$pic=$target.basename($_FILES['picture']['name']);
$picture=$row['Picture'];
if(empty($_FILES['picture']['name'])){
     $sql="UPDATE `post` SET `Title`='$title',`Content`='$content',`Picture`='$picture' WHERE id=$id";
$result=$conn->query($sql);
if($result){
  
        echo '<meta http-equiv="refresh" content="3;url=home.php">';
        echo "<div class='alert alert-success'>";
                          echo "<h6>Blog UPDATED SuccessFully...</h6>";
                          echo "</h6>";
      
}  
}else{

if($_FILES['picture']['size']<5*1024*1024){
if(move_uploaded_file($_FILES['picture']['tmp_name'],$target.basename($_FILES['picture']['name']))){
    $sql="UPDATE `post` SET `Title`='$title',`Content`='$content',`Picture`='$pic' WHERE id=$id";
$result=$conn->query($sql);
if($result){
  
        echo '<meta http-equiv="refresh" content="3;url=home.php">';
        echo "<div class='alert alert-success'>";
                          echo "<h6>Blog UPDATED SuccessFully...</h6>";
                          echo "</h6>";
      
}
}
}else{
    echo '<meta http-equiv="refresh" content="10;url=update.php">';
    echo "<div class='alert alert-success'>";
                      echo "<h6>Size Bhut Bada h Chacha</h6>";
                      echo "</h6>";
  
}
}
}
?>