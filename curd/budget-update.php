<?php
include('conn.php');
$message = '';
$bid = $_GET['id'];
$uid = $_GET['uid'];
if(isset($_POST['item']) && isset($_POST['description']) && isset($_POST['cost'])){
	$item = @$_POST['item'];
	$description = @$_POST['description'];
	$cost = @$_POST['cost'];
	$sql = "UPDATE budgets SET item = '".$item."', description = '".$description."', cost = '".$cost."' WHERE id='".$bid."'";
	$conn->query($sql);
	header("Location: user-detail.php?id=".$uid);
	exit();
}else{
	$sql = "SELECT * FROM budgets WHERE id = '".$bid."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){			
		$row = mysqli_fetch_assoc($result);
		$item = @$row['item'];
		$description = @$row['description'];
		$cost = @$row['cost'];
	}else{
		header("Location: user-detail.php?id=".$uid);
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
				<label class="control-label col-sm-2" for="itemID">Item:</label>
				<div class="col-sm-10">
					 <select class="form-control" id="itemID" name="item" required>
					<option value="">Select Item</option>
					  <option value="Direct Mail" <?php if(@$item == 'Direct Mail'){ echo 'selected="selected"'; } ?>>Direct Mail</option>
					  <option value="Skip Tracing" <?php if(@$item == 'Skip Tracing'){ echo 'selected="selected"'; } ?>>Skip Tracing</option>
						<option value="Other" <?php if(@$item == 'Other'){ echo 'selected="selected"'; } ?>>Other</option>
					</select> 
				</div>
			</div>
			  <div class="form-group" id="descriptiondiv" style="display:<?php if(@$item == 'Other'){ echo 'block'; }else{ echo 'none'; } ?>;">
				<label class="control-label col-sm-2" for="descriptionID">Description:</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="descriptionID" name="description" placeholder="Enter description" value="<?php echo @$description; ?>">
				</div>
			</div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="cost">Cost:</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="cost" name="cost" placeholder="Enter cost" value="<?php echo @$cost; ?>" required>
				</div>
			</div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<?php echo $message ; ?>
				  <button type="submit" class="btn btn-default">Update</button>
				</div>
			  </div>
			</form> 			
		</div>
		<script>
			$(document).ready(function(){
				$(document).on('change','#itemID',function(){
					var sval = $(this).val();
					if(sval == 'Other'){
						$('#descriptiondiv').show();
					} else {
						$('#descriptiondiv').hide();
						$('#descriptionID').val('');
					}
				})
			})
		</script>
	</body>
</html> 
