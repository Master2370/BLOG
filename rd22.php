<?php
include("connection.php");
$sql="SELECT P.CReatedAt As Latest,U.username,U.Email,U.ProfilePicture FRom POST P JOIN USERS U On U.id=P.uid WHERE U.username='Rolex' ORDER BY P.CREATEDAT DESC LIMIT 1";
$result=mysqli_query($conn,$sql);
while($rows=mysqli_fetch_array($result)){
$name=$rows['username'];
$pic=$rows['ProfilePicture'];
$latest=$rows['Latest'];
}
$query1="SELECT count(P.uid) AS Total from POST P JOIN USERs U ON u.id=P.uid WHERE username='Rolex'";
$result1=mysqli_query($conn,$query1);
while($row1=mysqli_fetch_assoc($result1)){
    $total=$row1['Total'];
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style type="text/css">
        .gradient-custom-2 {
/* fallback for old browsers */
background: #fbc2eb;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
}
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<section class="h-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card">
          <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
              <img src="<?php echo $pic ?>"
                alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                style="width: 150px; z-index: 1">
             
            </div>
            <div class="ms-3" style="margin-top: 130px;">
              <h5><?php echo $name ?></h5>
              
            </div>
          </div>
          <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <div class="d-flex justify-content-end text-center py-1">
              <div>
                <p class="mb-1 h5"><?php echo $total ?></p>
                <p class="medium text-muted mb-0">Post</p>
              </div>
              <div class="px-3">
                <p class="mb-1 h5"><?php echo substr($latest,0,19) ?></p>
                <p class="medium text-muted mb-0">Last Post Time</p>
              </div>
              
            </div>
          </div>
          <div class="card-body p-4 text-black">
            <div class="mb-5">
              <p class="lead fw-normal mb-1">About</p>
              <div class="p-4" style="background-color: #f8f9fa;">
                <p class="font-italic mb-1">Web Developer</p>
                <p class="font-italic mb-1">Lives in Haldwani</p>
                <p class="font-italic mb-0">Photographer</p>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0">Recent Post</p>
            
            </div>
            <div class="row g-5">
                <?php
$postq="SELECT P.Picture FROM POST P JOIN users U On u.id=p.uid Where username='$' ORDER BY P.CREATEDAT DESC LIMIT 5";
$resultq=mysqli_query($conn,$postq);
while($rowq=mysqli_fetch_assoc($resultq)){
$pic=$rowq['Picture'];
                ?>
              <div class="col mb-2">
                <img src="<?php echo $pic; ?>"
                  alt="image 1" class="w-100 rounded-3">
              </div>
            <?php } ?>
            
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
