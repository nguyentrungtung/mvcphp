<?php
class user_Controller extends Controller{
	public function __construct(){
	   parent::__construct();
	}

	public function search(){
		if ($this->checklogin() == true) {
			$search = addslashes($_GET['search']);
			if ($search) {
				$this->model->search($search);
				$data = $this->model->fetch();
				
				if ($data) {
					$this->view->render('user/index',$data);
				}
				else{	
					 echo '
						<script>
						 	alert("không tồn tại '.$search.'.");
						</script>
					 ';
					 $this->view->render('user/index');
				}
			}
		}else{
			$this->view->render("user/login");
		}
		
	}

	public function checklogin(){
		if(Session::get("login")==true){
			//echo "bạn đã đăng nhập thành công"; die();
			return true;
		}else{
			//echo "ban chua đăng nhập vui lòng đăng nhập để vào"; die();
			return false;
		}
	}
	public function index(){
		if ($this->checklogin() == true) {
			//echo "no chay vao day rùi"; die();
			if ($this->model->getdata() == true) {
				$total = $this->model->fetch();
				if (isset($_POST['active'])) {

					if (isset($_POST['checkid'])) {
						$checkid = implode(',', $_POST['checkid']);
						echo $checkid;
						$this->model->active($checkid);
						$this->view->redirect('user/index');
					}		
				}

				if (isset($_POST['deactive'])) {

					if (isset($_POST['checkid'])) {
						$checkid = implode(',', $_POST['checkid']);
						//echo $checkid;
						$this->model->deactive($checkid);
						$this->view->redirect('user/index');
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
	                'link_full'     => __SITE_PATH.'user/index?page={page}',// Link full có dạng như sau: domain/com/page/{page}
	                'link_first'    => 'index',// Link trang đầu tiên
	            );
	            //var_dump($config);die();
	            $sql1 = $this->model->limit($start,$limit);
	           // echo $sql1;
	           	$data2 = $this->model->queryfetch();
	            //echo "<pre>";
	            //var_dump($data2); die();
	            $paging = new Pagination();
	            $paging->init($config);
	            $pagination = $paging->html();
	            
				$this->view->render("user/index",$data2,$pagination);
			}
		}else{
			//echo "no ko chya dc vao vi dieu kien sai"; die();
			$this->view->redirect('user/login');
		}
	}


	public function login(){		
		if ($this->checklogin() == true) {
			$this->view->redirect('user/index');
		}else{
			if(isset($_POST['login'])){
				if($_POST['user']=="" or $_POST['password']==""){
					//$this->view->msg="Hay dien user hay pass";
					//$pagination = "";
					$this->view->render("user/login");
					
				}else{
					if($this->model->login()==true){
						Session::set("login",true);
						Session::set("user",$_POST['user']);
						$this->view->redirect("user/index");
						//$this->view
					}else{
						$this->view->redirect("user/login");
					}
				}
			}else{
			    $this->view->render("user/login");
			}
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

	public function add(){
		
		if (isset($_POST['submit'])) {		
				
   				$validae = new Validation();
    			$validae->validate();     			
				$user = $validae->valid('user','Username','trim|required|min_length[6]');
	           	$password = $validae->valid('password','password','trim|required|min_length[6]');
	            $status = $_POST['active'];
    			//echo "<pre>";
    			// var_dump($data);
				//die();
				$checkuser12 = trim($_POST['user']);
				//echo $checkuser; die();
				if ($this->checkname($checkuser12) == true) {
	                echo "<script> alert('Trường nhập đã tồn tại')</script>";
	                $this->view->render('user/add');
	            }else{
					//echo "chuyen vao day vi false"; die();
					if($validae->is_valid()===1):
		               $this->model->insert($user, $password, $status);
		               $this->view->redirect("user/index");
		            endif;

		            if ($validae->is_valid() != 1):
		            	$error_view = array(
		            		"ex_user" 		=> $validae->error('error_user'),
		            		"ex_password"  	=> $validae->error('error_password')
		            	);	
		            	//echo "<pre>";
		            	//var_dump($error_view);die();
		            	$this->view->render('user/add',$error_view);
		            endif;
				}// end lệnh IF checkname 

			}else{
				$this->view->render('user/add');
			}
	}
	public function logout(){
		Session::set("login",false);
		Session::unset_session("user");
		$this->view->redirect();
	}



	public function delete($id){
		$id = intval($id);
		//$this->model->del($id);
		$this->model->del($id);
		$this->view->redirect('user/index');			
	}
					
	public function edit($id){

		$id = intval($id);
		if($this->model->getone($id)==true){
			$data = $this->model->fetch();	
			//$this->view->render('user/edit',$data);
			if (isset($_POST['edit'])) {

				$validae = new Validation();
        		$validae->validate();
        		$user = $validae->valid('user','Username','trim|required|min_length[6]');
        		$status = $_POST['active'];
        		if($validae->is_valid()===1):
        			//echo "nhay vao day neu dung"; die();
	               	$this->model->update($user, $status, $id);
	              //$data1 = 	$this->view->render('user/index');
	              //echo $data1; die();
	              	$this->view->redirect('user/index');
		        endif;
		        if ($validae->is_valid() != 1):
		        	//echo "nhay vao day neu sai"; die();
	            	$error_view = array(
	            		"ex_user" 	=> $validae->error('error_user')	
	            	);      	
	            	// echo "<pre>";
	            	// var_dump($error_view);die();
	            	if ($error_view['ex_user']) {
	            	      	 echo '
								<script>
								 	alert(" '.$error_view['ex_user'].'");
								</script>
							 ';	
	            	    } 
	            	$this->view->render('user/edit',$data);
	            	//$this->view->render('user/edit',$error_view);
		        endif;

			}
			$this->view->render('user/edit',$data);
		}
	}


}

?>