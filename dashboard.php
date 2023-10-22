

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog Area</title>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital@1&display=swap');
		*{
			font-family: 'Poppins', sans-serif;

		}
	</style>
	<script src="https://kit.fontawesome.com/c2a4c4f905.js" crossorigin="anonymous"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<div class="row">
		
		<div class="col-sm-12 form-container">
			<h1>BLOGS</h1>
			<hr>
			<table class="table table-info">
				<tr>
					<th>SR no</th>
					<th>TITLE</th>
					<th>DESCRIPTION</th>
					<th>PICTURE</th>
					<th>DATE/TIME</th>

				</tr>
				<?php
include 'connection.php';
$sql="SELECT * FROM POST ";
$result=$conn->query($sql);
while ($rows=mysqli_fetch_assoc($result)) {
                    echo "<tr class='bg-success'>";
	echo "<td>".$rows['id']."</td>";
	echo "<td>".$rows['Title']."</td>";
	echo "<td>".substr($rows['Content'],0,50)."..........."."<a href='blog.php?id=$rows[id]'"."class='btn btn-success'>"."Read More"."</a>"."</td>";
	echo "<td><img src='" . $rows['Picture'] . "' alt='Image' height='100px'></td>";
	echo "<td>".$rows['CreatedAt']."</td>";
	
	echo "</tr>";
}



				?>
			</table>
		</div>
	</div>
</div>
</body>
</html>