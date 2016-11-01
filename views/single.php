<!DOCTYPE html>
<html>
<?php include_once __DIR__."/partial/head.php" ?>
<body>
	<header class="main-header">
		<?php include_once __DIR__."/partial/nav.php" ?>
	</header>
	<?php if(!empty($post)){ ?>
	<h1 class="center_title"><?php echo $post[0]['title']; ?></h1>
	<?php }else{
		echo "dont Try to troll me I will find you and I will hack you ";
		return;
	} ?>

	<?php if(!empty($post)){ ?>
	
	<div class="center_title"><?php echo $post[0]['content']; ?></div>
	<?php if(!empty($comments)) {?>
		<?php foreach ($comments as $comment) {?>

			<p class="center_title"><?php echo htmlspecialchars($comment['name']); ?> say : <?php echo htmlspecialchars($comment['content']);  ?> </p>
	
	<?php }}}?>
	<?php if($_SESSION['id_user'] == $post[0]['user_id']){
			echo "<a class='btn btn-default' href='/update_post/".$post[0]['id']."'>edit your article</a>";
		} ?>
	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>/comment" method="post">
		<div class="center">
			<div class="form-group ">
			<textarea class="form-control" rows="3" name="comment" id="comment" placeholder="write a comment..." required></textarea>
			<button class=" submit-btn btn btn-success">submit</button>
		</div>
	</form>
<?php include_once __DIR__."/partial/script.php"; ?>
</body>
</html>