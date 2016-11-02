<!DOCTYPE html>
<html>

<?php include_once __DIR__."/partial/head.php" ?>
<body>
	<header class="main-header">
		<?php include_once __DIR__."/partial/nav.php" ?>
	</header>
	<h1 class="center_title">Welcome</h1>
	<ul class="center">
		<?php if(!empty($posts)){ ?>
		<?php for($i =0; $i<count($posts);$i++) {   ?>
		<?php if (strlen($posts[$i]['content']) > 150) $posts[$i]['content'] = substr($posts[$i]['content'], 0, 150). ' <a href =\'/single/'.$posts[$i]['id'].'\'>...</a>'; 
			else{ 
				$posts[$i]['content'] .= ' <a href =\'/single/'.$posts[$i]['id'].'\'>React</a>';
			}  ?>
		
		<li>
			<h3><?php echo $posts[$i]['title']; ?> <span class="right"> écrit par : <?php echo $posts[$i]['name']; ?></span></h3>

			
			<?php echo $posts[$i]['content']; ?>
				
			<?php if (!empty($comments)) {
				echo " <span class='glyphicon glyphicon-comment' aria-hidden='true'></span> ".$comments[$i][0][0]; 
			} else{ echo " <span class='glyphicon glyphicon-comment' aria-hidden='true'></span>0 ";} ?>
			
		</li>
		<?php }} ?>
			
		
	</ul>

<?php include_once __DIR__."/partial/script.php" ?>
</body>
</html>