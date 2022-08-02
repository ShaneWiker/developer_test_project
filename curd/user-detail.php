<?php
include('conn.php');
$uid = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = '".$uid."'";
$result = $conn->query($sql);
if($result->num_rows > 0){			
	$row = mysqli_fetch_assoc($result);
	$name = @$row['name'];
	$email = @$row['email'];
}else{
	header("Location: index.php");
	exit();
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
		<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
		<link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
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
				<li class="active"><a href="index.php" >Users</a></li>	
				<li><a href="add-user.php" >Add User</a></li>	
			  </ul>
		  </div>
		</nav>
		<div class="container" style="padding:50px;">
			<div style="margin-bottom: 20px;">
			<div class="row">
				<div class="col-md-4">
					<label >Name: <?php echo $name; ?></label>
				</div>
				<div class="col-md-4">
				  <label >Email: <?php echo $email; ?></label>
				</div>
				<div class="col-md-4">
				  <a href="add-budget.php?uid=<?php echo $uid ?>" class="btn btn-primary">Add Budget</a>
				</div>
			</div>
			</div>
			<hr>
			<table class="table table-striped" id="exampletable">
				<thead>
					<tr class="warning">
						<th>ID</th>
						<th>Item</th>
						<th>Description</th>
						<th>Cost</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					$i = 1;
					$sql = "SELECT * FROM budgets WHERE user_id = '".$uid."'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = mysqli_fetch_assoc($result)){ ?>
							<tr>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['item']; ?></td>
								<td><?php echo $row['description']; ?></td>
								<td><?php echo $row['cost']; ?></td>
								<td>
								<a href="budget-update.php?uid=<?php echo $uid ?>&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
								<a href="budget-delete.php?uid=<?php echo $uid ?>&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete user budget?')"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
					
					<?php } } ?>
				</tbody>
			</table>
		</div>
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
		<script>

		$(document).ready(function() {
			$('#exampletable').DataTable( {
				dom: 'Bfrtip',
				searching: true,
				buttons: [
				   'copy', 'csv', 'excel', 'print',
					{
						extend : 'pdfHtml5',
						orientation : 'landscape',
						pageSize : 'LEGAL',
					} 
				]
			} );
		} );
		</script>
	</body>
</html> 
