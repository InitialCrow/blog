<?php 
require_once __DIR__.'./../../../.conf.php';
require_once __DIR__.'/../../Model/DbModel.php';
require_once __DIR__.'/../../Model/AuthModel.php';

session_start();
$home_func =  array(
	'home' =>function(){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION);
			$db = new Db('PDO', DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);

			$db->init();
			$posts = $db->select('content, id, title', 'posts');
			$comments = [];
		
			foreach ($posts as $post) {
				$comment = $db->select('count(id)', 'comments','WHERE post_id='.(int)$post['id']);
				array_push($comments, $comment);

			}
			if($comments[0] === false || empty($comments)){
			
				$comments= null;
				
			}
			if($posts === false || empty($posts)){
				$posts= null;

			}
		
			include_once './../views/home.php';
			return exit();
	} , 
	'login' =>function(){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION);
			include_once './../views/auth/login.php';
			return exit();
	} , 
	'auth' =>function(){
			$auth = new Auth($_SESSION);
			$db = new Db('PDO', DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			$db->init();
			
			$email = strip_tags($_POST['email']);
			$pass = strip_tags($_POST['password']);
			if (preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $email) || preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $pass) )
			{
			 	echo "seriously since you are trying to hack me im with you girlfriend ";
			 	return exit();
			}
			else{
				$credential = $db->select('*', 'users', "WHERE email LIKE '$email' AND pass= $pass" );
				
				if($credential !== false && !empty($credential)){
					$_SESSION['name'] = (string)$credential[0]['name'];
					$_SESSION['id_user'] = (int)$credential[0]['id'];
					$_SESSION['auth'] = $auth->save($_SESSION);
					header("Location: /home");

				}
				else{
					$_SESSION['message'] = "fail in your email or password";
					header("Location: /");
				}
			}

			return exit();
	} ,
	'single' =>function($url_var){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION);
			$db = new Db('PDO', DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			$db->init();
			$post = $db->select('*', 'posts', "WHERE id=".(int)$url_var['id']);
			$comments = $db->select('content, name', 'comments', "WHERE post_id=".(int)$post[0]['id']);
			
			if($post === false || empty($post)){
				$post= null;
			}
			if($comments === false || empty($comments)){
				
				$comments = null;
			}
			
			include_once './../views/single.php';
			return exit();
	} ,
	'users' =>function(){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION);
			$db = new Db('PDO', DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			$db->init();
			$users = $db->select('name, email','users');

			if($users === false || empty($users)){
				$users= null;
			}
			
			include_once './../views/users.php';
			return exit();
	},
	'sign'=>function(){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION, '/sign');
			include_once './../views/auth/sign.php';
			return exit();
	},
	'sign_up'=>function(){
			$auth = new Auth($_SESSION);
			$db = new Db('PDO', DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			$db->init();
			
			$email = strip_tags($_POST['email']);
			$name = strip_tags($_POST['name']);
			$pass = strip_tags($_POST['password']);
			if (preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $email) || preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $pass) )
			{
			 	echo "seriously since you are trying to hack me im with you girlfriend ";
			 	return exit();
			}
			else{
				$credential = $db->select('id, email, pass', 'users', "WHERE email LIKE '$email'" );
				
				if($credential !== false && !empty($credential)){
					$_SESSION['message'] = "error mail already taken";
					header("Location: /sign");
				}
				else{	
					$user_id = $db->insert('users', 'name, email, pass', [$name, $email, $pass]);
					$_SESSION['name'] = $name;
					$_SESSION['id_user'] = (int)$user_id;
					$_SESSION['auth'] = $auth->save($_SESSION);
					header('Location: /home');
				}
			}
			return exit();
	},
	'write' => function(){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION);
			include_once './../views/write.php';
			return exit();
	},
	'write_up' => function(){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION);
			$db = new Db('PDO', DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			$db->init();
			$post = $_POST['editor'];
			$title =htmlspecialchars($_POST['title']);
			$id = (int)  $_SESSION['id_user'];
			$db->insert('posts', 'title, content, user_id', [$title, $post, $id], "", false);
			header('Location: /home');
			return exit();
	},
	'comment'=> function($url_var){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION);
			$db = new Db('PDO', DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			$db->init();
			$post_id = (int)$url_var['id'];
			$name = $_SESSION['name'];
			$comment = htmlspecialchars($_POST['comment']);
			if(!empty($comment)){

				$db->insert('comments', 'name, content, post_id', [$name, $comment, $post_id]);
			}
			else{
				echo "seriously since you are trying to hack me im with you girlfriend";
			}
			return exit();
	},
	'update_view'=>function($url_var){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION);
			$db = new Db('PDO', DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			$db->init();
			$post = $db->select('*', 'posts', "WHERE id=".(int)$url_var['id']);
			if($post !== false && !empty($post)){
				include_once './../views/update.php';

			}	
			else{
				echo "seriously since you are trying to hack me im with you girlfriend";
				
			}

			return exit();
	},
	'update'=>function(){
			$auth = new Auth($_SESSION);
			$auth->check($_SESSION);
			$db = new Db('PDO', DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
			$db->init();
			$title = $_POST['title'];
			$post_id = (int)$_POST['id_post'];
			$post = $_POST['editor'];

			$stmt = $db->update('posts', 'title, content', [$title, $post], "WHERE id= $post_id");
			if($stmt!== false ){
				

			}	
			else{
				echo "seriously since you are trying to hack me im with you girlfriend";
				
			}
			

			return exit();
	},
	'disconect'=>function(){
			$auth = new Auth($_SESSION);
			$auth->disco($_SESSION);
			return exit();

	}
	);