<?php
class View{
	public function __construct(){
    }
    //,$Noinclude="" ,$error_view=array()  is_array($error_view)
	public function render($link,$data=array(),$pagination='',$error_view=array()){
		
		if (is_array($data)) {
			require_once __TEMPLATES_PATH."header.php";
			echo "<div id='conten'>";
			//extract($data);
            //ob_start();
				require_once(__VIEW_PATH.$link.".php");
				//var_dump($data) ; die();
			//$content = ob_get_clean();
			echo"</div>";
			require_once __TEMPLATES_PATH."footer.php";
		}else{
			require_once __TEMPLATES_PATH."header.php";
			echo "<div id='conten'>";
			//extract($data);
            //ob_start();
				require_once(__VIEW_PATH.$link.".php");
			//$content = ob_get_clean();
			echo"</div>";
			require_once __TEMPLATES_PATH."footer.php";
		}

			require_once __TEMPLATES_PATH."header.php";
			echo "<div id='conten'>";
			//extract($data);
            //ob_start();
				require_once(__VIEW_PATH.$link.".php");
			//$content = ob_get_clean();
			echo"</div>";
			require_once __TEMPLATES_PATH."footer.php";

		//////////////////////

	}
	
	public function redirect($link=''){
		ob_start();
		if($link!=''){
		$link=__SITE_PATH.$link;
		}else{
		$link=__SITE_PATH;
		}
		header("Location:$link");
	}
}
?>