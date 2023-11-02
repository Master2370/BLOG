<?php
include 'Entry/entry.php';
include 'connection.php';
$user=$_SESSION['username'];
$id=$_GET["id"];
$userid=$conn->query("SELECT id FROM users WHERE username='$user'")->fetch_assoc()["id"];
$sql = "DELETE FROM POST    WHERE id=$id AND uid=$userid ";
$result=$conn->query($sql);
if($result){
    echo '<meta http-equiv="refresh" content="3;url=home.php">';
    echo "<div class='alert alert-success'>";
                    echo "<h6>Blog Deleted SuccessFully...</h6>";
                    echo "</h6>";
}else{
    echo "NHI UDAUNGA MAIN";
}
?>