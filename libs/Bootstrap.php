<?php
class Bootstrap{
	public function __construct(){
	  if(isset($_GET['url'])){
	  	 //lấy chuỗi url
		  $url=rtrim($_GET['url'],"/");
		  //chuyển chuỗi url và dạng mảng
		  $url=explode('/',$url);
		  $c=$url[0];//lấy tên controller
		  //var_dump($url); die();
	  }else{
		  $c="index";
	  }

	  //load file controller
	  $file_controller=__CONTROLLER_PATH.$c."_Controller.php";
	  //var_dump($file_controller); die();
	  if(file_exists($file_controller)){
	    require_once($file_controller);
	  	//var_dump($trave); die();
	  }else{
		  require_once(__CONTROLLER_PATH."error_Controller.php");
		  $controller=new error();
		  $controller->index();
		  return false;
	  }
	  //khởi tạo class controller tương ứng
	  $name_controller=$c."_Controller";
	  $controller=new $name_controller;
	  
	  //tự động load model của controller tương ứng
	  $controller->LoadModel($c);//autoload model

	   	if (isset($url[0])) {	
	   	}
	   	if(isset($url[2])){
		  	//nếu tồn tại tham số pramater 1 của phương thức(action) trong controller sẽ chạy phương thức với tham số này
			  $controller->{$url[1]}($url[2]);
			  // echo "<pre>";
			  // var_dump($url[2]); tham số paramater truyenf trên url
		  }else{
		  	//nếu tồn tại phương thức(action) trong controller sẽ chạy phương thức này
			  if(isset($url[1])){
			  $controller->{$url[1]}();
			  }else{
			  	//mặc định sẽ chạy phương thức index
			  $controller->index();
			  }
		  }
	}
}
?>