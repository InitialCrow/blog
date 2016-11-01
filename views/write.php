<!DOCTYPE html>
<html>
<?php include_once __DIR__."/partial/head.php" ?>
<body>
	<header class="main-header">
		<?php include_once __DIR__."/partial/nav.php" ?>
	</header>
	<h2 class=center_title>Write you post</h2>
	<form action="/write_up" method="post">
		<div class="center">
			<div class="form-group ">
			<label for="title">Title</label>
			<input type="title" class="form-control" id="title" placeholder="Title" name="title" required>
			</div>
			<textarea name="editor" id="editor" required></textarea>
			<button class=" submit-btn btn btn-success">submit</button>
		</div>
		
	</form>
	
	<?php include_once __DIR__."/partial/script.php"; ?>
	<script>
		app.show_editor();
	</script>
</body>
</html>