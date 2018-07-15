<?php 

/**
 * 
 */
class product_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		if(Session::get("login")==true){
			//echo "bạn đã đăng nhập thành công"; die();
			return true;
		}else{
			//echo "ban chua đăng nhập vui lòng đăng nhập để vào"; die();
			$this->view->redirect();
		}
	}

	public function search(){
		$search = addslashes($_GET['search']);
		if ($search) {
			$this->model->search($search);
			$data = $this->model->fetch();
			
			if ($data) {
				$this->view->render('product/index',$data);
			}
			else{	
				 echo '
					<script>
					 	alert("không tồn tại '.$search.'.");
					</script>
				 ';
				 $this->view->render('product/index');
			}
			//$this->view->render('category/index',$data); redirect
		}
	}
	
	public function checkname($file){
		if ($this->model->checkexist($file)) {
			//echo "file này đã tồn tại"; die();
			return true;
		}else{
			//echo "ham chech nhay vao false"; die();
			return false;
		}
	}

	public function index(){
		if ($this->model->getdata() == true) {
			//$data = $this->model->fetch();
			$total = $this->model->fetch();
			if (isset($_POST['active'])) {
				//echo "no chay o day "; die();
				if (isset($_POST['checkid'])) {
					$checkid = implode(',', $_POST['checkid']);
					echo $checkid;
					$this->model->active($checkid);
					$this->view->redirect('product/index');
				}		
			}

			if (isset($_POST['deactive'])) {

				if (isset($_POST['checkid'])) {
					$checkid = implode(',', $_POST['checkid']);
					//echo $checkid;
					$this->model->deactive($checkid);
					$this->view->redirect('product/index');
				}		
			}
			$datacount = count($total); // lay dung rùi
            //echo $datacount; die();
            //var_dump($datacount); die();
            $limit = 5; 
            if (isset($_GET['page'])) {
                $start = $_GET['page'];
            }else{
                $start = 0;
            }
                
            $config = array(
                'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
                'total_record'  => $datacount, // Tổng số record
                'limit'         => $limit,// limit  .(isset($_GET['page']) ? $_GET['page'] : 1)
                'link_full'     => __SITE_PATH.'product/index?page={page}',// Link full có dạng như sau: domain/com/page/{page}
                'link_first'    => 'index',// Link trang đầu tiên
            );
            $sql1 = $this->model->limit($start,$limit);
            //echo $sql1;
            $data2 = $this->model->queryfetch();
            //echo "<pre>";
            //var_dump($data2); die();
            $paging = new Pagination();
            $paging->init($config);
            $pagination = $paging->html();
			$this->view->render("product/index",$data2,$pagination);
		}else{
			$this->view->render("product/index");
		}
		
	}

	public function add(){

		if (isset($_POST['submit'])) {
			$mangName = $_FILES["avatar"]["name"];
			// echo "<pre>";
			// var_dump($mangName); die();
			$Mangtype = array("png", "PNG", "gif","GIF", "jpg","JPG", "jpeg");
			$mangFile = $_FILES["avatar"];
			$validae = new Validation();
			$validae->validate();     			
			$productname = $validae->valid('productname','productname','trim|required|min_length[1]');   	
			$productprice = $validae->valid('productprice','productprice','trim|required|numeric');	
			$description = $_POST['description'];  	
            $status = $_POST['active'];
            // echo $productname;
            // echo $productprice;
            //die();
            //$str_img = implode("/",$mangName);
            $str_img = "";
            for($i=0; $i<count($mangFile["name"]); $i++){
				/////////////////					$_FILES["avatar"]["name"]
				$target_file = "uploads/" . basename($mangFile["name"][$i]);
				$uploadOk = 0;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

				$file1 = basename($mangFile["name"][$i]);
				if (empty($file1)) {
					//echo "file no rong"; 
					break;
					//die();
				}else{

					$str_img .="/".$file1;
					//$str_img = implode("/",$file1);
					
					// check fake			$_FILES["avatar"]["tmp_name"]
					$check = getimagesize($mangFile["tmp_name"][$i]);
					if($check != false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;

						//throw new Exception("File is not an image");
					}
					
					// Check if file already exists
					if (file_exists($target_file)) {
						echo "Sorry, file already exists.";
						$uploadOk = 0;
						//throw new Exception("Sorry, file already exists.");
					}
					
					// Check file size  $_FILES["avatar"]["size"]
					if ($mangFile["size"][$i] > 100*1024*1024) {
						echo "Sorry, your file is too large.";
						$uploadOk = 0;
						//throw new Exception("Sorry, your file is too large.");
					} 
					
					// Allow certain file formats
					if( !in_array($imageFileType, $Mangtype) ) {
						echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
						//throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed");
					}
					
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
						//throw new Exception("Sorry, your file was not uploaded.");
					} else {
						if (move_uploaded_file($mangFile["tmp_name"][$i], $target_file)) {
							echo "The file ". basename( $mangFile["name"][$i]). " has been uploaded.";

						} else {
							echo "Sorry, there was an error uploading your file.";
						}
					}
					//end
				}
					
			} //end for upload
			$str_img = ltrim($str_img,"/");
			/**
			 * ckeck xem co tồn tại tên product ko
			 * @var [type]
			 */
			$checkproduct = trim($_POST['productname']);
			if ($this->checkname($checkproduct) == true) {
				echo "<script> alert('Trường nhập đã tồn tại')</script>";
				$this->view->render('product/add');
			}else{
				if($validae->is_valid()===1):
	               $this->model->insert($productname,$str_img,$description,$productprice,$status);
	               $this->view->redirect('product/index');
	            endif;
	            if ($validae->is_valid() != 1):
	            	$error_view = array(
	            		"ex_productname" 		=> $validae->error('error_productname'),
	            		"ex_productprice"  	=> $validae->error('error_productprice')
	            	);	
	            	//echo "<pre>";
	            	//var_dump($error_view);die();
	            	$this->view->render('product/add',$error_view);
		        endif;	
			}
            
		}else{
			$this->view->render('product/add');
		}

	} //end method add

	public function edit($id){
		$id = intval($id);
		if($this->model->getone($id)==true){
			$data = $this->model->fetch();
			if (isset($_POST['edit'])) {
				$str_img = "";
				$mangName = $_FILES["avatar"]["name"];
				$Mangtype = array("png", "PNG", "gif","GIF", "jpg","JPG", "jpeg");
				$mangFile = $_FILES["avatar"];
				$validae = new Validation();
				$validae->validate();     			
				$productname = $validae->valid('productname','productname','trim|required|min_length[6]');   	
				$productprice = $validae->valid('productprice','productprice','trim|required|numeric');	
				$description = $_POST['description'];  	
	            $status = $_POST['active'];

	            for($i=0; $i<count($mangFile["name"]); $i++){
				/////////////////					$_FILES["avatar"]["name"]
					$target_file = "uploads/" . basename($mangFile["name"][$i]);
					$uploadOk = 0;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

					$file1 = basename($mangFile["name"][$i]);
					if (empty($file1)) {
						//echo "file no rong"; 
						break;
						//die();
					}else{

						$str_img .="/".$file1;
						//$str_img = implode("/",$file1);
						

						// check fake			$_FILES["avatar"]["tmp_name"]
						$check = getimagesize($mangFile["tmp_name"][$i]);
						if($check != false) {
							echo "File is an image - " . $check["mime"] . ".";
							$uploadOk = 1;
						} else {
							echo "File is not an image.";
							$uploadOk = 0;

							//throw new Exception("File is not an image");
						}
						
						// Check if file already exists
						if (file_exists($target_file)) {
							echo "Sorry, file already exists.";
							$uploadOk = 0;
							//throw new Exception("Sorry, file already exists.");
						}
						
						// Check file size  $_FILES["avatar"]["size"]
						if ($mangFile["size"][$i] > 100*1024*1024) {
							echo "Sorry, your file is too large.";
							$uploadOk = 0;
							//throw new Exception("Sorry, your file is too large.");
						} 
						
						// Allow certain file formats
						if( !in_array($imageFileType, $Mangtype) ) {
							echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
							$uploadOk = 0;
							//throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed");
						}
						
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
							echo "Sorry, your file was not uploaded.";
							//throw new Exception("Sorry, your file was not uploaded.");
						} else {
							if (move_uploaded_file($mangFile["tmp_name"][$i], $target_file)) {
								echo "The file ". basename( $mangFile["name"][$i]). " has been uploaded.";

							} else {
								echo "Sorry, there was an error uploading your file.";
							}
						}
						//end
					}
						
				} //end for upload
				$str_img = ltrim($str_img,"/");
				if (!$str_img) {
					$str_img = $data[0]['image'];
					//echo $str_img; die();
					// echo "<pre>";
					// var_dump($data[0]['image']);
					// echo "loi khong co anh ko dc up nhe"; die();	
				}
					if($validae->is_valid()===1):
						// echo $productname;
						// echo $productprice;
						// echo $description;
						// echo $status;
		               $this->model->update($productname,$str_img,$description,$productprice,$status,$id);
		               $this->view->redirect('product/index');
		            endif;
		            if ($validae->is_valid() != 1):
		            	$error_view = array(
		            		"ex_productname" 		=> $validae->error('error_productname'),
		            		"ex_productprice"  	=> $validae->error('error_productprice')
		            	);
		            	if ($error_view['ex_productname']) {
	            	      	 echo '
								<script>
								 	alert(" '.$error_view['ex_productname'].'");
								</script>
							 ';	
	            	    }elseif($error_view['ex_productprice']){
	            	    	echo '
								<script>
								 	alert(" '.$error_view['ex_productprice'].'");
								</script>
							 ';
	            	    }
		            	//echo "<pre>";
		            	//var_dump($error_view);die(); ,$error_view
		            	$this->view->render('product/edit',$data);
			        endif;
				
	            
			}
			$this->view->render('product/edit',$data);
		}else{
			$this->view->render('product/edit');
		}
		
	}

	public function delete($id){
		$id = intval($id);
		//$this->model->del($id);
		$this->model->del($id);
		$this->view->redirect('product/index');			
	}


	

}



 ?>