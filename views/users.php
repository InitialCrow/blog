<!DOCTYPE html>
<html>
<?php include_once __DIR__."/partial/head.php" ?>
<body>
	<header class="main-header">
		<?php include_once __DIR__."/partial/nav.php" ?>
	</header>
	<h1 class="center_title">Users list</h1>
	<div class=" center panel panel-default ">
		
		<div class=" panel-body">
			<?php if(!empty($users)){ ?>
			<table id= class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user ) {?>
					<tr>
					
					<td><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $user['name'];?></td> <td><a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email'];?></a></td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
		</div>
	</div>

<?php include_once __DIR__."/partial/script.php" ?>
</body>
</html>