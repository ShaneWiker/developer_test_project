<?php
include('conn.php');
$message = '';
if(isset($_POST['name']) && isset($_POST['email'])){
	$name = @$_POST['name'];
	$email = @$_POST['email'];
	$sql = "SELECT id FROM users WHERE email ='".$email."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){	
		$message = '<p style="color:red;">Email already exists.</p>';
	}else{
		$sql = "INSERT INTO users(name, email) VALUES ('".$name."','".$email."')";
		$conn->query($sql);	
		header("Location: index.php");
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>CURD</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="#">CURD</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php" >Users</a></li>	
				<li class="active"><a href="add-user.php" >Add User</a></li>	
			  </ul>
		  </div>
		</nav>
		<div class="container" style="padding:50px;">			
			<form class="form-horizontal" action="" method="POST">	
			  <div class="form-group">
				<label class="control-label col-sm-2" for="name">Name:</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo @$name; ?>" required>
				</div>
			</div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="email">Email:</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo @$email; ?>" required>
				</div>
			</div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<?php echo $message ; ?>
				  <button type="submit" class="btn btn-default">Submit</button>
				</div>
			  </div>
			</form> 			
		</div>
	</body>
</html> 