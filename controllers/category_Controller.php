<?php 
/**
 * 
 */
class category_Controller extends Controller
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

    public function checkname($file){
        if ($this->model->checkexist($file)) {
            //echo "file này đã tồn tại"; die();
            return true;
        }else{
            //echo "ham chech nhay vao false"; die();
            return false;
        }
    }

    public function search(){
        $search = addslashes($_GET['search']);
        //$search = $_GET['search'];
        //echo $search; 
        if ($search) {
            $this->model->search($search);
            $data = $this->model->fetch();
            //echo "<pre>";
            //var_dump($data); die();
            if ($data) {
                $this->view->render('category/index',$data);
            }
            else{   
                 echo '
                    <script>
                        alert("không tồn tại '.$search.'.");
                    </script>
                 ';
                 $this->view->render('category/index');
            }
            //$this->view->render('category/index',$data); redirect
        }
    }

    public function index(){
        if ($this->model->getdata() == true) {
            $total = $this->model->fetch();
            //echo "<pre>";
            //var_dump($total);die();    
            if (isset($_POST['active'])) {

                if (isset($_POST['checkid'])) {
                    $checkid = implode(',', $_POST['checkid']);
                    echo $checkid;
                    $this->model->active($checkid);
                    $this->view->redirect('category/index');
                }       
            }
            if (isset($_POST['deactive'])) {

                if (isset($_POST['checkid'])) {
                    $checkid = implode(',', $_POST['checkid']);
                    //echo $checkid;
                    $this->model->deactive($checkid);
                    $this->view->redirect('category/index');
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
                'link_full'     => __SITE_PATH.'category/index?page={page}',// Link full có dạng như sau: domain/com/page/{page}
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
            //echo ;
            //echo "<pre>";
            //var_dump($config); die();
            
            $this->view->render("category/index",$data2,$pagination);
        }
        else {
            $this->view->render("category/index");
        }
    }


    public function add() {
        if (isset($_POST['submit'])) {                  
            $validae = new Validation();
            $validae->validate();               
            $categoryname = $validae->valid('categoryname','categoryname','trim|required|min_length[6]');       
            $status = $_POST['active'];
             //echo "<pre>";
            // var_dump($data);
            //die();
            $checkcate = trim($_POST['categoryname']);
           // echo $checkcate; die();
            if ($this->checkname($checkcate) == true) {
                echo "<script> alert('Trường nhập đã tồn tại')</script>";
                $this->view->render('category/add');
            }else{

                if($validae->is_valid()===1):
                   $this->model->insert($categoryname,$status);
                   $this->view->redirect('category/index');
                endif;

                if ($validae->is_valid() != 1):
                    $error_view = array(
                        "ex_categoryname"   => $validae->error('error_categoryname')
                    );  
                    //echo "<pre>";
                    //var_dump($error_view);die();
                    $this->view->render('category/add',$error_view);
                endif;
            }
            //endif;

        }else{
            $this->view->render('category/add');
        }
    }

    public function delete($id){
        $id = intval($id);
        //$this->model->del($id);
        $this->model->del($id);
        $this->view->redirect('category/index');            
    }

    public function edit($id){
        $id = intval($id);
        if($this->model->getone($id)==true){
            $data = $this->model->fetch();  
            //$this->view->render('user/edit',$data);
            if (isset($_POST['edit'])) {
                $validae = new Validation();
                $validae->validate();
                $categoryname = $validae->valid('categoryname','categoryname','trim|required|min_length[6]');
                $status = $_POST['active'];
                //echo $status; die();
                if($validae->is_valid()===1):
                    //echo "nhay vao day neu dung"; die();
                    $this->model->update($categoryname, $status, $id);
                  //$data1 =    $this->view->render('user/index');
                  //echo $data1; die();
                    $this->view->redirect('category/index');
                endif;
                if ($validae->is_valid() != 1):
                    //echo "nhay vao day neu sai"; die();
                    $error_view = array(
                        "ex_categoryname"   => $validae->error('error_categoryname')    
                    );
                    if ($error_view['ex_categoryname']) {
                             echo '
                                <script>
                                    alert(" '.$error_view['ex_categoryname'].'");
                                </script>
                             '; 
                            }       
                    //echo "<pre>";
                    //var_dump($error_view);die(); ,$error_view
                    $this->view->render('category/edit',$data);
                endif;
            }
            $this->view->render('category/edit',$data);
        }
    }

}



 ?>