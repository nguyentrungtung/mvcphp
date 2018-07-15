<?php
class Session{
	public static function __init(){
		session_start();
	}
	public static function set($key,$value){
		$_SESSION[$key]=$value;
	}
	public static function get($key){
		if(isset($_SESSION[$key])){
		return $_SESSION[$key];
		}
	}
	public static function unset_session($session_name){
		unset($_SESSION[$session_name]);
	}
}
?>