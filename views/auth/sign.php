<!DOCTYPE html>
<?php include_once __DIR__."/../partial/head.php" ?>
<html>
<body>
	<header>
		<nav class="main-nav navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/home">Brand</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="/">Login</a></li>
						<li class="active"><a href="/sign">sign up<span class="sr-only">(current)</span></a></li>
					</ul>
					
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	</header>
	
	<?php if(!empty($_SESSION['message'])){ ?>
	<div class="alert alert-danger fade in">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong> <?php echo $_SESSION['message']; ?>
	</div>
	<?php unset($_SESSION['message']); ?>
	<?php } ?>
	<h1 class="center_title">JOIN US</h1>
	<form class="center" action="/sign_up" method="post">
	<div class="col-xs-12">
		<div class="form-group ">
			<label for="email">Email address</label>
			<input type="email" class="form-control" id="email" placeholder="Email" name="email">
		</div>
		<div class="form-group ">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" placeholder="Name" name="name">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" placeholder="Password" name="password">
		</div>
		<div class="form-group">
				<div class="checkbox">
					<label>
		  				<input type="checkbox"> Remember me
					</label>
				</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default">Sign in</button>
		</div>
	</div>
		
	</form>
	<?php include_once __DIR__."/../partial/script.php" ?>
</body>
</html>
