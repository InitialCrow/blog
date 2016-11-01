<?php 
class Auth{
	private $auth = null;
	private $baseUrl ="/home";
	public function __construct($session)
	{
		$this->auth = $session;

	}
	public function save(){
		$this->auth['auth'] = $this->generateRandomString();
		return $this->auth['auth'];
	}
	public function check($session, $redirect="/"){
		if(!empty($this->auth) && isset($session['auth']) && $session['auth']  === $this->auth['auth']){
		
			if($_SERVER["REQUEST_URI"] == $redirect){
				
				header('Location: '.$this->baseUrl);
				exit();
			}
			return;
		}
		else{
			if($_SERVER["REQUEST_URI"] !== $redirect){
				header('Location: '.$redirect);
			}
		}
	}
	public function generateRandomString($length = 20) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function disco($session, $redirect="/"){
		unset($session);
		session_destroy();
		header('Location: '.$redirect);
		exit();
	}

	
}