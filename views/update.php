<!DOCTYPE html>
<html>
<?php include_once __DIR__."/partial/head.php" ?>
<body>
	<header class="main-header">
		<?php include_once __DIR__."/partial/nav.php" ?>
	</header>

	<?php if(!empty($post)){ ?>
	<form action="/update_post" method="post">
		<div class="center">
			<div class="form-group ">
			<label for="title">Title</label>
			<input type="title" class="form-control" id="title" placeholder="Title" name="title" value="<?php echo $post[0]['title'];?>" required>
			<input type="hidden" value="<?php echo $post[0]['id']; ?>" name="id_post">
			</div>
			<textarea name="editor" id="editor" required><?php echo $post[0]['content']; ?></textarea>
			<button class=" submit-btn btn btn-success">submit</button>
		</div>
		
	</form>
	<?php } ?>
	
<?php include_once __DIR__."/partial/script.php"; ?>
<script>
	app.show_editor();
</script>
</body>
</html>